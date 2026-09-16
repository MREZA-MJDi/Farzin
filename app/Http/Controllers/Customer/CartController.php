<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * نمایش سبد خرید
     */
    public function index(): View
    {
        $user = Auth::user();

        $cart = Cart::query()
            ->firstOrCreate([
                'user_id' => $user->id,
            ]);

        /*
        |--------------------------------------------------------------------------
        | Load cart items
        |--------------------------------------------------------------------------
        */

        $cart->load([
            'items.product.category',
            'items.product.primaryImage',
            'items.product.images' => function ($query) {
                $query
                    ->orderBy('sort_order')
                    ->orderBy('id');
            },
        ]);

        /*
        |--------------------------------------------------------------------------
        | IMPORTANT
        |--------------------------------------------------------------------------
        | The Blade expects $items to be a Collection, not the Cart model.
        |--------------------------------------------------------------------------
        */

        $items = $cart->items;


        /*
        |--------------------------------------------------------------------------
        | Item count
        |--------------------------------------------------------------------------
        */

        $itemCount = (int) $items->sum('quantity');


        /*
        |--------------------------------------------------------------------------
        | Subtotal
        |--------------------------------------------------------------------------
        */

        $subtotal = (int) $items->sum(function ($item) {
            return (int) $item->unit_price * (int) $item->quantity;
        });


        return view('cart.index', [
            'cart' => $cart,
            'items' => $items,
            'itemCount' => $itemCount,
            'subtotal' => $subtotal,
        ]);
    }


    /**
     * افزودن محصول به سبد
     */
    public function add(
        Request $request
    ): RedirectResponse {

        $validated = $request->validate([
            'product_id' => [
                'required',
                'integer',
                'exists:products,id',
            ],

            'quantity' => [
                'required',
                'integer',
                'min:1',
                'max:99',
            ],
        ]);


        $product = Product::query()
            ->where('is_active', true)
            ->findOrFail($validated['product_id']);


        /*
        |--------------------------------------------------------------------------
        | Stock check
        |--------------------------------------------------------------------------
        */

        if ((int) $product->stock <= 0) {

            return back()->with(
                'error',
                'این محصول در حال حاضر موجود نیست.'
            );

        }


        $requestedQuantity =
            (int) $validated['quantity'];


        if ($requestedQuantity > (int) $product->stock) {

            return back()->with(
                'error',
                'تعداد انتخاب‌شده بیشتر از موجودی محصول است.'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Cart
        |--------------------------------------------------------------------------
        */

        $cart = Cart::query()
            ->firstOrCreate([
                'user_id' => Auth::id(),
            ]);


        /*
        |--------------------------------------------------------------------------
        | Existing item
        |--------------------------------------------------------------------------
        */

        $item = $cart->items()
            ->where('product_id', $product->id)
            ->first();


        if ($item) {

            $newQuantity =
                (int) $item->quantity +
                $requestedQuantity;


            if ($newQuantity > (int) $product->stock) {

                return back()->with(
                    'error',
                    'تعداد نهایی بیشتر از موجودی محصول است.'
                );

            }


            $item->update([
                'quantity' => $newQuantity,
                'unit_price' => $product->price,
            ]);

        } else {

            $cart->items()->create([
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_sku' => $product->sku,
                'unit_price' => $product->price,
                'quantity' => $requestedQuantity,
            ]);

        }


        return redirect()
            ->route('customer.cart.index')
            ->with(
                'success',
                'محصول به سبد خرید اضافه شد.'
            );
    }


    /**
     * بروزرسانی تعداد
     */
    public function update(
        Request $request,
        Product $product
    ): RedirectResponse {

        $validated = $request->validate([
            'product_id' => [
                'required',
                'integer',
                'exists:products,id',
            ],

            'quantity' => [
                'required',
                'integer',
                'min:1',
                'max:99',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Security
        |--------------------------------------------------------------------------
        */

        if ((int) $validated['product_id'] !== (int) $product->id) {

            abort(404);

        }


        /*
        |--------------------------------------------------------------------------
        | Product availability
        |--------------------------------------------------------------------------
        */

        if (
            !$product->is_active ||
            (int) $product->stock <= 0
        ) {

            return back()->with(
                'error',
                'این محصول دیگر قابل سفارش نیست.'
            );

        }


        $quantity =
            (int) $validated['quantity'];


        if ($quantity > (int) $product->stock) {

            return back()->with(
                'error',
                'تعداد انتخاب‌شده بیشتر از موجودی محصول است.'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Find cart
        |--------------------------------------------------------------------------
        */

        $cart = Cart::query()
            ->where('user_id', Auth::id())
            ->first();


        if (!$cart) {

            return redirect()
                ->route('customer.cart.index')
                ->with(
                    'error',
                    'سبد خرید پیدا نشد.'
                );

        }


        $item = $cart->items()
            ->where('product_id', $product->id)
            ->first();


        if (!$item) {

            return redirect()
                ->route('customer.cart.index')
                ->with(
                    'error',
                    'این محصول در سبد خرید وجود ندارد.'
                );

        }


        $item->update([
            'quantity' => $quantity,
            'unit_price' => $product->price,
            'product_name' => $product->name,
            'product_sku' => $product->sku,
        ]);


        return redirect()
            ->route('customer.cart.index')
            ->with(
                'success',
                'سبد خرید بروزرسانی شد.'
            );
    }


    /**
     * حذف یک محصول از سبد
     */
    public function remove(
        Product $product
    ): RedirectResponse {

        $cart = Cart::query()
            ->where('user_id', Auth::id())
            ->first();


        if ($cart) {

            $cart->items()
                ->where('product_id', $product->id)
                ->delete();

        }


        return redirect()
            ->route('customer.cart.index')
            ->with(
                'success',
                'محصول از سبد خرید حذف شد.'
            );
    }


    /**
     * خالی کردن کامل سبد
     */
    public function clear(): RedirectResponse
    {
        $cart = Cart::query()
            ->where('user_id', Auth::id())
            ->first();


        if ($cart) {

            $cart->items()->delete();

        }


        return redirect()
            ->route('customer.cart.index')
            ->with(
                'success',
                'سبد خرید خالی شد.'
            );
    }
}
