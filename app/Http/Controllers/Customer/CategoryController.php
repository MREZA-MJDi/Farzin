<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->withCount([
                'activeProducts',
            ])
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('pages.categories.index', [
            'categories' => $categories,
        ]);
    }

    public function show(Category $category): View
    {
        abort_unless($category->is_active, 404);

        $products = $category->activeProducts()
            ->with([
                'primaryImage:id,product_id,image,alt',
            ])
            ->latest('id')
            ->paginate(12)
            ->withQueryString();

        return view('pages.category', [
            'category' => $category,
            'products' => $products,
        ]);
    }
}
