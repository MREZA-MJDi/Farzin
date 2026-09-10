@props([
'id' => null,
'name',
'image' => 'https://images.unsplash.com/photo-1556911220-e15b29be8c8f?auto=format&fit=crop&w=1200&q=85',
'href' => '#',
'price',
'oldPrice' => null,
'discount' => null,
'brand' => null,
'meta' => null,
'rating' => null,
'reviewCount' => null,
'badge' => null,
'isWishlisted' => false,
'alt' => null,
])

<article
    {{ $attributes->merge([
        'class' => 'product-card',
    ]) }}
    data-product-card
    @if($id)
    data-product-id="{{ $id }}"
    @endif
>

    {{-- =====================================================
         MEDIA
    ====================================================== --}}
    <div class="product-card__media">

        @if($badge)
            <span class="product-card__badge">
                {{ $badge }}
            </span>
        @endif


        {{-- Wishlist --}}
        <button
            type="button"
            class="icon-btn icon-btn--border product-card__wishlist"
            aria-label="{{ $isWishlisted
                ? 'حذف ' . $name . ' از علاقه‌مندی‌ها'
                : 'افزودن ' . $name . ' به علاقه‌مندی‌ها'
            }}"
            aria-pressed="{{ $isWishlisted ? 'true' : 'false' }}"
            data-wishlist
            @if($id)
            data-product-id="{{ $id }}"
            @endif
        >
            <svg
                viewBox="0 0 24 24"
                fill="{{ $isWishlisted ? 'currentColor' : 'none' }}"
                stroke="currentColor"
                stroke-width="1.7"
                aria-hidden="true"
            >
                <path
                    d="M20.8 8.7C20.8 13.7 12 19 12 19S3.2 13.7 3.2 8.7C3.2 6 5.2 4 7.8 4C9.5 4 11 4.9 12 6.2C13 4.9 14.5 4 16.2 4C18.8 4 20.8 6 20.8 8.7Z"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
        </button>


        {{-- Product Image --}}
        <a
            href="{{ $href }}"
            class="product-card__image-link"
            aria-label="مشاهده {{ $name }}"
        >
            <div class="product-card__image">

                <img
                    src="{{ $image }}"
                    alt="{{ $alt ?? $name }}"
                    width="800"
                    height="800"
                    loading="lazy"
                    decoding="async"
                >

            </div>
        </a>

    </div>


    {{-- =====================================================
         CONTENT
    ====================================================== --}}
    <div class="product-card__content">

        {{-- Brand --}}
        @if($brand)
            <span class="product-card__brand">
                {{ $brand }}
            </span>
        @endif


        {{-- Title --}}
        <h3 class="product-card__title">
            <a href="{{ $href }}">
                {{ $name }}
            </a>
        </h3>


        {{-- Meta --}}
        @if($meta)
            <p class="product-card__meta">
                {{ $meta }}
            </p>
        @endif


        {{-- Rating --}}
        @if($rating !== null)

            <div
                class="product-card__rating"
                aria-label="امتیاز {{ $rating }} از ۵"
            >

                <span
                    class="product-card__rating-stars"
                    aria-hidden="true"
                >
                    ★
                </span>

                <span>
                    {{ $rating }}
                </span>

                @if($reviewCount !== null)
                    <span class="product-card__reviews">
                        ({{ $reviewCount }})
                    </span>
                @endif

            </div>

        @endif


        {{-- Bottom --}}
        <div class="product-card__bottom">

            <x-product.price
                :price="$price"
                :old-price="$oldPrice"
                :discount="$discount"
            />


            {{-- Add to Cart --}}
            <button
                type="button"
                class="product-card__add"
                aria-label="افزودن {{ $name }} به سبد خرید"
                data-add-to-cart
                @if($id)
                data-product-id="{{ $id }}"
                @endif
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.7"
                    aria-hidden="true"
                >
                    <path d="M3 4H5L7.2 15.5H18L21 7H6" />
                    <circle cx="9" cy="19" r="1.2" />
                    <circle cx="17" cy="19" r="1.2" />
                </svg>

            </button>

        </div>

    </div>

</article>

