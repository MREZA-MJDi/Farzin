<?php

use App\Http\Controllers\Customer\CategoryController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\ProductController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Customer Storefront
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');


/*
|--------------------------------------------------------------------------
| Products
|--------------------------------------------------------------------------
*/

Route::get('/shop', [ProductController::class, 'index'])
    ->name('shop');

Route::get('/product/{product:slug}', [ProductController::class, 'show'])
    ->name('product.show');


/*
|--------------------------------------------------------------------------
| Categories
|--------------------------------------------------------------------------
*/

Route::get('/categories', [CategoryController::class, 'index'])
    ->name('categories.index');

Route::get('/category/{category:slug}', [CategoryController::class, 'show'])
    ->name('category.show');


/*
|--------------------------------------------------------------------------
| Header Category Shortcuts
|--------------------------------------------------------------------------
|
| Keep the clean public URLs used by the current Header.
|
*/

Route::get('/hood', function () {
    return redirect()->route('category.show', [
        'category' => 'hood',
    ]);
})->name('category.hood');


Route::get('/sink', function () {
    return redirect()->route('category.show', [
        'category' => 'sink',
    ]);
})->name('category.sink');


/*
|--------------------------------------------------------------------------
| Search
|--------------------------------------------------------------------------
*/

Route::get('/search', [ProductController::class, 'index'])
    ->name('search');


/*
|--------------------------------------------------------------------------
| Cart
|--------------------------------------------------------------------------
*/

Route::get('/cart', function () {
    return view('pages.cart');
})->name('cart');


/*
|--------------------------------------------------------------------------
| Wishlist
|--------------------------------------------------------------------------
*/

Route::get('/wishlist', function () {
    return redirect()->route('shop');
})->name('wishlist');


/*
|--------------------------------------------------------------------------
| Checkout
|--------------------------------------------------------------------------
*/

Route::get('/checkout', function () {
    return view('pages.checkout');
})->name('checkout');


Route::post('/checkout', function () {
    return redirect()->route('payment.success');
})->name('checkout.store');


/*
|--------------------------------------------------------------------------
| Payment
|--------------------------------------------------------------------------
*/

Route::get('/payment/success', function () {
    return view('pages.payment.success', [
        'order' => null,
    ]);
})->name('payment.success');


Route::get('/payment/failed', function () {
    return view('pages.payment.failed', [
        'order' => null,
        'payment' => null,
    ]);
})->name('payment.failed');


Route::get('/payment/cancelled', function () {
    return view('pages.payment.cancelled', [
        'order' => null,
    ]);
})->name('payment.cancelled');


/*
|--------------------------------------------------------------------------
| Blog
|--------------------------------------------------------------------------
*/

Route::get('/blog', function () {
    return view('pages.blog.index', [
        'posts' => collect(),
    ]);
})->name('blog.index');


Route::get('/blog/{slug}', function (string $slug) {
    return view('pages.blog.show', [
        'slug' => $slug,
        'post' => null,
        'relatedPosts' => collect(),
    ]);
})->name('blog.show');


/*
|--------------------------------------------------------------------------
| Static Pages
|--------------------------------------------------------------------------
*/

Route::get('/about', function () {
    return view('pages.about');
})->name('about');


Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');


/*
|--------------------------------------------------------------------------
| Newsletter
|--------------------------------------------------------------------------
*/

Route::post('/newsletter', function () {
    return back()->with(
        'success',
        'عضویت شما با موفقیت انجام شد.'
    );
})->name('newsletter.subscribe');
