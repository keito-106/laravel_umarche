<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('primary_categories')->insert([
            [
               'name' => 'トップス',
               'sort_order' => 1,
            ],
            [
               'name' => 'オーダーメイド',
               'sort_order' => 2,
            ],
            [
               'name' => 'パンツ',
               'sort_order' => 3,
            ],
        ]);
        DB::table('secondary_categories')->insert([
            [
               'name' => 'パーカー',
               'sort_order' => 1,
               'primary_category_id' => 1
            ],
            [
               'name' => 'ニット・セーター',
               'sort_order' => 2,
               'primary_category_id' => 1
            ],
            [
               'name' => 'スウェット・トレーナー',
               'sort_order' => 3,
               'primary_category_id' => 1
            ],
            [
               'name' => 'スーツ',
               'sort_order' => 4,
               'primary_category_id' => 2
            ],
            [
               'name' => 'ワイシャツ',
               'sort_order' => 5,
               'primary_category_id' => 2
            ],
            [
               'name' => 'ズボン・パンツ',
               'sort_order' => 6,
               'primary_category_id' => 2
            ],
        ]);
    }
}
