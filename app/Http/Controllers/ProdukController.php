<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
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

        $view = $request->ajax() ? 'produk.partials.grid' : 'produk.index';

        return view($view, [
            'products' => $products,
            'categories' => $categories,
            'keyword' => $keyword,
            'selectedCategories' => $selectedCategories,
        ]);
    }
}
