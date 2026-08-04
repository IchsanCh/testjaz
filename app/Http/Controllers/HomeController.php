<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredProducts = Product::query()
            ->with(['category', 'images']) // eager load — cegah N+1 (thumbnail butuh images)
            ->orderBy('sort_order')
            ->limit(6)
            ->get();

        return view('landing', [
            'featuredProducts' => $featuredProducts,
        ]);
    }
}
