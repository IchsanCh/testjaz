<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'category_slug' => 'songket',
                'name' => 'AL HIJAZ Masterpiece',
                'material' => 'TR + Rayon',
                'size_width' => 210,
                'size_length' => 128,
                'edition' => 'Premium',
                'images' => ['box-masterpiece.webp', 'series-songket.webp'],
            ],
            [
                'category_slug' => 'dobby',
                'name' => 'AL HIJAZ Excellent',
                'material' => 'TR + Rayon',
                'size_width' => 210,
                'size_length' => 128,
                'edition' => null,
                'images' => ['box-excellent.webp', 'series-dobby.webp'],
            ],
            [
                'category_slug' => 'super',
                'name' => 'AL HIJAZ Super',
                'material' => 'Katun Super',
                'size_width' => 210,
                'size_length' => 128,
                'edition' => null,
                'images' => ['box-super.webp', 'series-super.webp'],
            ],
            [
                'category_slug' => 'parang',
                'name' => 'AL HIJAZ Berlian',
                'material' => 'TR + Rayon',
                'size_width' => 210,
                'size_length' => 128,
                'edition' => 'Limited',
                'images' => ['box-berlian.webp', 'parang-dark.webp'],
            ],
            [
                'category_slug' => 'rayon',
                'name' => 'AL HIJAZ Spesial',
                'material' => 'Rayon',
                'size_width' => 210,
                'size_length' => 128,
                'edition' => null,
                'images' => ['box-spesial.webp', 'series-rayon.webp'],
            ],
            [
                'category_slug' => 'coletan',
                'name' => 'AL HIJAZ Coletan',
                'material' => 'Katun Coletan',
                'size_width' => 210,
                'size_length' => 128,
                'edition' => null,
                'images' => ['box-coletan.webp', 'series-coletan.webp'],
            ],
        ];

        foreach ($products as $i => $data) {
            $category = ProductCategory::where('slug', $data['category_slug'])->first();

            $product = Product::updateOrCreate(
                ['name' => $data['name']],
                [
                    'product_category_id' => $category?->id,
                    'material' => $data['material'],
                    'size_width' => $data['size_width'],
                    'size_length' => $data['size_length'],
                    'edition' => $data['edition'],
                    'sort_order' => $i,
                ]
            );

            // Cuma bikin foto kalau produk ini belum punya foto sama sekali
            // (biar aman kalau seeder dijalanin berkali-kali, gak numpuk duplikat)
            if ($product->images()->count() === 0) {
                foreach ($data['images'] as $j => $image) {
                    // Foto seed ini asalnya dari public/images/*.webp (aset statis),
                    // bukan hasil upload FileUpload — copy dulu ke disk "public" (storage)
                    // biar path-nya konsisten sama upload beneran & kebaca via asset('storage/...')
                    $storagePath = 'products/'.$image;
                    if (!Storage::disk('public')->exists($storagePath)) {
                        Storage::disk('public')->put(
                            $storagePath,
                            file_get_contents(public_path('images/'.$image))
                        );
                    }

                    $product->images()->create([
                        'image' => $storagePath,
                        'is_thumbnail' => $j === 0,
                        'sort_order' => $j,
                    ]);
                }
            }
        }
    }
}
