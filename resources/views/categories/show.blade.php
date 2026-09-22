@extends('layouts.app')

@section(
    'title',
    ($category->meta_title ?: $category->name) . ' | ژنان'
)

@section(
    'meta_description',
    $category->meta_description
        ?: ($category->description ?: 'محصولات ' . $category->name . ' در ژنان.')
)

@section(
    'canonical_url',
    $category->canonical_url ?: url()->current()
)

@section('content')

    <div class="min-h-screen bg-[var(--background)]">

        {{-- =========================================================
            PAGE
        ========================================================== --}}

        <section class="mx-auto max-w-7xl px-4 py-7 sm:px-6 sm:py-10 lg:px-8 lg:py-12">

            {{-- =====================================================
                BREADCRUMB
            ====================================================== --}}

            <nav
                class="flex flex-wrap items-center gap-x-2 gap-y-1 text-[10px] text-[var(--text-muted)] sm:text-xs"
                aria-label="مسیر صفحه"
            >

                <a
                    href="{{ route('home') }}"
                    class="transition hover:text-[var(--primary)]"
                >
                    خانه
                </a>

                <svg
                    class="h-3.5 w-3.5 text-[var(--text-muted)]/60"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    aria-hidden="true"
                >
                    <path d="m9 18 6-6-6-6"/>
                </svg>

                <a
                    href="{{ route('shop.index') }}"
                    class="transition hover:text-[var(--primary)]"
                >
                    فروشگاه
                </a>

                <svg
                    class="h-3.5 w-3.5 text-[var(--text-muted)]/60"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    aria-hidden="true"
                >
                    <path d="m9 18 6-6-6-6"/>
                </svg>

                <span class="max-w-[240px] truncate font-bold text-[var(--text-secondary)]">
                    {{ $category->name }}
                </span>

            </nav>


            {{-- =====================================================
                CATEGORY HERO
            ====================================================== --}}

            <section class="janan-category-hero">

                {{-- Ambient background --}}
                <div
                    class="janan-category-hero__orb janan-category-hero__orb--one"
                    aria-hidden="true"
                ></div>

                <div
                    class="janan-category-hero__orb janan-category-hero__orb--two"
                    aria-hidden="true"
                ></div>


                <div class="janan-category-hero__inner">

                    {{-- =================================================
                        COPY
                    ================================================== --}}

                    <div class="janan-category-hero__content">

                        <div class="janan-category-hero__eyebrow">

                            <span></span>

                            JANAN COLLECTION

                        </div>


                        <h1 class="janan-category-hero__title">
                            {{ $category->name }}
                        </h1>


                        @if($category->description)

                            <p class="janan-category-hero__description">
                                {{ $category->description }}
                            </p>

                        @else

                            <p class="janan-category-hero__description">
                                مجموعه‌ای از انتخاب‌های ژنان برای
                                ظرافت، راحتی و حس بهتر در هر روز.
                            </p>

                        @endif


                        <div class="janan-category-hero__meta">

                            <div class="janan-category-hero__meta-item">

                                <span class="janan-category-hero__meta-number">
                                    {{ str_pad($products->total(), 2, '0', STR_PAD_LEFT) }}
                                </span>

                                <span class="janan-category-hero__meta-label">
                                    PRODUCTS
                                </span>

                            </div>


                            <span class="janan-category-hero__divider"></span>


                            <div class="janan-category-hero__meta-item">

                                <span class="janan-category-hero__meta-number">
                                    2026
                                </span>

                                <span class="janan-category-hero__meta-label">
                                    COLLECTION
                                </span>

                            </div>

                        </div>


                        <a
                            href="{{ route('shop.index', ['category' => $category->slug]) }}"
                            class="janan-category-hero__button"
                        >
                            مشاهده مجموعه

                            <svg
                                width="16"
                                height="16"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                aria-hidden="true"
                            >
                                <path d="M5 12h14"/>
                                <path d="m13 6 6 6-6 6"/>
                            </svg>

                        </a>

                    </div>


                    {{-- =================================================
                        IMAGE
                    ================================================== --}}

                    <div class="janan-category-hero__visual">

                        <div class="janan-category-hero__visual-bg"></div>

                        @if($category->image)

                            <img
                                src="{{ asset('storage/' . ltrim($category->image, '/')) }}"
                                alt="{{ $category->name }}"
                                class="janan-category-hero__image"
                                loading="eager"
                                decoding="async"
                            >

                        @else

                            <div class="janan-category-hero__placeholder">

                                <div class="janan-category-hero__placeholder-mark">
                                    JANAN
                                </div>

                                <span>
                                    COLLECTION
                                </span>

                            </div>

                        @endif


                        <div class="janan-category-hero__image-tag">
                            {{ str_pad($products->total(), 2, '0', STR_PAD_LEFT) }}
                            PIECES
                        </div>

                    </div>

                </div>

            </section>


            {{-- =====================================================
                PRODUCTS HEADER
            ====================================================== --}}

            <div class="janan-category-products-head">

                <div>

                    <div class="janan-category-products-eyebrow">
                        <span></span>
                        THE COLLECTION
                    </div>

                    <h2>
                        انتخاب‌های
                        <span>{{ $category->name }}</span>
                    </h2>

                    <p>
                        مجموعه‌ای از محصولات این دسته را بررسی کن
                        و چیزی را پیدا کن که بیشتر شبیه خودت است.
                    </p>

                </div>


                <div class="janan-category-results">

                    <span></span>

                    {{ number_format($products->total()) }}

                    محصول

                </div>

            </div>


            {{-- =====================================================
                PRODUCTS
            ====================================================== --}}

            @if($products->count())

                <div class="mt-7 grid grid-cols-2 gap-x-3 gap-y-7 sm:gap-x-4 sm:gap-y-9 md:grid-cols-3 lg:grid-cols-4">

                    @foreach($products as $product)

                        @include('partials.product_card', [
                            'product' => $product
                        ])

                    @endforeach

                </div>


                {{-- =================================================
                    PAGINATION
                ================================================== --}}

                @if($products->hasPages())

                    <div class="mt-12 flex justify-center">

                        <div class="pagination">
                            {{ $products->onEachSide(1)->links() }}
                        </div>

                    </div>

                @endif


            @else

                {{-- =================================================
                    EMPTY STATE
                ================================================== --}}

                <div class="janan-category-empty">

                    <div class="janan-category-empty__glow"></div>

                    <div class="janan-category-empty__icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.4"
                            aria-hidden="true"
                        >
                            <rect
                                x="4"
                                y="4"
                                width="16"
                                height="16"
                                rx="2"
                            />
                            <path d="M8 9h8"/>
                            <path d="M8 13h5"/>
                            <path d="M8 17h7"/>
                        </svg>

                    </div>


                    <span class="janan-category-empty__eyebrow">
                        JANAN COLLECTION
                    </span>


                    <h3>
                        این مجموعه فعلاً خالی است.
                    </h3>


                    <p>
                        محصولات تازه به‌مرور به ژنان اضافه می‌شوند.
                        مجموعه‌های دیگر را هم می‌توانی ببینی.
                    </p>


                    <a
                        href="{{ route('shop.index') }}"
                        class="janan-category-empty__button"
                    >
                        بازگشت به فروشگاه

                        <svg
                            width="15"
                            height="15"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <path d="M5 12h14"/>
                            <path d="m13 6 6 6-6 6"/>
                        </svg>

                    </a>

                </div>

            @endif

        </section>


        {{-- =========================================================
            BOTTOM EDITORIAL CTA
        ========================================================== --}}

        <section class="janan-category-cta">

            <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">

                <div class="janan-category-cta__box">

                    <div class="janan-category-cta__orb"></div>


                    <div class="janan-category-cta__content">

                        <span>
                            JANAN
                        </span>

                        <h2>
                            چیزی که انتخاب می‌کنی،
                            بخشی از حس توست.
                        </h2>

                        <p>
                            مجموعه‌های ژنان را ببین و انتخابی پیدا کن
                            که با تو و سبک تو هماهنگ باشد.
                        </p>

                    </div>


                    <a
                        href="{{ route('shop.index') }}"
                        class="janan-category-cta__button"
                    >
                        کشف همه محصولات

                        <svg
                            width="16"
                            height="16"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <path d="M5 12h14"/>
                            <path d="m13 6 6 6-6 6"/>
                        </svg>

                    </a>

                </div>

            </div>

        </section>

    </div>

@endsection
