<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;

class ArticleCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Perawatan', 'slug' => 'perawatan'],
            ['name' => 'Proses', 'slug' => 'proses'],
            ['name' => 'Gaya', 'slug' => 'gaya'],
        ];

        foreach ($categories as $category) {
            ArticleCategory::updateOrCreate(['slug' => $category['slug']], $category);
        }
    }
}
