<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');


/*
|--------------------------------------------------------------------------
| Shop / Products
|--------------------------------------------------------------------------
*/

Route::get('/shop', [ProductController::class, 'index'])
    ->name('shop');

Route::get('/product/{slug}', [ProductController::class, 'show'])
    ->name('product.show');


/*
|--------------------------------------------------------------------------
| Categories
|--------------------------------------------------------------------------
*/

Route::get('/hood', function () {
    return redirect()->route('shop', [
        'category' => 'hood',
    ]);
})->name('category.hood');

Route::get('/sink', function () {
    return redirect()->route('shop', [
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
| Wishlist
|--------------------------------------------------------------------------
*/

Route::get('/wishlist', function () {
    return redirect()->route('shop');
})->name('wishlist');


/*
|--------------------------------------------------------------------------
| Payment
|--------------------------------------------------------------------------
*/

Route::get('/payment/success', function () {
    return view('pages.payment.success', [
        'order' => [],
    ]);
})->name('payment.success');

Route::get('/payment/failed', function () {
    return view('pages.payment.failed', [
        'order' => [],
        'payment' => [],
    ]);
})->name('payment.failed');

Route::get('/payment/cancelled', function () {
    return view('pages.payment.cancelled', [
        'order' => [],
    ]);
})->name('payment.cancelled');


/*
|--------------------------------------------------------------------------
| Blog
|--------------------------------------------------------------------------
*/

Route::get('/blog', function () {
    return view('pages.blog.index', [
        'posts' => [],
    ]);
})->name('blog.index');

Route::get('/blog/{slug}', function (string $slug) {
    return view('pages.blog.show', [
        'slug' => $slug,
        'post' => [],
        'relatedPosts' => [],
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
