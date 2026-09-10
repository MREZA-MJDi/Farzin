@extends('layouts.app')

@section('title', 'فروشگاه هود و سینک | فرزین')

@section(
    'meta_description',
    'خرید هود و سینک از فرزین؛ بررسی محصولات، قیمت، مشخصات و انتخاب محصول مناسب برای آشپزخانه.'
)

@section('content')

    <main class="shop-page">

        <section class="section section--sm">

            <div class="container">

                <div class="section__inner">

                    <x-layout.breadcrumb
                        :items="[
                            ['label' => 'فروشگاه']
                        ]"
                    />

                    <header class="page-header">

                        <span class="page-header__eyebrow">
                            فروشگاه
                        </span>

                        <h1 class="page-header__title">
                            {{ $pageTitle ?? 'هود و سینک' }}
                        </h1>

                        <p class="page-header__description">
                            محصولات را بر اساس دسته‌بندی،
                            برند و ویژگی‌های موردنظر خود پیدا کنید.
                        </p>

                    </header>


                    <div class="shop__layout">

                        <aside class="shop__sidebar">

                            <x-shop.filters
                                :categories="$categories ?? []"
                                :brands="$brands ?? []"
                                :availability="$availability ?? []"
                            />

                        </aside>


                        <section class="shop__main">

                            <div class="shop__toolbar">

                                <div class="shop__result-count">

                                    <span>
                                        {{ $products->total() ?? count($products ?? []) }}
                                        محصول
                                    </span>

                                </div>


                                <div class="shop__actions">

                                    <button
                                        type="button"
                                        class="btn btn--outline shop-filter-trigger"
                                        data-shop-filter-toggle
                                    >
                                        فیلترها
                                    </button>


                                    <form
                                        id="shop-filters-form"
                                        method="GET"
                                        action="{{ route('shop') }}"
                                    >

                                        <x-shop.sort
                                            :current="request('sort', '')"
                                        />

                                    </form>

                                </div>

                            </div>


                            @if(isset($products) && count($products))

                                <x-product.product-grid
                                    columns="4"
                                >

                                    @foreach($products as $product)

                                        <x-product.product-card
                                            :id="$product['id']"
                                            :name="$product['name']"
                                            :image="$product['image']"
                                            :href="$product['url']"
                                            :price="$product['price']"
                                            :brand="$product['brand'] ?? null"
                                            :meta="$product['meta'] ?? null"
                                            :rating="$product['rating'] ?? null"
                                            :review-count="$product['review_count'] ?? 0"
                                            :badge="$product['badge'] ?? null"
                                        />

                                    @endforeach

                                </x-product.product-grid>


                                @isset($paginator)
                                    <x-shop.pagination
                                        :paginator="$paginator"
                                    />
                                @endisset

                            @else

                                <x-ui.empty-state
                                    title="محصولی پیدا نشد"
                                    description="فیلترها یا عبارت جستجو را تغییر دهید و دوباره امتحان کنید."
                                    class="shop__empty"
                                >
                                    <x-slot:icon>
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.7"
                                        >
                                            <circle cx="11" cy="11" r="6.5" />
                                            <path d="M16 16L21 21" />
                                        </svg>
                                    </x-slot:icon>

                                    <x-slot:action>
                                        <a
                                            href="{{ route('shop') }}"
                                            class="btn btn--primary"
                                        >
                                            مشاهده همه محصولات
                                        </a>
                                    </x-slot:action>
                                </x-ui.empty-state>

                            @endif

                        </section>

                    </div>

                </div>

            </div>

        </section>

    </main>

@endsection
