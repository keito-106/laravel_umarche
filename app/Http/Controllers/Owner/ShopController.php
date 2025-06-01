<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop; // Assuming you have a Shop model
use Illuminate\Support\Facades\Storage;
use InterventionImage;
use App\Http\Requests\UploadImageRequest; // Assuming you have a custom request for image upload
use App\Services\ImageService; // Assuming you have an ImageService for handling image uploads


class ShopController extends Controller
{
    public function __construct()
     {
         $this->middleware('auth:owners');

         $this->middleware(function ($request, $next) {

            // dd($request->route()->parameter('shop'));  //文字列
            // dd(Auth::id()); //整数
            // $shop = Shop::findOrFail($id);
            // dd('Shop owner relationship:', $shop->owner, 'Shop details:', $shop);

            $id = $request->route()->parameter('shop'); //shopのid取得
            if(!is_null($id)){ // nul判定
            $shopsOwnerId = Shop::findOrFail($id)->owner->id;
               $shopId = (int)$shopsOwnerId; // キャスト 文字列→数値に型変換
               $ownerId = Auth::id();
               if($shopId !== $ownerId){ // 同じでなかったら
                  abort(404); // 404画面表示
               }
            }
            return $next($request);


         });
     }

     public function index()
     {
                //$ownerId = Auth::id();
        $shops = Shop::where('owner_id', Auth::id())->get();

        return view('owner.shops.index', compact('shops'));
     }

     public function edit($id)
     {
         // Logic to edit the shop
         $shop = Shop::findOrFail($id);
         // dd(Shop::findOrFail($id));
         return view('owner.shops.edit', compact('shop'));
     }

     public function update(UploadImageRequest $request, $id)
     {
         // Logic to update the shop
         $imageFile = $request->file('image'); //一時保存
         if(!is_null($imageFile) && $imageFile->isValid() ){
            $fileNameToStore = ImageService::upload($imageFile, 'shops'); // ImageServiceを利用して画像を保存
         }
         return redirect()->route('owner.shops.index');
     }
}
