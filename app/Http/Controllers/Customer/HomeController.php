<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredProducts = Product::query()
            ->active()
            ->where('is_featured', true)
            ->with([
                'category:id,name,slug',
                'primaryImage:id,product_id,image,alt',
            ])
            ->latest('id')
            ->limit(8)
            ->get();

        $categories = Category::query()
            ->where('is_active', true)
            ->withCount([
                'activeProducts',
            ])
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('pages.home', [
            'featuredProducts' => $featuredProducts,
            'categories' => $categories,
        ]);
    }
}
