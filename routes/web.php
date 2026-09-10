<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


// =====================================================
// HOME
// =====================================================

Route::get('/', function () {
    return view('pages.home');
})->name('home');


// =====================================================
// SHOP
// =====================================================

Route::get('/shop', function () {
    return view('pages.shop');
})->name('shop');


// =====================================================
// PRODUCT
// =====================================================

Route::get('/product/{slug}', function (string $slug) {
    return view('pages.product', [
        'slug' => $slug,
    ]);
})->name('product.show');


// =====================================================
// CATEGORY
// =====================================================

Route::get('/hood', function () {
    return view('pages.shop', [
        'category' => 'hood',
    ]);
})->name('category.hood');


Route::get('/sink', function () {
    return view('pages.shop', [
        'category' => 'sink',
    ]);
})->name('category.sink');


// =====================================================
// SEARCH
// =====================================================

Route::get('/search', function () {
    return view('pages.shop', [
        'search' => request('q'),
    ]);
})->name('search');


// =====================================================
// CART
// =====================================================

Route::get('/cart', function () {
    return view('pages.cart', [
        'items' => [],
        'subtotal' => 0,
        'shipping' => 0,
        'discount' => 0,
        'total' => 0,
    ]);
})->name('cart');


// =====================================================
// CHECKOUT
// =====================================================

Route::get('/checkout', function () {
    return view('pages.checkout', [
        'items' => [],
        'subtotal' => 0,
        'shipping' => 0,
        'discount' => 0,
        'total' => 0,
    ]);
})->name('checkout');


// =====================================================
// CHECKOUT SUBMIT
// =====================================================

Route::post('/checkout', function () {
    return redirect()->route('payment.success');
})->name('checkout.store');


// =====================================================
// WISHLIST
// =====================================================

Route::get('/wishlist', function () {
    return view('pages.shop', [
        'wishlist' => true,
    ]);
})->name('wishlist');


// =====================================================
// PAYMENT
// =====================================================

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


// =====================================================
// BLOG
// =====================================================

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


// =====================================================
// STATIC PAGES
// =====================================================

Route::get('/about', function () {
    return view('pages.about');
})->name('about');


Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');


// =====================================================
// NEWSLETTER
// =====================================================

Route::post('/newsletter', function () {
    return back()->with(
        'success',
        'عضویت شما با موفقیت انجام شد.'
    );
})->name('newsletter.subscribe');
