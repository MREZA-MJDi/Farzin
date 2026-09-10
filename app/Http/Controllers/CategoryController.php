<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::query()
            ->withCount([
                'products as active_products_count' => fn ($query) =>
                $query->where('is_active', true),
            ])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('pages.categories.index', [
            'categories' => $categories,
        ]);
    }

    public function store(
        StoreCategoryRequest $request
    ): RedirectResponse {
        Category::create(
            $request->validated()
        );

        return back()->with(
            'success',
            'دسته‌بندی با موفقیت ایجاد شد.'
        );
    }

    public function update(
        UpdateCategoryRequest $request,
        Category $category
    ): RedirectResponse {
        $category->update(
            $request->validated()
        );

        return back()->with(
            'success',
            'دسته‌بندی با موفقیت به‌روزرسانی شد.'
        );
    }

    public function destroy(
        Category $category
    ): RedirectResponse {
        $category->delete();

        return back()->with(
            'success',
            'دسته‌بندی با موفقیت حذف شد.'
        );
    }
}
