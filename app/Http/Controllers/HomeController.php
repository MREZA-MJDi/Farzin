<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredProducts = Product::query()
            ->where('is_active', true)
            ->where('is_featured', true)
            ->with('primaryImage')
            ->latest()
            ->take(8)
            ->get();

        return view('pages.home', [
            'featuredProducts' => $featuredProducts,
        ]);
    }
}
