<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\AddressRequest;
use App\Http\Requests\Customer\CheckoutRequest;
use App\Models\Address;
use App\Services\CartService;
use App\Services\CheckoutService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CheckoutController extends Controller
{
    public function __construct(
        protected CartService $cartService,
        protected CheckoutService $checkoutService,
    ) {
    }

    /**
     * Checkout page.
     */
    public function index(): View|RedirectResponse
    {
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | Checkout summary
        |--------------------------------------------------------------------------
        |
        | CheckoutService::summary() already returns normalized checkout items.
        |
        */

        $summary = $this->checkoutService->summary($user);

        $itemCount = (int) ($summary['item_count'] ?? 0);

        /*
        |--------------------------------------------------------------------------
        | Empty cart
        |--------------------------------------------------------------------------
        */

        if ($itemCount === 0) {
            return redirect()
                ->route('customer.cart.index')
                ->with(
                    'error',
                    'سبد خرید شما خالی است.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Checkout items
        |--------------------------------------------------------------------------
        */

        $items = $summary['items'] ?? collect();

        /*
        |--------------------------------------------------------------------------
        | User addresses
        |--------------------------------------------------------------------------
        */

        $addresses = $user
            ->addresses()
            ->orderByDesc('is_default')
            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | View
        |--------------------------------------------------------------------------
        */

        return view(
            'checkout.index',
            compact(
                'items',
                'itemCount',
                'addresses',
                'summary'
            )
        );
    }

    /**
     * Store a new shipping address from checkout.
     */
    public function storeAddress(
        AddressRequest $request
    ): RedirectResponse {
        $user = $request->user();

        /*
        |--------------------------------------------------------------------------
        | Determine default address
        |--------------------------------------------------------------------------
        |
        | First address automatically becomes default.
        | Otherwise, user can explicitly select it as default.
        |
        */


        $isFirstAddress = ! $user
            ->addresses()
            ->exists();

        $isDefault =
            $request->boolean('is_default') ||
            $isFirstAddress;

        /*
        |--------------------------------------------------------------------------
        | Create address
        |--------------------------------------------------------------------------
        */

        $address = Address::create([
            'user_id' => $user->id,

            'title' => $request
                ->string('title')
                ->toString(),

            'full_name' => $request
                ->string('full_name')
                ->toString(),

            'phone' => $request
                ->string('phone')
                ->toString(),

            'country' => $request
                ->string('country')
                ->toString(),

            'province' => $request
                ->string('province')
                ->toString(),

            'city' => $request
                ->string('city')
                ->toString(),

            'postal_code' => $request
                ->string('postal_code')
                ->toString(),

            'address' => $request
                ->string('address')
                ->toString(),

            'latitude' => $request->input('latitude'),

            'longitude' => $request->input('longitude'),

            'is_default' => false,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Make default
        |--------------------------------------------------------------------------
        */

        if ($isDefault) {
            $address->makeDefault();
        }

        /*
        |--------------------------------------------------------------------------
        | Back to checkout
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('customer.checkout.index')
            ->with(
                'success',
                'آدرس با موفقیت ثبت شد.'
            );
    }

    /**
     * Create order and continue to payment.
     */
    public function store(
        CheckoutRequest $request
    ): RedirectResponse {
        $validated = $request->validated();

        /*
        |--------------------------------------------------------------------------
        | Address ownership
        |--------------------------------------------------------------------------
        |
        | The selected address must belong to the authenticated user.
        |
        */

        $address = Address::query()
            ->where(
                'user_id',
                $request->user()->id
            )
            ->findOrFail(
                $validated['address_id']
            );

        /*
        |--------------------------------------------------------------------------
        | Create order
        |--------------------------------------------------------------------------
        */

        try {
            $order = $this->checkoutService->createOrder(
                $request->user(),
                $address,
                $validated['notes'] ?? null
            );
        } catch (\RuntimeException $e) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Continue to payment
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'customer.payment.start',
                $order
            )
            ->with(
                'success',
                'سفارش شما با موفقیت ثبت شد. در حال انتقال به پرداخت...'
            );
    }
}
