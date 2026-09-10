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

        <section class="section section--sm">

            <div class="container">

                <div class="section__inner">

                    <x-layout.breadcrumb
                        :items="[
                            [
                                'label' => $product['category_name'] ?? 'محصولات',
                                'href' => $product['category_url']
                                    ?? route('shop')
                            ],
                            [
                                'label' => $product['name'] ?? 'محصول'
                            ]
                        ]"
                    />


                    <div class="grid grid-cols-2 gap-8">

                        {{-- Gallery --}}
                        <div>

                            <x-product.product-gallery
                                :images="$product['images'] ?? []"
                                :name="$product['name'] ?? ''"
                            />

                        </div>


                        {{-- Product Info --}}
                        <article class="card card--padded">

                            <div class="stack stack--lg">

                                @if(!empty($product['brand']))

                                    <span class="text-accent text-sm font-semibold">
                                        {{ $product['brand'] }}
                                    </span>

                                @endif


                                <div class="stack stack--sm">

                                    <h1>
                                        {{ $product['name'] ?? '' }}
                                    </h1>

                                    @if(!empty($product['short_description']))
                                        <p>
                                            {{ $product['short_description'] }}
                                        </p>
                                    @endif

                                </div>


                                @if(isset($product['rating']))

                                    <div class="inline inline--sm">

                                        <span
                                            class="text-accent"
                                            aria-hidden="true"
                                        >
                                            ★
                                        </span>

                                        <strong>
                                            {{ $product['rating'] }}
                                        </strong>

                                        @if(isset($product['review_count']))
                                            <span class="text-muted text-sm">
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

                                    <x-ui.badge
                                        variant="success"
                                        dot
                                    >
                                        موجود
                                    </x-ui.badge>

                                    <div class="inline inline--md">

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

                                    <x-ui.badge variant="danger">
                                        ناموجود
                                    </x-ui.badge>

                                    <button
                                        type="button"
                                        class="btn btn--outline btn--lg"
                                        disabled
                                    >
                                        در حال حاضر موجود نیست
                                    </button>

                                @endif


                                <div class="grid grid-cols-3 gap-4">

                                    <div class="card card--padded">
                                        <strong class="text-sm">
                                            ارسال
                                        </strong>

                                        <span class="text-muted text-xs">
                                            سراسر کشور
                                        </span>
                                    </div>

                                    <div class="card card--padded">
                                        <strong class="text-sm">
                                            پشتیبانی
                                        </strong>

                                        <span class="text-muted text-xs">
                                            قبل و بعد از خرید
                                        </span>
                                    </div>

                                    <div class="card card--padded">
                                        <strong class="text-sm">
                                            پرداخت
                                        </strong>

                                        <span class="text-muted text-xs">
                                            امن و آنلاین
                                        </span>
                                    </div>

                                </div>

                            </div>

                        </article>

                    </div>


                    @if(
                        !empty($product['description'])
                        || !empty($product['specifications'])
                        || !empty($product['faq'])
                    )

                        <div class="grid grid-cols-2 gap-8">

                            <div class="stack stack--lg">

                                @if(!empty($product['description']))

                                    <section class="card card--padded">

                                        <div class="stack stack--md">

                                            <h2>
                                                توضیحات محصول
                                            </h2>

                                            <div>
                                                {!! $product['description'] !!}
                                            </div>

                                        </div>

                                    </section>

                                @endif


                                @if(!empty($product['faq']))

                                    <section class="card card--padded">

                                        <div class="stack stack--md">

                                            <h2>
                                                سوالات متداول
                                            </h2>

                                            <div class="stack stack--sm">

                                                @foreach($product['faq'] as $item)

                                                    <details class="card card--padded">

                                                        <summary>
                                                            {{ $item['question'] }}
                                                        </summary>

                                                        <p>
                                                            {{ $item['answer'] }}
                                                        </p>

                                                    </details>

                                                @endforeach

                                            </div>

                                        </div>

                                    </section>

                                @endif

                            </div>


                            @if(!empty($product['specifications']))

                                <section class="card card--padded">

                                    <div class="stack stack--md">

                                        <h2>
                                            مشخصات محصول
                                        </h2>

                                        <div class="stack stack--sm">

                                            @foreach($product['specifications'] as $spec)

                                                <div class="inline inline--md justify-between">

                                                    <span class="text-muted">
                                                        {{ $spec['label'] }}
                                                    </span>

                                                    <strong>
                                                        {{ $spec['value'] }}
                                                    </strong>

                                                </div>

                                            @endforeach

                                        </div>

                                    </div>

                                </section>

                            @endif

                        </div>

                    @endif

                </div>

            </div>

        </section>

    </main>

@endsection
