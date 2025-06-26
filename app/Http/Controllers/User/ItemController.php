<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stock;
use App\Models\PrimaryCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Jobs\SendThanksMail;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:users')->except(['index', 'show']);

        $this->middleware(function ($request, $next) {
            $id = $request->route()->parameter('item');
            if(!is_null($id)){
            $itemId = Product::availableItems()->where('products.id', $id)->exists();
                if(!$itemId){
                    abort(404);
                }
        }
        return $next($request);
    });

        $this->middleware(function ($request, $next) {

            $id = $request->route()->parameter('item');
            if(!is_null($id)){
            $itemId = Product::availableItems()->where('products.id', $id)->exists();
               if(!$itemId){
                  abort(404);
               }
            }
            return $next($request);


         });
    }

    public function index(Request $request)
    {
        // カテゴリ情報はゲスト・ログインユーザー共通で取得
        $categories = PrimaryCategory::with('secondary')->get();

        // どの役割でも認証されていない（ゲストである）場合
        if (!Auth::check() && !Auth::guard('owners')->check() && !Auth::guard('admin')->check()) {

            // おすすめ商品をランダムで4件取得
            $recommendedProducts = Product::availableItems()
                ->inRandomOrder()
                ->take(4)
                ->get();

            // ゲスト用のトップページに、おすすめ商品とカテゴリ情報を渡す
            return view('user.welcome', compact('recommendedProducts', 'categories'));
        }

        // --- 以下は、ログイン済みユーザーの場合の処理 ---
        $products = Product::availableItems()
        ->selectCategory($request->category ?? '0')
        ->searchKeyword($request->keyword)
        ->sortOrder($request->sort)
        ->paginate($request->pagination ?? '20');

        // ログイン済みユーザー用の商品一覧ページに、商品一覧とカテゴリ情報を渡す
        return view('user.index', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $quantity = Stock::where('product_id', $product->id)->sum('quantity');

        if($quantity > 9){
        $quantity = 9;
        }

        return view('user.show', compact('product', 'quantity'));
    }
}
