<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['cat_name' => 'هواتف ذكية'],
            ['cat_name' => 'أجهزة لوحية'],
            ['cat_name' => 'إكسسوارات'],
            ['cat_name' => 'سماعات'],
            ['cat_name' => 'شواحن وبطاريات'],
            ['cat_name' => 'عروض وتخفيضات'],
        ];

        DB::table('categories')->insert($categories);
    }
}
