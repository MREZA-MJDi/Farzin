@props([
'id' => null,
'name',
'image',
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
])

<article
    class="product-card"
    data-product-card
    @if($id) data-product-id="{{ $id }}" @endif
>

    <div class="product-card__media">

        @if($badge)
            <span class="product-card__badge">
                {{ $badge }}
            </span>
        @endif


        <button
            type="button"
            class="icon-btn icon-btn--border product-card__wishlist"
            aria-label="افزودن {{ $name }} به علاقه‌مندی‌ها"
            aria-pressed="{{ $isWishlisted ? 'true' : 'false' }}"
            data-wishlist
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


        <a
            href="{{ $href }}"
            class="product-card__image-link"
            aria-label="مشاهده {{ $name }}"
        >
            <div class="product-card__image">

                <img
                    src="{{ $image }}"
                    alt="{{ $name }}"
                    loading="lazy"
                >

            </div>
        </a>

    </div>


    <div class="product-card__content">

        @if($brand)
            <span class="product-card__brand">
                {{ $brand }}
            </span>
        @endif


        <h3 class="product-card__title">

            <a href="{{ $href }}">
                {{ $name }}
            </a>

        </h3>


        @if($meta)
            <p class="product-card__meta">
                {{ $meta }}
            </p>
        @endif


        @if($rating !== null)

            <div class="product-card__rating">

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


        <div class="product-card__bottom">

            <x-product.price
                :price="$price"
                :old-price="$oldPrice"
                :discount="$discount"
            />


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
                    <path d="M3 4H5L7.2 15.5H18L21 7H6"/>
                    <circle cx="9" cy="19" r="1.2"/>
                    <circle cx="17" cy="19" r="1.2"/>
                </svg>

            </button>

        </div>

    </div>

</article>
