<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Songket', 'slug' => 'songket'],
            ['name' => 'Dobby', 'slug' => 'dobby'],
            ['name' => 'Super', 'slug' => 'super'],
            ['name' => 'Parang', 'slug' => 'parang'],
            ['name' => 'Rayon', 'slug' => 'rayon'],
            ['name' => 'Coletan', 'slug' => 'coletan'],
        ];

        foreach ($categories as $category) {
            ProductCategory::updateOrCreate(['slug' => $category['slug']], $category);
        }
    }
}
