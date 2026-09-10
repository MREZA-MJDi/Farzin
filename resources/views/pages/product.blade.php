@extends('layouts.app')

@section(
    'title',
    ($product['name'] ?? 'محصول') . ' | فرزین'
)

@section(
    'meta_description',
    $product['meta_description']
        ?? 'مشخصات، قیمت و اطلاعات محصول در فرزین.'
)

@section('content')

    <main class="product-page">

        <x-layout.breadcrumb
            :items="[
                [
                    'label' => $product['category_name'] ?? 'محصولات',
                    'url' => $product['category_url'] ?? '/shop'
                ],
                [
                    'label' => $product['name'] ?? 'محصول'
                ]
            ]"
        />


        <section class="section section--sm">

            <div class="container">

                <article class="product-detail">

                    <div class="product-detail__gallery">

                        <x-product.product-gallery
                            :images="$product['images'] ?? []"
                            :name="$product['name'] ?? ''"
                        />

                    </div>


                    <div class="product-detail__info">

                        @if(!empty($product['brand']))
                            <span class="product-detail__brand">
                                {{ $product['brand'] }}
                            </span>
                        @endif


                        <h1 class="product-detail__title">
                            {{ $product['name'] ?? '' }}
                        </h1>


                        @if(!empty($product['short_description']))
                            <p class="product-detail__description">
                                {{ $product['short_description'] }}
                            </p>
                        @endif


                        @if(isset($product['rating']))
                            <div class="product-detail__rating">
                                <span
                                    class="product-card__rating-stars"
                                    aria-hidden="true"
                                >
                                    ★
                                </span>

                                <strong>
                                    {{ $product['rating'] }}
                                </strong>

                                @if(isset($product['review_count']))
                                    <span>
                                        ({{ $product['review_count'] }} نظر)
                                    </span>
                                @endif
                            </div>
                        @endif


                        <x-product.price
                            :price="$product['price'] ?? 0"
                            :old-price="$product['old_price'] ?? null"
                            :discount="$product['discount'] ?? null"
                        />


                        @if(($product['in_stock'] ?? false))

                            <div class="product-detail__stock">
                                <x-ui.badge
                                    variant="success"
                                    dot
                                >
                                    موجود
                                </x-ui.badge>
                            </div>

                        @else

                            <div class="product-detail__stock">
                                <x-ui.badge
                                    variant="danger"
                                >
                                    ناموجود
                                </x-ui.badge>
                            </div>

                        @endif


                        @if(($product['in_stock'] ?? false))

                            <div class="product-detail__purchase">

                                <x-product.quantity
                                    name="quantity"
                                    :value="1"
                                    :min="1"
                                    :max="$product['stock'] ?? 99"
                                />


                                <button
                                    type="button"
                                    class="btn btn--primary btn--lg"
                                    data-add-to-cart
                                    data-product-id="{{ $product['id'] ?? '' }}"
                                >
                                    افزودن به سبد خرید
                                </button>

                            </div>

                        @else

                            <button
                                type="button"
                                class="btn btn--secondary btn--lg"
                                disabled
                            >
                                در حال حاضر موجود نیست
                            </button>

                        @endif


                        <div class="product-detail__trust">

                            <div class="product-trust-item">
                                <strong>ارسال</strong>
                                <span>سراسر کشور</span>
                            </div>

                            <div class="product-trust-item">
                                <strong>پشتیبانی</strong>
                                <span>قبل و بعد از خرید</span>
                            </div>

                            <div class="product-trust-item">
                                <strong>پرداخت</strong>
                                <span>امن و آنلاین</span>
                            </div>

                        </div>

                    </div>

                </article>


                <div class="product-detail__sections">

                    @if(!empty($product['description']))

                        <section class="product-content-section">

                            <h2>
                                توضیحات محصول
                            </h2>

                            <div class="product-content-section__body">
                                {!! $product['description'] !!}
                            </div>

                        </section>

                    @endif


                    @if(!empty($product['specifications']))

                        <section class="product-content-section">

                            <h2>
                                مشخصات محصول
                            </h2>

                            <div class="specifications">

                                @foreach($product['specifications'] as $spec)

                                    <div class="specification">

                                        <span>
                                            {{ $spec['label'] }}
                                        </span>

                                        <strong>
                                            {{ $spec['value'] }}
                                        </strong>

                                    </div>

                                @endforeach

                            </div>

                        </section>

                    @endif


                    @if(!empty($product['faq']))

                        <section class="product-content-section">

                            <h2>
                                سوالات متداول
                            </h2>

                            <div class="faq-list">

                                @foreach($product['faq'] as $item)

                                    <details class="faq-item">

                                        <summary>
                                            {{ $item['question'] }}
                                        </summary>

                                        <div>
                                            {{ $item['answer'] }}
                                        </div>

                                    </details>

                                @endforeach

                            </div>

                        </section>

                    @endif

                </div>

            </div>

        </section>

    </main>

@endsection
