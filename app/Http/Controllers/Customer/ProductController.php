<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::query()
            ->active()
            ->with([
                'category:id,name,slug',
                'primaryImage:id,product_id,image,alt',
            ]);

        $categorySlug = trim(
            (string) $request->query('category', '')
        );

        if ($categorySlug !== '') {
            $query->whereHas(
                'category',
                fn ($categoryQuery) =>
                $categoryQuery
                    ->where('slug', $categorySlug)
                    ->where('is_active', true)
            );
        }

        $search = trim(
            (string) $request->query('q', '')
        );

        if ($search !== '') {
            $query->where(function ($productQuery) use ($search) {
                $productQuery
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('brand', 'like', "%{$search}%")
                    ->orWhere(
                        'short_description',
                        'like',
                        "%{$search}%"
                    );
            });
        }

        $products = $query
            ->latest('id')
            ->paginate(12)
            ->withQueryString();

        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get([
                'id',
                'name',
                'slug',
            ]);

        return view('pages.shop', [
            'products' => $products,
            'categories' => $categories,
            'category' => $categorySlug,
            'search' => $search,
        ]);
    }

    public function show(Product $product): View
    {
        abort_unless($product->is_active, 404);

        $product->load([
            'category:id,name,slug',
            'images:id,product_id,image,alt,sort_order,is_primary',
        ]);

        $relatedProducts = Product::query()
            ->active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with([
                'primaryImage:id,product_id,image,alt',
            ])
            ->latest('id')
            ->limit(4)
            ->get();

        return view('pages.product', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }
}
