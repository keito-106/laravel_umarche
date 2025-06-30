<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use App\Services\CartService;
use App\Jobs\SendThanksMail;
use App\Jobs\SendOrderedMail;

class CartController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $products = $user->products;
        $totalPrice = 0;

        foreach ($products as $product) {
            $totalPrice += $product->price * $product->pivot->quantity;
        }

        // dd($products, $totalPrice);

        return view('user.cart',
           compact('products', 'totalPrice'));
    }

    public function add(Request $request)
    {
        $itemInCart = Cart::where('product_id', $request->product_id)
            ->where('user_id', Auth::id())->first();

            if($itemInCart){
                $itemInCart->quantity += $request->quantity;
                $itemInCart->save();

            } else {
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity,
                ]);
            }

            return redirect()->route('cart.index');
    }

    public function delete($id)
    {
        Cart::where('product_id', $id)
            ->where('user_id', Auth::id())
            ->delete();

            return redirect()->route('cart.index');
    }

    public function checkout()
    {

    // ... ($user と $products の取得は同じ) ...
    $user = User::findOrFail(Auth::id());
    $products = $user->products;

    $lineItems = [];
    foreach ($products as $product){
        $quantity = '';
        $quantity = Stock::where('product_id', $product->id)->sum('quantity');

        if($product->pivot->quantity > $quantity){
           return redirect()->route('cart.index');
        } else {
            $lineItem = [
                        'price_data' => [ // ★ 'price_data' オブジェクトで価格情報をまとめる
                            'currency' => 'jpy', // 通貨
                            'unit_amount' => $product->price, // ★ 'amount' ではなく 'unit_amount' で単価を指定
                            'product_data' => [ // ★ 'product_data' オブジェクトで商品情報をまとめる
                                'name' => $product->name,
                                'description' => $product->information,
                            ],
                        ],
                        'quantity' => $product->pivot->quantity, // 数量
                    ];
                    array_push($lineItems, $lineItem);
               }
        }
        // dd($lineItems);
        foreach($products as $product){
            Stock::create([
                    'product_id' => $product->id,
                    'type' => \Constant::PRODUCT_LIST['reduce'],
                    'quantity' => $product->pivot->quantity * -1,
                ]);
        }

        \Stripe\Stripe::setApiKey(config('STRIPE.SECRET.KEY'));

        $session = \Stripe\Checkout\Session::create([

            'payment_method_types' => ['card'],
            'line_items' => [$lineItems],
            'mode' => 'payment',

            'success_url' => route('cart.success'),
            'cancel_url' => route('cart.cancel'),
        ]);

        $publicKey = config('STRIPE.PUBLIC.KEY');

        return view('user.checkout',
           compact('session', 'publicKey'));
    }

    public function success()
    {
        ////
        $items = Cart::where('user_id', Auth::id())->get();
        $products = CartService::getItemsInCart($items);
        $user = User::findOrFail(Auth::id());

        SendThanksMail::dispatch($products, $user);
        foreach($products as $product)
        {
            SendOrderedMail::dispatch($product, $user);
        }
        // dd('ユーザーメール送信テスト');
        ////
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('items.index')->with([
            'success' => '決済が完了しました。'
        ]);
     }

     public function cancel()
     {
        $user = User::findOrFail(Auth::id());

        foreach($user->products as $product){
            Stock::create([
                    'product_id' => $product->id,
                    'type' => \Constant::PRODUCT_LIST['add'],
                    'quantity' => $product->pivot->quantity,
                ]);
        }

        return redirect()->route('cart.index')->with([
            'error' => '決済がキャンセルされました。'
        ]);
     }

}
