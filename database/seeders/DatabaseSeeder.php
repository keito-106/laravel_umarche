<?php

namespace Database\Seeders;
use App\Models\Product;
use App\Models\Stock;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            AdminSeeder::class,
            OwnerSeeder::class,
            ShopSeeder::class,
            ImageSeeder::class,
            CategorySeeder::class,
            // ProductSeeder::class,
            // StockSeeder::class,
            UserSeeder::class,
            // Add other seeders here as needed
        ]);
        Product::factory(100)->create();
        Stock::factory(100)->create();
    }
}
