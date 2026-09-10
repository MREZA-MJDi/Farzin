@extends('layouts.app')

@section('title', $product->name . ' | فرزین')

@section(
    'meta_description',
    $product->short_description
        ?: 'مشاهده مشخصات و قیمت ' . $product->name . ' در فروشگاه فرزین.'
)

@section('content')

    <main>

        <section class="section section--sm">

            <div class="container">

                <div class="section__inner">

                    <x-ui.breadcrumb
                        :items="[
                        [
                            'label' => $product->category->name,
                            'href' => route(
                                'category.show',
                                $product->category
                            ),
                        ],
                        [
                            'label' => $product->name,
                            'href' => route(
                                'product.show',
                                $product
                            ),
                        ],
                    ]"
                    />


                    <div class="product-page">

                        <div class="product-page__media">

                            <x-product.product-gallery
                                :images="$product->images"
                                :name="$product->name"
                            />

                        </div>


                        <div class="product-page__content">

                            @if($product->brand)

                                <span class="product-card__brand">
                                {{ $product->brand }}
                            </span>

                            @endif


                            <h1 class="product-page__title">
                                {{ $product->name }}
                            </h1>


                            @if($product->short_description)

                                <p class="product-page__description">
                                    {{ $product->short_description }}
                                </p>

                            @endif


                            @if($product->rating > 0)

                                <div
                                    class="product-card__rating"
                                    aria-label="امتیاز {{ $product->rating }} از ۵"
                                >

                                <span
                                    class="product-card__rating-stars"
                                    aria-hidden="true"
                                >
                                    ★
                                </span>

                                    <span>
                                    {{ $product->rating }}
                                </span>

                                    @if($product->review_count > 0)
                                        <span class="product-card__reviews">
                                        ({{ $product->review_count }})
                                    </span>
                                    @endif

                                </div>

                            @endif


                            <div class="product-page__price">

                                <x-product.price
                                    :price="$product->price"
                                    :old-price="$product->old_price"
                                    :discount="$product->discount
                                    ? $product->discount . '%'
                                    : null"
                                />

                            </div>


                            <div class="product-page__stock">

                                @if($product->stock > 0)

                                    <x-ui.badge
                                        variant="success"
                                        dot
                                    >
                                        موجود در انبار
                                    </x-ui.badge>

                                @else

                                    <x-ui.badge
                                        variant="danger"
                                        dot
                                    >
                                        ناموجود
                                    </x-ui.badge>

                                @endif

                            </div>


                            <div class="product-page__actions">

                                <button
                                    type="button"
                                    class="btn btn--primary btn--lg"
                                    data-add-to-cart
                                    data-product-id="{{ $product->id }}"
                                    @disabled($product->stock < 1)
                                    >
                                    افزودن به سبد خرید
                                </button>


                                <button
                                    type="button"
                                    class="icon-btn icon-btn--border icon-btn--lg"
                                    data-wishlist
                                    data-product-id="{{ $product->id }}"
                                    aria-label="افزودن {{ $product->name }} به علاقه‌مندی‌ها"
                                    aria-pressed="false"
                                >
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
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

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        @if($product->description)

            <section class="section section--top-none">

                <div class="container">

                    <div class="section__inner">

                        <header class="section-header">

                            <div class="section-header__content">

                            <span class="section-header__eyebrow">
                                معرفی محصول
                            </span>

                                <h2 class="section-header__title">
                                    درباره {{ $product->name }}
                                </h2>

                            </div>

                        </header>


                        <div class="section-content">

                            <article class="article-content">

                                {!! nl2br(e($product->description)) !!}

                            </article>

                        </div>

                    </div>

                </div>

            </section>

        @endif


        @if($relatedProducts->isNotEmpty())

            <section class="section section--top-none">

                <div class="container">

                    <div class="section__inner">

                        <x-ui.section-header
                            eyebrow="پیشنهاد فرزین"
                            title="محصولات مرتبط"
                            description="محصولات دیگری از همین دسته‌بندی را بررسی کنید."
                        />

                        <div class="section-content">

                            <x-product.product-grid :columns="4">

                                @foreach($relatedProducts as $relatedProduct)

                                    <x-product.product-card
                                        :id="$relatedProduct->id"
                                        :name="$relatedProduct->name"

                                        :image="$relatedProduct->primaryImage
                                        ? asset(
                                            'storage/' .
                                            $relatedProduct->primaryImage->image
                                        )
                                        : null"

                                        :alt="$relatedProduct->primaryImage?->alt"

                                        :href="route(
                                        'product.show',
                                        $relatedProduct
                                    )"

                                        :price="$relatedProduct->price"

                                        :old-price="$relatedProduct->old_price"

                                        :discount="$relatedProduct->discount
                                        ? $relatedProduct->discount . '%'
                                        : null"

                                        :brand="$relatedProduct->brand"

                                        :meta="$relatedProduct->short_description"

                                        :rating="$relatedProduct->rating"

                                        :review-count="$relatedProduct->review_count"
                                    />

                                @endforeach

                            </x-product.product-grid>

                        </div>

                    </div>

                </div>

            </section>

        @endif

    </main>

@endsection
