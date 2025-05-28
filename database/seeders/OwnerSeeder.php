<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('owners')->insert([
            [
               'name' => 'testadmin1',
               'email' => 'test1@test.com',
               'password' => Hash::make('password123'),
               'created_at' => now(),
               'updated_at' => now(),
            ],
            [
                'name' => 'testadmin2',
                'email' => 'test2@test.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
             ],
             [
                'name' => 'testadmin3',
                'email' => 'test3@test.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
             ],
             [
                'name' => 'testadmin4',
                'email' => 'test4@test.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
             ],
             [
                'name' => 'testadmin5',
                'email' => 'test5@test.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
             ],
             [
                'name' => 'testadmin6',
                'email' => 'test6@test.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
             ],
        ]);
    }
}
