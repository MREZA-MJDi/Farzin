@extends('layouts.app')

@section('title', 'فروشگاه هود و سینک | فرزین')

@section(
    'meta_description',
    'خرید هود و سینک از فرزین؛ بررسی محصولات، قیمت، مشخصات و انتخاب محصول مناسب برای آشپزخانه.'
)

@section('content')

    <main class="shop-page">

        <x-layout.breadcrumb
            :items="[
                ['label' => 'فروشگاه']
            ]"
        />


        <section class="section section--sm">

            <div class="container">

                <header class="page-header">

                    <span class="page-header__eyebrow">
                        فروشگاه
                    </span>

                    <h1 class="page-header__title">
                        هود و سینک
                    </h1>

                    <p class="page-header__description">
                        محصولات را بر اساس دسته‌بندی، برند و ویژگی‌های موردنظر خود پیدا کنید.
                    </p>

                </header>


                <div class="shop-layout">

                    <aside class="shop-layout__sidebar">

                        <x-shop.filters
                            :categories="[]"
                            :brands="[]"
                            :availability="[]"
                        />

                    </aside>


                    <div class="shop-layout__content">

                        <div class="shop-toolbar">

                            <div class="shop-toolbar__result">
                                <span>
                                    محصولات
                                </span>
                            </div>


                            <div class="shop-toolbar__actions">

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
                                    action="/shop"
                                >

                                    <x-shop.sort />

                                </form>

                            </div>

                        </div>


                        <x-product.product-grid>

                            {{-- Products will come from controller --}}

                        </x-product.product-grid>


                        {{-- Pagination will come from controller --}}

                    </div>

                </div>

            </div>

        </section>

    </main>

@endsection
