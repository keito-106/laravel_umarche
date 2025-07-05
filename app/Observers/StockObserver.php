<?php

namespace App\Observers;

use App\Models\Stock;
use App\Models\Product;

class StockObserver
{
    /**
     * Handle the Stock "created" event.
     */
    public function created(Stock $stock)
    {
        // ▼▼▼ 修正点 ▼▼▼
        $product = Product::find($stock->product_id);
        if ($product) {
            $this->updateProductStatus($product);
        }
    }

    /**
     * Handle the Stock "updated" event.
     */
    public function updated(Stock $stock)
    {
        // ▼▼▼ 修正点 ▼▼▼
        $product = Product::find($stock->product_id);
        if ($product) {
            $this->updateProductStatus($product);
        }
    }

    /**
     * Handle the Stock "deleted" event.
     */
    public function deleted(Stock $stock)
    {
        $product = Product::find($stock->product_id);
        if ($product) {
            $this->updateProductStatus($product);
        }
    }

    /**
     * Helper method to update the product's selling status based on its stock.
     */
    protected function updateProductStatus(Product $product)
    {
        // 在庫数を再計算
        $quantity = Stock::where('product_id', $product->id)->sum('quantity');

        if ($quantity <= 0) {
            $product->is_selling = 0; // 在庫が0以下なら販売停止
        } else {
            $product->is_selling = 1;  // 在庫があれば販売中
        }

        $product->save();
    }
}
