<?php

namespace Database\Seeders;

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
        $this->call(ProductsTableSeeder::class);        // 製品データを挿入
        $this->call(SeasonsTableSeeder::class);         // 季節データを挿入
        $this->call(ProductSeasonTableSeeder::class);   // 製品と季節の関連データを挿入
    }
}
