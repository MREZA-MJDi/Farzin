<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::query()
            ->where('is_active', true)
            ->with('primaryImage');

        /*
        |--------------------------------------------------------------------------
        | Category
        |--------------------------------------------------------------------------
        */

        if ($request->filled('category')) {
            $query->where('category', $request->string('category'));
        }


        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('q')) {
            $search = $request->string('q');

            $query->where(function ($builder) use ($search) {
                $builder
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('brand', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%");
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Products
        |--------------------------------------------------------------------------
        */

        $products = $query
            ->latest()
            ->paginate(12)
            ->withQueryString();


        return view('pages.shop', [
            'products' => $products,
            'category' => $request->string('category')->toString(),
            'search' => $request->string('q')->toString(),
        ]);
    }


    public function show(string $slug): View
    {
        $product = Product::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->with([
                'images' => fn ($query) =>
                $query->orderBy('sort_order'),
            ])
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Related Products
        |--------------------------------------------------------------------------
        */

        $relatedProducts = Product::query()
            ->where('is_active', true)
            ->where('id', '!=', $product->id)
            ->where('category', $product->category)
            ->with('primaryImage')
            ->latest()
            ->take(4)
            ->get();


        return view('pages.product', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }
}

