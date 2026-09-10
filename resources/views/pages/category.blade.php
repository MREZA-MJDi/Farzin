@extends('layouts.app')

@section('title', $category->name . ' | فرزین')

@section(
    'meta_description',
    $category->description
        ?: 'مشاهده محصولات ' . $category->name . ' در فروشگاه فرزین.'
)

@section('content')

    <main>

        <section class="section section--sm">

            <div class="container">

                <div class="section__inner">

                    <x-ui.breadcrumb
                        :items="[
                        [
                            'label' => $category->name,
                            'href' => route('category.show', $category),
                        ],
                    ]"
                    />

                    <header class="page-header">

                    <span class="page-header__eyebrow">
                        دسته‌بندی محصولات
                    </span>

                        <h1 class="page-header__title">
                            {{ $category->name }}
                        </h1>

                        @if($category->description)
                            <p class="page-header__description">
                                {{ $category->description }}
                            </p>
                        @endif

                    </header>

                </div>

            </div>

        </section>


        <section class="section section--top-none">

            <div class="container">

                <div class="section-content">

                    @if($products->count())

                        <x-product.product-grid :columns="4">

                            @foreach($products as $product)

                                <x-product.product-card
                                    :id="$product->id"
                                    :name="$product->name"

                                    :image="$product->primaryImage
                                    ? asset('storage/' . $product->primaryImage->image)
                                    : null"

                                    :alt="$product->primaryImage?->alt"

                                    :href="route('product.show', $product)"

                                    :price="$product->price"

                                    :old-price="$product->old_price"

                                    :discount="$product->discount
                                    ? $product->discount . '%'
                                    : null"

                                    :brand="$product->brand"

                                    :meta="$product->short_description"

                                    :rating="$product->rating"

                                    :review-count="$product->review_count"

                                    :badge="$product->is_featured
                                    ? 'منتخب'
                                    : null"
                                />

                            @endforeach

                        </x-product.product-grid>

                        <div class="pagination">
                            {{ $products->links('components.shop.pagination') }}
                        </div>

                    @else

                        <x-ui.empty-state
                            title="محصولی در این دسته‌بندی وجود ندارد"
                            description="در حال حاضر محصول فعالی برای این دسته‌بندی ثبت نشده است."
                        >
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

                </div>

            </div>

        </section>

    </main>

@endsection

