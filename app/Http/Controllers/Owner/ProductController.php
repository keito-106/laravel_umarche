<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Image;
use App\Models\Shop;
use App\Models\PrimaryCategory;
use App\Models\Owner;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function __construct()
     {
         $this->middleware('auth:owners');

         $this->middleware(function ($request, $next) {

            $id = $request->route()->parameter('product');
            if(!is_null($id)){
            $productsOwnerId = Product::findOrFail($id)->shop->owner->id;
               $productId = (int)$productsOwnerId;
               if($productId !== Auth::id()){
                  abort(404);
               }
            }
            return $next($request);


         });
     }

    public function index()
    {
        // $products = Owner::findOrFail(Auth::id())->shop->product;
        $ownerInfo = Owner::with('shop.product.imageFirst')
        ->where('id', Auth::id())
        ->get();

        // dd($ownerInfo);
        // foreach ($ownerInfo as $owner) {
            // dd($owner->shop->product);
        //    foreach($owner->shop->product as $product){
        //        dd($product->imageFirst->filename);
        //    }
        // }

        return view('owner.products.index', compact('ownerInfo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shops = Shop::where('owner_id', Auth::id())
        ->select('id', 'name')
        ->get();

        $images = Image::where('owner_id', Auth::id())
        ->select('id', 'title', 'filename')
        ->orderby('created_at', 'desc')
        ->get();

        $categories = PrimaryCategory::with('secondary')
        ->get();

        return view('owner.products.create',
        compact('shops', 'images', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try{
            DB::transaction(function () use ($request) {
               $product = Product::create([
                  'name' => $request->name,
                  'information' => $request->information,
                  'price' => $request->price,
                  'sort_order' => $request->sort_order,
                  'shop_id' => $request->shop_id,
                  'secondary_category_id' => $request->category,
                  'image1' => $request->image1,
                  'image2' => $request->image2,
                  'image3' => $request->image3,
                  'image4' => $request->image4,
                  'is_selling' => $request->is_selling,
                ]);

                Stock::create([
                    'product_id' => $product->id,
                    'type' => 1,
                    'quantity' => $request->quantity,
                ]);
            },2);
        }catch(Throwable $e){
            Log::erorr($e);
            throw $e;
        }





        return redirect()
        ->route('owner.products.index')
        ->with(['message' => '商品登録しました。',
        'status' => 'info' ]);
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $quantity = Stock::where('product_id', $product->id)->sum('quantity');

        $shops = Shop::where('owner_id', Auth::id())
        ->select('id', 'name')
        ->get();

        $images = Image::where('owner_id', Auth::id())
        ->select('id', 'title', 'filename')
        ->orderby('created_at', 'desc')
        ->get();

        $categories = PrimaryCategory::with('secondary')
        ->get();

        return view('owner.products.edit',
        compact('product', 'quantity', 'shops',
        'images', 'categories'));
    }

    public function update(ProductRequest $request, $id)
    {
        try{
            DB::transaction(function () use ($request, $id) {
                $product = Product::findOrFail($id);

                // 在庫の増減数を計算
                $newQuantity = 0;
                if($request->type === \Constant::PRODUCT_LIST['add']){
                    $newQuantity = $request->quantity;
                }
                if($request->type === \Constant::PRODUCT_LIST['reduce']){
                    $newQuantity = $request->quantity * -1;
                }

                // 商品情報を更新
                if ($request->name) { $product->name = $request->name; }
                if ($request->information) { $product->information = $request->information; }
                if ($request->price) { $product->price = $request->price; }
                if ($request->sort_order) { $product->sort_order = $request->sort_order; }
                if ($request->shop_id) { $product->shop_id = $request->shop_id; }
                if ($request->category) { $product->secondary_category_id = $request->category; }
                if ($request->image1) { $product->image1 = $request->image1; }
                if ($request->image2) { $product->image2 = $request->image2; }
                if ($request->image3) { $product->image3 = $request->image3; }
                if ($request->image4) { $product->image4 = $request->image4; }
                // is_selling は、この後の在庫数チェックで自動設定されるため、ここでは更新しない

                // 在庫の増減がある場合のみStockレコードを作成
                if ($newQuantity !== 0) {
                    Stock::create([
                        'product_id' => $product->id,
                        'type' => $request->type,
                        'quantity' => $newQuantity,
                    ]);
                }

                // ▼▼▼ ここからが新しいロジック ▼▼▼
                // 変更後の合計在庫数を取得
                $currentStock = Stock::where('product_id', $product->id)->sum('quantity');

                // 合計在庫数が0以下なら「停止中」に、そうでなければ「販売中」に設定
                if ($currentStock <= 0) {
                    $product->is_selling = 0; // 停止中
                } else {
                    $product->is_selling = 1; // 販売中
                }
                // ▲▲▲ ここまでが新しいロジック ▲▲▲

                $product->save();

            }, 2);
        }catch(\Throwable $e){
            Log::error($e);
            throw $e;
        }


        return redirect()
        ->route('owner.products.index')
        ->with(['message' => '商品情報を更新しました。',
        'status' => 'info' ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return redirect()
            ->route('owner.products.index')
            ->with(['message' => '商品を削除しました。',
            'status' => 'alert']);
    }
}
