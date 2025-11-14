<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_types')->insert([
            'name' => 'Baguettes'
        ]);

        DB::table('product_types')->insert([
            'name' => 'Toast'
        ]);

        DB::table('product_types')->insert([
            'name' => 'Sandwich'
        ]);

        DB::table('product_types')->insert([
            'name' => 'Bread'
        ]);
    }
}
