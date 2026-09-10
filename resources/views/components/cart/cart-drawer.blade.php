@props([
'items' => [],
'subtotal' => 0,
'shipping' => 0,
'discount' => 0,
'total' => 0,
])

<div
    class="cart-drawer"
    data-cart-drawer
    hidden
>

    <div
        class="cart-drawer__panel"
        role="dialog"
        aria-modal="true"
        aria-labelledby="cart-drawer-title"
    >

        <header class="cart-drawer__header">

            <h2
                id="cart-drawer-title"
                class="cart-drawer__title"
            >
                سبد خرید
            </h2>

            <button
                type="button"
                class="icon-btn icon-btn--border"
                data-cart-close
                aria-label="بستن سبد خرید"
            >
                ×
            </button>

        </header>


        <div
            class="cart-drawer__body"
            data-cart-items
        >

            @forelse($items as $item)

                <x-cart.cart-item
                    :item="$item"
                />

            @empty

                <div class="empty-state">

                    <div class="empty-state__icon">
                        🛒
                    </div>

                    <h3 class="empty-state__title">
                        سبد خرید خالی است
                    </h3>

                    <p class="empty-state__text">
                        هنوز محصولی به سبد خرید اضافه نکرده‌اید.
                    </p>

                    <a
                        href="/shop"
                        class="btn btn--primary"
                    >
                        مشاهده محصولات
                    </a>

                </div>

            @endforelse

        </div>


        @if(count($items))

            <footer class="cart-drawer__footer">

                <x-cart.cart-summary
                    :subtotal="$subtotal"
                    :shipping="$shipping"
                    :discount="$discount"
                    :total="$total"
                />

                <div class="stack stack-3" style="margin-top: var(--space-5);">

                    <a
                        href="/cart"
                        class="btn btn--outline btn--full"
                    >
                        مشاهده سبد خرید
                    </a>

                    <a
                        href="/checkout"
                        class="btn btn--primary btn--full"
                    >
                        ادامه و پرداخت
                    </a>

                </div>

            </footer>

        @endif

    </div>

</div>
