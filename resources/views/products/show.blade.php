@extends('layouts.app')

@section('title', $product->meta_title ?: $product->name . ' | ژنان')

@section(
    'meta_description',
    $product->meta_description ?: ($product->short_description ?: $product->name)
)

@section('canonical_url', $product->canonical_url ?: url()->current())

@section('content')

    @php
        /*
        |--------------------------------------------------------------------------
        | Discount
        |--------------------------------------------------------------------------
        */

        $hasDiscount =
            $product->old_price &&
            $product->old_price > $product->price;

        $discountAmount = $hasDiscount
            ? $product->old_price - $product->price
            : 0;

        $calculatedDiscount = $hasDiscount && $product->old_price > 0
            ? round(
                (($product->old_price - $product->price) / $product->old_price) * 100
            )
            : 0;

        $displayDiscount =
            $calculatedDiscount ?: (int) $product->discount;


        /*
        |--------------------------------------------------------------------------
        | Gallery
        |--------------------------------------------------------------------------
        */

        $galleryImages = $product->images
            ->sortBy([
                ['is_primary', 'desc'],
                ['sort_order', 'asc'],
                ['id', 'asc'],
            ])
            ->values();

        $firstImage = $galleryImages->first();

        $galleryData = $galleryImages
            ->map(fn ($image) => [
                'id' => (int) $image->id,
                'url' => asset(
                    'storage/' . ltrim($image->image, '/')
                ),
                'alt' => $image->alt ?: $product->name,
            ])
            ->values();


        /*
        |--------------------------------------------------------------------------
        | Availability
        |--------------------------------------------------------------------------
        */

        $isAvailable =
            (bool) $product->is_active &&
            (int) $product->stock > 0;

        $isLowStock =
            $isAvailable &&
            (int) $product->stock <= 5;
    @endphp


    <div class="min-h-screen bg-[var(--background)]">


        {{-- =========================================================
            BREADCRUMB
        ========================================================== --}}

        <div class="mx-auto max-w-[1380px] px-4 pt-5 sm:px-6 lg:px-8">

            <nav
                class="flex items-center gap-2 overflow-hidden text-[10px] text-[var(--text-muted)] sm:text-[11px]"
                aria-label="مسیر صفحه"
            >

                <a
                    href="{{ route('home') }}"
                    class="shrink-0 transition hover:text-[var(--primary)]"
                >
                    خانه
                </a>

                <span class="text-[var(--border-dark)]">
                    /
                </span>

                <a
                    href="{{ route('shop.index') }}"
                    class="shrink-0 transition hover:text-[var(--primary)]"
                >
                    فروشگاه
                </a>

                @if($product->category)

                    <span class="text-[var(--border-dark)]">
                        /
                    </span>

                    <a
                        href="{{ route('categories.show', $product->category) }}"
                        class="shrink-0 transition hover:text-[var(--primary)]"
                    >
                        {{ $product->category->name }}
                    </a>

                @endif

                <span class="text-[var(--border-dark)]">
                    /
                </span>

                <span class="min-w-0 truncate font-semibold text-[var(--text-secondary)]">
                    {{ $product->name }}
                </span>

            </nav>

        </div>



        {{-- =========================================================
            PRODUCT HERO
        ========================================================== --}}

        <section
            class="mx-auto max-w-[1380px] px-4 pb-14 pt-5 sm:px-6 sm:pb-20 sm:pt-7 lg:px-8 lg:pb-24"
        >

            <div
                class="grid items-start gap-7 lg:grid-cols-[minmax(0,1.08fr)_minmax(380px,.92fr)] lg:gap-12 xl:gap-16"
            >


                {{-- =================================================
                    GALLERY
                ================================================== --}}

                <div class="min-w-0">

                    <div
                        x-data="{
                            activeId: @js($firstImage?->id),

                            activeUrl: @js(
                                $firstImage
                                    ? asset(
                                        'storage/' . ltrim(
                                            $firstImage->image,
                                            '/'
                                        )
                                    )
                                    : null
                            ),

                            activeAlt: @js(
                                $firstImage?->alt ?: $product->name
                            ),

                            zoom: false,

                            images: @js($galleryData),

                            setImage(id) {
                                const image = this.images.find(
                                    item => Number(item.id) === Number(id)
                                );

                                if (!image) {
                                    return;
                                }

                                this.activeId = image.id;
                                this.activeUrl = image.url;
                                this.activeAlt = image.alt;
                            }
                        }"
                    >

                        <div class="grid gap-3 sm:grid-cols-[78px_minmax(0,1fr)]">


                            {{-- =================================================
                                THUMBNAILS
                            ================================================== --}}

                            <div
                                class="order-2 flex gap-2 overflow-x-auto pb-1 sm:order-1 sm:flex-col sm:overflow-visible sm:pb-0"
                            >

                                @forelse($galleryImages as $image)

                                    <button
                                        type="button"
                                        @click.prevent="setImage({{ $image->id }})"
                                        :class="
                                            Number(activeId) === Number({{ $image->id }})
                                                ? 'border-[var(--primary)] bg-white shadow-sm'
                                                : 'border-transparent bg-white/60 hover:border-[var(--primary)]/30'
                                        "
                                        class="group relative flex h-[72px] w-[72px] shrink-0 items-center justify-center overflow-hidden rounded-2xl border-2 transition duration-300"
                                        aria-label="نمایش تصویر {{ $loop->iteration }}"
                                        :aria-pressed="
                                            Number(activeId) === Number({{ $image->id }})
                                                ? 'true'
                                                : 'false'
                                        "
                                    >

                                        <img
                                            src="{{ asset('storage/' . ltrim($image->image, '/')) }}"
                                            alt="{{ $image->alt ?: $product->name }}"
                                            class="h-full w-full object-contain p-1.5 transition duration-300 group-hover:scale-105"
                                            width="72"
                                            height="72"
                                            loading="{{ $loop->first ? 'eager' : 'lazy' }}"
                                            decoding="async"
                                        >

                                    </button>

                                @empty

                                    <div
                                        class="flex h-[72px] w-[72px] shrink-0 items-center justify-center rounded-2xl border border-dashed border-[var(--border-dark)] bg-white text-[var(--text-light)]"
                                    >

                                        <svg
                                            class="h-6 w-6"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            aria-hidden="true"
                                        >
                                            <rect
                                                x="3"
                                                y="4"
                                                width="18"
                                                height="16"
                                                rx="2"
                                            />

                                            <circle
                                                cx="8.5"
                                                cy="9"
                                                r="1.5"
                                            />

                                            <path d="m21 15-5-5-4 4-2-2-7 7"/>
                                        </svg>

                                    </div>

                                @endforelse

                            </div>



                            {{-- =================================================
                                MAIN IMAGE
                            ================================================== --}}

                            <div class="order-1 sm:order-2">

                                <div
                                    class="relative overflow-hidden rounded-[32px] border border-[var(--border)] bg-white shadow-[0_20px_60px_rgba(72,91,105,0.06)]"
                                >

                                    <button
                                        type="button"
                                        @click="activeUrl && (zoom = true)"
                                        class="group relative block aspect-[4/5] w-full overflow-hidden"
                                        aria-label="بزرگ‌نمایی تصویر محصول"
                                    >

                                        {{-- Ambient Background --}}

                                        <div
                                            class="pointer-events-none absolute inset-0"
                                        >

                                            <div
                                                class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-[var(--primary)]/10 blur-3xl"
                                            ></div>

                                            <div
                                                class="absolute -bottom-20 -left-20 h-72 w-72 rounded-full bg-[var(--accent)]/10 blur-3xl"
                                            ></div>

                                            <div
                                                class="absolute inset-0 bg-[linear-gradient(135deg,rgba(126,199,232,0.035),rgba(245,214,223,0.10),rgba(255,255,255,0.55))]"
                                            ></div>

                                        </div>


                                        {{-- Main Image --}}

                                        @if($firstImage)

                                            <img
                                                src="{{ asset('storage/' . ltrim($firstImage->image, '/')) }}"
                                                x-bind:src="activeUrl"
                                                x-bind:alt="activeAlt"
                                                alt="{{ $firstImage->alt ?: $product->name }}"
                                                width="1000"
                                                height="1250"
                                                loading="eager"
                                                decoding="async"
                                                class="relative z-10 block h-full w-full object-contain p-7 transition duration-700 ease-[cubic-bezier(.22,1,.36,1)] group-hover:scale-[1.025] sm:p-10 lg:p-12"
                                            >

                                        @else

                                            <div
                                                class="absolute inset-0 flex flex-col items-center justify-center text-[var(--text-light)]"
                                            >

                                                <svg
                                                    class="h-16 w-16"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="1"
                                                    aria-hidden="true"
                                                >
                                                    <rect
                                                        x="3"
                                                        y="4"
                                                        width="18"
                                                        height="16"
                                                        rx="2"
                                                    />

                                                    <circle
                                                        cx="8.5"
                                                        cy="9"
                                                        r="1.5"
                                                    />

                                                    <path d="m21 15-5-5-4 4-2-2-7 7"/>
                                                </svg>

                                                <span class="mt-3 text-xs font-semibold">
                                                    تصویری برای این محصول ثبت نشده است
                                                </span>

                                            </div>

                                        @endif


                                        {{-- Discount --}}

                                        @if($hasDiscount && $displayDiscount > 0)

                                            <span
                                                class="absolute right-5 top-5 z-20 rounded-full bg-[var(--accent)] px-3.5 py-2 text-[10px] font-black text-white shadow-[0_10px_25px_rgba(220,145,160,0.20)]"
                                            >
                                                {{ $displayDiscount }}٪ تخفیف
                                            </span>

                                        @elseif($product->is_featured)

                                            <span
                                                class="absolute right-5 top-5 z-20 inline-flex items-center gap-1.5 rounded-full border border-white bg-white/90 px-3.5 py-2 text-[10px] font-black text-[var(--primary)] shadow-sm backdrop-blur"
                                            >

                                                <svg
                                                    class="h-3 w-3"
                                                    viewBox="0 0 24 24"
                                                    fill="currentColor"
                                                    aria-hidden="true"
                                                >
                                                    <path d="m12 2 2.6 6.2L21 11l-6.4 2.8L12 20l-2.6-6.2L3 11l6.4-2.8L12 2Z"/>
                                                </svg>

                                                انتخاب ژنان

                                            </span>

                                        @endif


                                        {{-- Stock --}}

                                        @if(!$isAvailable)

                                            <span
                                                class="absolute left-5 top-5 z-20 rounded-full bg-slate-800/90 px-3.5 py-2 text-[10px] font-black text-white shadow-sm backdrop-blur"
                                            >
                                                ناموجود
                                            </span>

                                        @elseif($isLowStock)

                                            <span
                                                class="absolute left-5 top-5 z-20 rounded-full border border-white bg-white/90 px-3.5 py-2 text-[10px] font-black text-[var(--text-secondary)] shadow-sm backdrop-blur"
                                            >
                                                فقط {{ number_format($product->stock) }} عدد
                                            </span>

                                        @endif


                                        {{-- Zoom --}}

                                        @if($firstImage)

                                            <span
                                                class="absolute bottom-5 left-5 z-20 flex h-10 w-10 items-center justify-center rounded-full border border-white/70 bg-white/80 text-[var(--text-secondary)] shadow-sm backdrop-blur-md transition duration-300 group-hover:bg-white group-hover:text-[var(--primary)]"
                                            >

                                                <svg
                                                    class="h-4 w-4"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="1.7"
                                                    aria-hidden="true"
                                                >
                                                    <circle
                                                        cx="11"
                                                        cy="11"
                                                        r="6.5"
                                                    />

                                                    <path d="m16 16 5 5"/>

                                                    <path d="M11 8v6M8 11h6"/>
                                                </svg>

                                            </span>

                                        @endif

                                    </button>

                                </div>


                                {{-- Gallery Meta --}}

                                @if($galleryImages->count() > 0)

                                    <div
                                        class="mt-3 flex items-center justify-between px-1 text-[10px] text-[var(--text-muted)]"
                                    >

                                        <span>
                                            تصاویر محصول
                                        </span>

                                        <span>
                                            {{ number_format($galleryImages->count()) }}
                                            تصویر
                                        </span>

                                    </div>

                                @endif

                            </div>

                        </div>



                        {{-- =================================================
                            ZOOM MODAL
                        ================================================== --}}

                        @if($firstImage)

                            <div
                                x-show="zoom"
                                x-cloak
                                x-transition.opacity
                                @click.self="zoom = false"
                                @keydown.escape.window="zoom = false"
                                class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/70 p-4 backdrop-blur-md"
                            >

                                <div
                                    class="relative flex max-h-[90vh] max-w-[94vw] items-center justify-center overflow-hidden rounded-[28px] bg-white p-3 shadow-2xl sm:p-5"
                                >

                                    <img
                                        src="{{ asset('storage/' . ltrim($firstImage->image, '/')) }}"
                                        x-bind:src="activeUrl"
                                        x-bind:alt="activeAlt"
                                        alt="{{ $firstImage->alt ?: $product->name }}"
                                        width="1400"
                                        height="1400"
                                        decoding="async"
                                        class="max-h-[84vh] max-w-[88vw] object-contain"
                                    >


                                    <button
                                        type="button"
                                        @click="zoom = false"
                                        class="absolute left-3 top-3 flex h-10 w-10 items-center justify-center rounded-full bg-slate-900/85 text-white transition hover:bg-slate-950"
                                        aria-label="بستن"
                                    >

                                        <svg
                                            class="h-4 w-4"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >
                                            <path d="m6 6 12 12"/>
                                            <path d="m18 6-12 12"/>
                                        </svg>

                                    </button>

                                </div>

                            </div>

                        @endif

                    </div>


                    {{-- =================================================
                        BENEFITS
                    ================================================== --}}

                    <div
                        class="mt-4 grid grid-cols-2 gap-2 sm:grid-cols-4"
                    >

                        <div
                            class="group rounded-2xl bg-white/70 px-3 py-3.5 transition hover:bg-white"
                        >

                            <div
                                class="flex h-9 w-9 items-center justify-center rounded-xl bg-[var(--surface-soft)] text-[var(--primary)] transition group-hover:bg-[var(--accent-soft)] group-hover:text-[var(--accent)]"
                            >

                                <svg
                                    class="h-4 w-4"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                >
                                    <path d="M3 7h11v10H3z"/>
                                    <path d="M14 10h3l4 4v3h-7z"/>
                                    <circle cx="7" cy="19" r="1.5"/>
                                    <circle cx="18" cy="19" r="1.5"/>
                                </svg>

                            </div>

                            <p class="mt-2 text-[10px] font-black text-[var(--text)]">
                                ارسال مطمئن
                            </p>

                        </div>


                        <div
                            class="group rounded-2xl bg-white/70 px-3 py-3.5 transition hover:bg-white"
                        >

                            <div
                                class="flex h-9 w-9 items-center justify-center rounded-xl bg-[var(--surface-soft)] text-[var(--primary)] transition group-hover:bg-[var(--accent-soft)] group-hover:text-[var(--accent)]"
                            >

                                <svg
                                    class="h-4 w-4"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                >
                                    <path d="M12 3 5 6v5c0 5 3 8.5 7 10 4-1.5 7-5 7-10V6l-7-3Z"/>
                                    <path d="m9 12 2 2 4-4"/>
                                </svg>

                            </div>

                            <p class="mt-2 text-[10px] font-black text-[var(--text)]">
                                خرید امن
                            </p>

                        </div>


                        <div
                            class="group rounded-2xl bg-white/70 px-3 py-3.5 transition hover:bg-white"
                        >

                            <div
                                class="flex h-9 w-9 items-center justify-center rounded-xl bg-[var(--accent-soft)] text-[var(--accent)]"
                            >

                                <svg
                                    class="h-4 w-4"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                >
                                    <circle cx="12" cy="12" r="9"/>
                                    <path d="M12 7v5l3 2"/>
                                </svg>

                            </div>

                            <p class="mt-2 text-[10px] font-black text-[var(--text)]">
                                پاسخ‌گویی سریع
                            </p>

                        </div>


                        <div
                            class="group rounded-2xl bg-white/70 px-3 py-3.5 transition hover:bg-white"
                        >

                            <div
                                class="flex h-9 w-9 items-center justify-center rounded-xl bg-[var(--accent-soft)] text-[var(--accent)]"
                            >

                                <svg
                                    class="h-4 w-4"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                >
                                    <path d="M12 3 4 7v5c0 4.5 3.2 7.6 8 9 4.8-1.4 8-4.5 8-9V7l-8-4Z"/>
                                    <path d="m8.5 12 2.2 2.2 4.8-5"/>
                                </svg>

                            </div>

                            <p class="mt-2 text-[10px] font-black text-[var(--text)]">
                                انتخاب مطمئن
                            </p>

                        </div>

                    </div>

                </div>



                {{-- =================================================
                    PRODUCT INFO
                ================================================== --}}

                <div class="min-w-0">

                    <div class="lg:sticky lg:top-24">


                        {{-- Small editorial label --}}

                        <div
                            class="flex items-center gap-3 text-[10px] font-black uppercase tracking-[0.18em] text-[var(--primary)]"
                        >

                            <span class="h-px w-8 bg-[var(--primary)]/50"></span>

                            Janan Collection

                        </div>


                        {{-- Brand / Category --}}

                        <div class="mt-4 flex flex-wrap items-center gap-2.5">

                            @if($product->brand)

                                <span
                                    class="rounded-full bg-[var(--surface-soft)] px-3 py-1.5 text-[10px] font-black text-[var(--primary)]"
                                >
                                    {{ $product->brand }}
                                </span>

                            @endif


                            @if($product->category)

                                <a
                                    href="{{ route('categories.show', $product->category) }}"
                                    class="text-[10px] font-semibold text-[var(--text-muted)] transition hover:text-[var(--primary)]"
                                >
                                    {{ $product->category->name }}
                                </a>

                            @endif

                        </div>


                        {{-- Title --}}

                        <h1
                            class="mt-4 max-w-[680px] text-[2rem] font-black leading-[1.55] tracking-[-0.025em] text-[var(--text)] sm:text-[2.35rem] lg:text-[2.7rem]"
                        >
                            {{ $product->name }}
                        </h1>


                        {{-- Rating --}}

                        <div class="mt-4 flex items-center gap-3">

                            @if($product->review_count > 0)

                                <a
                                    href="#reviews"
                                    class="inline-flex items-center gap-1.5 rounded-full bg-[var(--accent-soft)] px-3 py-1.5 text-[10px] font-black text-[var(--accent)] transition hover:scale-[1.02]"
                                >

                                    <svg
                                        class="h-3.5 w-3.5"
                                        viewBox="0 0 24 24"
                                        fill="currentColor"
                                        aria-hidden="true"
                                    >
                                        <path d="m12 2.8 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2-5.6-3-5.6 3 1.1-6.2L3 9.4l6.2-.9L12 2.8Z"/>
                                    </svg>

                                    {{ number_format($product->rating, 1) }}

                                </a>

                                <a
                                    href="#reviews"
                                    class="text-[10px] font-semibold text-[var(--text-muted)] transition hover:text-[var(--primary)]"
                                >
                                    {{ number_format($product->review_count) }} دیدگاه
                                </a>

                            @else

                                <span class="text-[10px] text-[var(--text-muted)]">
                                    هنوز دیدگاهی ثبت نشده است
                                </span>

                            @endif

                        </div>


                        {{-- Description --}}

                        @if($product->short_description)

                            <p
                                class="mt-6 max-w-[640px] text-[13px] leading-8 text-[var(--text-secondary)] sm:text-sm"
                            >
                                {{ $product->short_description }}
                            </p>

                        @endif


                        {{-- Divider --}}

                        <div class="my-7 h-px bg-[var(--border)]"></div>


                        {{-- Price --}}

                        <div>

                            <div class="flex items-end justify-between gap-5">

                                <div>

                                    @if($hasDiscount)

                                        <div class="mb-2 flex items-center gap-2.5">

                                            <span
                                                class="text-xs text-[var(--text-light)] line-through"
                                            >
                                                {{ number_format($product->old_price) }}
                                            </span>

                                            <span
                                                class="rounded-full bg-[var(--accent-soft)] px-2 py-1 text-[9px] font-black text-[var(--accent)]"
                                            >
                                                {{ $displayDiscount }}٪
                                            </span>

                                        </div>

                                    @endif


                                    <div class="flex items-baseline gap-2">

                                        <strong
                                            class="text-[2.05rem] font-black tracking-tight text-[var(--text)] sm:text-[2.3rem]"
                                        >
                                            {{ number_format($product->price) }}
                                        </strong>

                                        <span
                                            class="text-[10px] font-bold text-[var(--text-muted)]"
                                        >
                                            تومان
                                        </span>

                                    </div>

                                </div>


                                @if($hasDiscount)

                                    <div
                                        class="hidden text-left sm:block"
                                    >

                                        <div
                                            class="text-[9px] text-[var(--text-muted)]"
                                        >
                                            صرفه‌جویی
                                        </div>

                                        <div
                                            class="mt-1 text-xs font-black text-[var(--accent)]"
                                        >
                                            {{ number_format($discountAmount) }}
                                            تومان
                                        </div>

                                    </div>

                                @endif

                            </div>

                        </div>


                        {{-- Quick Information --}}

                        <div
                            class="mt-6 grid grid-cols-2 gap-x-5 gap-y-4 border-y border-[var(--border)] py-5 sm:grid-cols-3"
                        >

                            @if($product->brand)

                                <div>

                                    <div class="text-[9px] text-[var(--text-muted)]">
                                        برند
                                    </div>

                                    <div class="mt-1 text-[11px] font-black text-[var(--text)]">
                                        {{ $product->brand }}
                                    </div>

                                </div>

                            @endif


                            @if($product->category)

                                <div>

                                    <div class="text-[9px] text-[var(--text-muted)]">
                                        دسته‌بندی
                                    </div>

                                    <div class="mt-1 truncate text-[11px] font-black text-[var(--text)]">
                                        {{ $product->category->name }}
                                    </div>

                                </div>

                            @endif


                            @if($product->sku)

                                <div>

                                    <div class="text-[9px] text-[var(--text-muted)]">
                                        کد کالا
                                    </div>

                                    <div
                                        dir="ltr"
                                        class="mt-1 font-mono text-[10px] font-bold text-[var(--text)]"
                                    >
                                        {{ $product->sku }}
                                    </div>

                                </div>

                            @endif

                        </div>


                        {{-- Add To Cart --}}

                        @if($isAvailable)

                            <form
                                action="{{ route('customer.cart.add') }}"
                                method="POST"
                                class="mt-6"
                            >

                                @csrf

                                <input
                                    type="hidden"
                                    name="product_id"
                                    value="{{ $product->id }}"
                                >


                                <div class="flex gap-3">


                                    {{-- Quantity --}}

                                    <div
                                        class="flex h-14 w-[116px] shrink-0 items-center justify-between rounded-2xl border border-[var(--border)] bg-white px-2"
                                    >

                                        <button
                                            type="button"
                                            onclick="
                                                const input =
                                                    document.getElementById('productQuantity');

                                                input.value = Math.max(
                                                    1,
                                                    parseInt(input.value || 1, 10) - 1
                                                );
                                            "
                                            class="flex h-9 w-9 items-center justify-center rounded-xl text-lg text-[var(--text-secondary)] transition hover:bg-[var(--surface-soft)] hover:text-[var(--primary)]"
                                            aria-label="کاهش تعداد"
                                        >
                                            −
                                        </button>


                                        <input
                                            id="productQuantity"
                                            type="number"
                                            name="quantity"
                                            min="1"
                                            max="{{ min($product->stock, 99) }}"
                                            value="1"
                                            inputmode="numeric"
                                            class="w-9 border-0 bg-transparent p-0 text-center text-sm font-black text-[var(--text)] outline-none focus:ring-0"
                                            aria-label="تعداد {{ $product->name }}"
                                        >


                                        <button
                                            type="button"
                                            onclick="
                                                const input =
                                                document.getElementById('productQuantity');

                                                const max =
                                            {{ min($product->stock, 99) }};

                                                input.value = Math.min(
                                                max,
                                                parseInt(input.value || 1, 10) + 1
                                                );
                                                "
                                            class="flex h-9 w-9 items-center justify-center rounded-xl text-lg text-[var(--text-secondary)] transition hover:bg-[var(--surface-soft)] hover:text-[var(--primary)]"
                                            aria-label="افزایش تعداد"
                                        >
                                            +
                                        </button>

                                    </div>


                                    {{-- Submit --}}

                                    <button
                                        type="submit"
                                        class="group flex h-14 min-w-0 flex-1 items-center justify-center gap-2.5 rounded-2xl bg-[var(--primary)] px-5 text-sm font-black text-white shadow-[0_14px_30px_rgba(126,199,232,0.20)] transition duration-300 hover:-translate-y-0.5 hover:bg-[var(--primary-hover)] hover:shadow-[0_18px_36px_rgba(126,199,232,0.25)] focus:outline-none focus:ring-4 focus:ring-[var(--primary)]/15"
                                    >

                                        <svg
                                            class="h-5 w-5 shrink-0 transition duration-300 group-hover:scale-105"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.7"
                                            aria-hidden="true"
                                        >
                                            <path d="M3 4h2l2.4 11.2a2 2 0 0 0 2 1.6h7.9a2 2 0 0 0 2-1.6L21 7H6"/>

                                            <circle
                                                cx="10"
                                                cy="20"
                                                r="1"
                                            />

                                            <circle
                                                cx="18"
                                                cy="20"
                                                r="1"
                                            />

                                        </svg>

                                        افزودن به سبد خرید

                                    </button>

                                </div>

                            </form>

                        @else

                            <div
                                class="mt-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-4"
                            >

                                <div class="flex items-start gap-3">

                                    <div
                                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-red-600"
                                    >

                                        <svg
                                            class="h-4 w-4"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >
                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="9"
                                            />

                                            <path d="M12 8v5"/>
                                            <path d="M12 16h.01"/>
                                        </svg>

                                    </div>

                                    <div>

                                        <div class="text-xs font-black text-red-700">
                                            این محصول فعلاً قابل سفارش نیست.
                                        </div>

                                        <div class="mt-1 text-[10px] leading-6 text-red-600/80">
                                            در صورت موجود شدن، خرید محصول دوباره فعال خواهد شد.
                                        </div>

                                    </div>

                                </div>

                            </div>

                        @endif


                        {{-- Seller --}}

                        <div
                            class="mt-4 flex items-center justify-between gap-4 rounded-2xl bg-[var(--surface-soft)] px-4 py-3.5"
                        >

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-white text-[var(--primary)] shadow-sm"
                                >

                                    <svg
                                        class="h-4.5 w-4.5"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.7"
                                    >
                                        <path d="M4 10h16"/>
                                        <path d="M6 10v8"/>
                                        <path d="M10 10v8"/>
                                        <path d="M14 10v8"/>
                                        <path d="M18 10v8"/>
                                        <path d="M3 18h18"/>
                                        <path d="M4 10 6 4h12l2 6"/>
                                    </svg>

                                </div>


                                <div>

                                    <div
                                        class="text-[11px] font-black text-[var(--text)]"
                                    >
                                        فروشگاه ژنان
                                    </div>

                                    <div
                                        class="mt-0.5 text-[9px] text-[var(--text-muted)]"
                                    >
                                        انتخاب و خرید مطمئن
                                    </div>

                                </div>

                            </div>


                            @if($isAvailable)

                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1.5 text-[9px] font-black text-emerald-700"
                                >

                                    <span
                                        class="h-1.5 w-1.5 rounded-full bg-emerald-500"
                                    ></span>

                                    موجود

                                </span>

                            @else

                                <span
                                    class="rounded-full bg-white px-2.5 py-1.5 text-[9px] font-black text-[var(--text-muted)]"
                                >
                                    ناموجود
                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </section>



        {{-- =========================================================
            PRODUCT CONTENT NAV
        ========================================================== --}}

        <div
            class="sticky top-[76px] z-30 border-y border-[var(--border)] bg-white/90 backdrop-blur-xl"
        >

            <div
                class="mx-auto max-w-[1380px] overflow-x-auto px-4 sm:px-6 lg:px-8"
            >

                <nav class="flex min-w-max items-center gap-1 py-2">

                    <a
                        href="#description"
                        class="rounded-full px-4 py-2.5 text-[10px] font-black text-[var(--text-secondary)] transition hover:bg-[var(--surface-soft)] hover:text-[var(--primary)]"
                    >
                        معرفی
                    </a>

                    <a
                        href="#specifications"
                        class="rounded-full px-4 py-2.5 text-[10px] font-black text-[var(--text-secondary)] transition hover:bg-[var(--surface-soft)] hover:text-[var(--primary)]"
                    >
                        مشخصات
                    </a>

                    <a
                        href="#reviews"
                        class="rounded-full px-4 py-2.5 text-[10px] font-black text-[var(--text-secondary)] transition hover:bg-[var(--surface-soft)] hover:text-[var(--primary)]"
                    >
                        دیدگاه‌ها

                        @if($product->review_count > 0)
                            ({{ number_format($product->review_count) }})
                        @endif

                    </a>

                    @if($relatedProducts->count())

                        <a
                            href="#related"
                            class="rounded-full px-4 py-2.5 text-[10px] font-black text-[var(--text-secondary)] transition hover:bg-[var(--surface-soft)] hover:text-[var(--primary)]"
                        >
                            محصولات مرتبط
                        </a>

                    @endif

                </nav>

            </div>

        </div>



        {{-- =========================================================
            CONTENT
        ========================================================== --}}

        <div
            class="mx-auto max-w-[1380px] px-4 sm:px-6 lg:px-8"
        >


            {{-- =====================================================
                DESCRIPTION
            ====================================================== --}}

            <section
                id="description"
                class="scroll-mt-32 border-b border-[var(--border)] py-16 sm:py-20"
            >

                <div
                    class="grid gap-8 lg:grid-cols-[220px_minmax(0,1fr)] lg:gap-14"
                >

                    <div>

                        <div
                            class="text-[9px] font-black uppercase tracking-[0.2em] text-[var(--primary)]"
                        >
                            Description
                        </div>

                        <h2
                            class="mt-2 text-2xl font-black tracking-tight text-[var(--text)]"
                        >
                            درباره این محصول
                        </h2>

                    </div>


                    <div>

                        @if($product->description)

                            <div
                                class="max-w-4xl text-sm leading-[2.2] text-[var(--text-secondary)]"
                            >
                                {!! nl2br(e($product->description)) !!}
                            </div>

                        @else

                            <div
                                class="rounded-2xl border border-dashed border-[var(--border-dark)] bg-white px-5 py-8 text-center"
                            >

                                <p
                                    class="text-xs font-semibold text-[var(--text-muted)]"
                                >
                                    توضیح کاملی برای این محصول ثبت نشده است.
                                </p>

                            </div>

                        @endif

                    </div>

                </div>

            </section>



            {{-- =====================================================
                SPECIFICATIONS
            ====================================================== --}}

            <section
                id="specifications"
                class="scroll-mt-32 border-b border-[var(--border)] py-16 sm:py-20"
            >

                <div
                    class="grid gap-8 lg:grid-cols-[220px_minmax(0,1fr)] lg:gap-14"
                >

                    <div>

                        <div
                            class="text-[9px] font-black uppercase tracking-[0.2em] text-[var(--primary)]"
                        >
                            Details
                        </div>

                        <h2
                            class="mt-2 text-2xl font-black tracking-tight text-[var(--text)]"
                        >
                            مشخصات
                        </h2>

                    </div>


                    <div class="max-w-4xl">

                        <div
                            class="divide-y divide-[var(--border)] border-y border-[var(--border)]"
                        >

                            @if($product->brand)

                                <div
                                    class="grid gap-1.5 py-4 sm:grid-cols-[180px_1fr]"
                                >

                                    <span class="text-[10px] text-[var(--text-muted)]">
                                        برند
                                    </span>

                                    <span class="text-xs font-black text-[var(--text)]">
                                        {{ $product->brand }}
                                    </span>

                                </div>

                            @endif


                            @if($product->category)

                                <div
                                    class="grid gap-1.5 py-4 sm:grid-cols-[180px_1fr]"
                                >

                                    <span class="text-[10px] text-[var(--text-muted)]">
                                        دسته‌بندی
                                    </span>

                                    <span class="text-xs font-black text-[var(--text)]">
                                        {{ $product->category->name }}
                                    </span>

                                </div>

                            @endif


                            @if($product->sku)

                                <div
                                    class="grid gap-1.5 py-4 sm:grid-cols-[180px_1fr]"
                                >

                                    <span class="text-[10px] text-[var(--text-muted)]">
                                        کد محصول
                                    </span>

                                    <span
                                        dir="ltr"
                                        class="font-mono text-xs font-bold text-[var(--text)]"
                                    >
                                        {{ $product->sku }}
                                    </span>

                                </div>

                            @endif


                            <div
                                class="grid gap-1.5 py-4 sm:grid-cols-[180px_1fr]"
                            >

                                <span class="text-[10px] text-[var(--text-muted)]">
                                    موجودی
                                </span>

                                @if($isAvailable)

                                    <span class="text-xs font-black text-emerald-700">
                                        {{ number_format($product->stock) }} عدد موجود
                                    </span>

                                @else

                                    <span class="text-xs font-black text-red-600">
                                        ناموجود
                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </section>



            {{-- =====================================================
                REVIEWS
            ====================================================== --}}

            <section
                id="reviews"
                class="scroll-mt-32 border-b border-[var(--border)] py-16 sm:py-20"
            >

                <div
                    class="grid gap-8 lg:grid-cols-[220px_minmax(0,1fr)] lg:gap-14"
                >

                    <div>

                        <div
                            class="text-[9px] font-black uppercase tracking-[0.2em] text-[var(--primary)]"
                        >
                            Reviews
                        </div>

                        <h2
                            class="mt-2 text-2xl font-black tracking-tight text-[var(--text)]"
                        >
                            دیدگاه‌ها
                        </h2>

                    </div>


                    <div class="max-w-4xl">


                        {{-- Rating summary --}}

                        @if($product->review_count > 0)

                            <div
                                class="mb-7 flex flex-wrap items-center gap-5"
                            >

                                <div class="flex items-center gap-3">

                                    <div
                                        class="text-4xl font-black tracking-tight text-[var(--text)]"
                                    >
                                        {{ number_format($product->rating, 1) }}
                                    </div>

                                    <div>

                                        <div class="flex items-center gap-0.5">

                                            @for($i = 1; $i <= 5; $i++)

                                                <svg
                                                    class="h-3.5 w-3.5 {{ $i <= round($product->rating) ? 'text-[var(--accent)]' : 'text-slate-200' }}"
                                                    viewBox="0 0 24 24"
                                                    fill="currentColor"
                                                    aria-hidden="true"
                                                >
                                                    <path d="m12 2.8 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2-5.6-3-5.6 3 1.1-6.2L3 9.4l6.2-.9L12 2.8Z"/>
                                                </svg>

                                            @endfor

                                        </div>

                                        <div class="mt-1 text-[9px] text-[var(--text-muted)]">
                                            بر اساس {{ number_format($product->review_count) }} دیدگاه
                                        </div>

                                    </div>

                                </div>

                            </div>

                        @endif


                        <div class="grid gap-4 md:grid-cols-2">

                            @forelse($product->reviews as $review)

                                <article
                                    class="rounded-[24px] bg-white p-5 shadow-[0_8px_30px_rgba(72,91,105,0.045)]"
                                >

                                    <div
                                        class="flex items-start justify-between gap-3"
                                    >

                                        <div class="flex min-w-0 items-center gap-3">

                                            <div
                                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[var(--surface-soft)] text-xs font-black text-[var(--primary)]"
                                            >
                                                {{ mb_substr($review->user?->name ?? 'ک', 0, 1) }}
                                            </div>

                                            <div class="min-w-0">

                                                <div
                                                    class="truncate text-xs font-black text-[var(--text)]"
                                                >
                                                    {{ $review->user?->name ?? 'کاربر' }}
                                                </div>

                                                <div
                                                    class="mt-0.5 text-[9px] text-[var(--text-muted)]"
                                                >
                                                    {{ $review->created_at?->format('Y/m/d') }}
                                                </div>

                                            </div>

                                        </div>


                                        <div
                                            class="flex items-center gap-1 rounded-full bg-[var(--accent-soft)] px-2.5 py-1.5 text-[9px] font-black text-[var(--accent)]"
                                        >

                                            <svg
                                                class="h-3 w-3"
                                                viewBox="0 0 24 24"
                                                fill="currentColor"
                                            >
                                                <path d="m12 2.8 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2-5.6-3-5.6 3 1.1-6.2L3 9.4l6.2-.9L12 2.8Z"/>
                                            </svg>

                                            {{ $review->rating }}

                                        </div>

                                    </div>


                                    @if($review->title)

                                        <h3
                                            class="mt-4 text-xs font-black text-[var(--text)]"
                                        >
                                            {{ $review->title }}
                                        </h3>

                                    @endif


                                    <p
                                        class="mt-2.5 text-xs leading-7 text-[var(--text-secondary)]"
                                    >
                                        {{ $review->body }}
                                    </p>

                                </article>

                            @empty

                                <div
                                    class="md:col-span-2 py-10"
                                >

                                    <div
                                        class="flex h-14 w-14 items-center justify-center rounded-2xl bg-[var(--surface-soft)] text-[var(--primary)]"
                                    >

                                        <svg
                                            class="h-6 w-6"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.7"
                                        >
                                            <path d="M4 5a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v13a2 2 0 0 1-2 2H8l-4 3V5Z"/>
                                            <path d="M8 9h8M8 13h5"/>
                                        </svg>

                                    </div>

                                    <h3 class="mt-4 text-sm font-black text-[var(--text)]">
                                        هنوز دیدگاهی ثبت نشده است.
                                    </h3>

                                    <p class="mt-1.5 text-xs leading-6 text-[var(--text-muted)]">
                                        تجربه خود را بعد از خرید با دیگران به اشتراک بگذارید.
                                    </p>

                                </div>

                            @endforelse

                        </div>

                    </div>

                </div>

            </section>



            {{-- =====================================================
                RELATED PRODUCTS
            ====================================================== --}}

            @if($relatedProducts->count())

                <section
                    id="related"
                    class="scroll-mt-32 py-16 sm:py-20"
                >

                    <div
                        class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between"
                    >

                        <div>

                            <div
                                class="text-[9px] font-black uppercase tracking-[0.2em] text-[var(--primary)]"
                            >
                                You May Also Like
                            </div>

                            <h2
                                class="mt-2 text-2xl font-black tracking-tight text-[var(--text)] sm:text-3xl"
                            >
                                شاید این‌ها را هم دوست داشته باشید
                            </h2>

                        </div>


                        @if($product->category)

                            <a
                                href="{{ route('categories.show', $product->category) }}"
                                class="inline-flex items-center gap-2 text-[10px] font-black text-[var(--primary)] transition hover:text-[var(--accent)]"
                            >

                                مشاهده همه

                                <span class="text-sm">
                                    ←
                                </span>

                            </a>

                        @endif

                    </div>


                    <div
                        class="mt-8 grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4"
                    >

                        @foreach($relatedProducts as $relatedProduct)

                            @include('partials.product_card', [
                                'product' => $relatedProduct,
                            ])

                        @endforeach

                    </div>

                </section>

            @endif

        </div>

    </div>

@endsection
