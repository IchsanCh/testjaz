<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Support\Highlighter;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProdukController extends Controller
{
    public function index(Request $request): View
    {
        $keyword = trim((string) $request->query('q', ''));
        $selectedCategories = array_filter((array) $request->query('kategori', []));

        $categories = ProductCategory::query()
            ->withCount('products')
            ->orderBy('name')
            ->get();

        $products = Product::query()
            ->with(['category', 'images']) // eager load — cegah N+1 (thumbnail butuh images)
            ->when($keyword !== '', fn ($q) => $q->where(
                fn ($sub) => $sub->where('name', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%")
                    ->orWhere('material', 'like', "%{$keyword}%")
            ))
            ->when(
                count($selectedCategories) > 0,
                fn ($q) => $q->whereHas(
                    'category',
                    fn ($cat) => $cat->whereIn('slug', $selectedCategories)
                )
            )
            ->orderBy('sort_order')
            ->paginate(9)
            ->withQueryString();

        // Sama kayak di ArtikelController: highlight kata kunci di nama produk,
        // dan kalau nama-nya sendiri gak match, siapin cuplikan dari description
        // (atau material sebagai fallback terakhir) biar user tau kenapa produk
        // itu muncul di hasil pencarian.
        if ($keyword !== '') {
            $products->getCollection()->each(function (Product $product) use ($keyword) {
                $nameMatches = mb_stripos($product->name, $keyword) !== false;

                $product->name_highlighted = Highlighter::mark(e($product->name), $keyword);

                if ($nameMatches) {
                    $product->search_snippet = null;
                } elseif ($product->description && mb_stripos($product->description, $keyword) !== false) {
                    $product->search_snippet = Highlighter::snippet($product->description, $keyword);
                } elseif ($product->material && mb_stripos($product->material, $keyword) !== false) {
                    $product->search_snippet = Highlighter::mark(e($product->material), $keyword);
                } else {
                    $product->search_snippet = null;
                }
            });
        }

        $view = $request->ajax() ? 'produk.partials.grid' : 'produk.index';

        return view($view, [
            'products' => $products,
            'categories' => $categories,
            'keyword' => $keyword,
            'selectedCategories' => $selectedCategories,
        ]);
    }

    public function show(Product $product): View
    {
        $product->load(['category', 'images']);

        $related = Product::query()
            ->with(['category', 'images'])
            ->where('product_category_id', $product->product_category_id)
            ->where('id', '!=', $product->id)
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        return view('produk.show', [
            'product' => $product,
            'related' => $related,
        ]);
    }
}