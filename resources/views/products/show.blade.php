@extends('layouts.app')

@section('title', $product->meta_title ?: $product->name . ' | فرزین')

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
    @endphp


    <div class="min-h-screen bg-[var(--color-neutral-50)]">


        {{-- =========================================================
            BREADCRUMB
        ========================================================== --}}

        <div class="border-b border-[var(--color-border)] bg-white">

            <div class="mx-auto max-w-6xl px-4 py-3.5 sm:px-6 lg:px-8">

                <nav
                    class="flex items-center gap-2 overflow-hidden text-xs"
                    aria-label="مسیر صفحه"
                >

                    <a
                        href="{{ route('home') }}"
                        class="shrink-0 text-[var(--color-text-muted)] transition hover:text-[var(--color-brand-700)]"
                    >
                        خانه
                    </a>


                    <svg
                        class="h-3.5 w-3.5 shrink-0 text-[var(--color-neutral-400)]"
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
                        class="shrink-0 text-[var(--color-text-muted)] transition hover:text-[var(--color-brand-700)]"
                    >
                        فروشگاه
                    </a>


                    @if($product->category)

                        <svg
                            class="h-3.5 w-3.5 shrink-0 text-[var(--color-neutral-400)]"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            aria-hidden="true"
                        >
                            <path d="m9 18 6-6-6-6"/>
                        </svg>


                        <a
                            href="{{ route('categories.show', $product->category) }}"
                            class="shrink-0 text-[var(--color-text-muted)] transition hover:text-[var(--color-brand-700)]"
                        >
                            {{ $product->category->name }}
                        </a>

                    @endif


                    <svg
                        class="h-3.5 w-3.5 shrink-0 text-[var(--color-neutral-400)]"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        aria-hidden="true"
                    >
                        <path d="m9 18 6-6-6-6"/>
                    </svg>


                    <span
                        class="min-w-0 truncate font-semibold text-[var(--color-text-secondary)]"
                    >
                        {{ $product->name }}
                    </span>

                </nav>

            </div>

        </div>



        {{-- =========================================================
            PRODUCT
        ========================================================== --}}

        <section
            class="mx-auto max-w-6xl px-4 py-6 sm:px-6 sm:py-8 lg:px-8 lg:py-10"
        >

            <div
                class="grid items-start gap-6 lg:grid-cols-[minmax(0,1.04fr)_minmax(320px,.96fr)] lg:gap-8 xl:gap-10"
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


                        <div
                            class="grid gap-3.5 sm:grid-cols-[72px_minmax(0,1fr)]"
                        >


                            {{-- =================================================
                                THUMBNAILS
                            ================================================== --}}

                            <div
                                class="order-2 flex gap-2.5 overflow-x-auto sm:order-1 sm:flex-col sm:overflow-visible"
                            >
                                @forelse($galleryImages as $image)

                                    <button
                                        type="button"
                                        @click.prevent="setImage({{ $image->id }})"
                                        :class="
                Number(activeId) === Number({{ $image->id }})
                    ? 'border-[var(--color-brand-700)] ring-2 ring-[var(--color-brand-100)]'
                    : 'border-[var(--color-border)] hover:border-[var(--color-brand-300)]'
            "
                                        class="group flex h-[70px] w-[70px] shrink-0 items-center justify-center overflow-hidden rounded-xl border-2 bg-white transition"
                                        aria-label="نمایش تصویر {{ $loop->iteration }}"
                                        :aria-pressed="Number(activeId) === Number({{ $image->id }}) ? 'true' : 'false'"
                                    >
                                        <img
                                            src="{{ asset('storage/' . ltrim($image->image, '/')) }}"
                                            alt="{{ $image->alt ?: $product->name }}"
                                            class="h-full w-full object-contain p-1.5"
                                            width="70"
                                            height="70"
                                            loading="{{ $loop->first ? 'eager' : 'lazy' }}"
                                            decoding="async"
                                        >
                                    </button>

                                @empty

                                    <div
                                        class="flex h-[70px] w-[70px] shrink-0 items-center justify-center rounded-xl border border-dashed border-[var(--color-border-strong)] bg-white text-[var(--color-neutral-400)]"
                                    >
                                        <svg
                                            class="h-6 w-6"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            aria-hidden="true"
                                        >
                                            <rect x="3" y="4" width="18" height="16" rx="2"/>
                                            <circle cx="8.5" cy="9" r="1.5"/>
                                            <path d="m21 15-5-5-4 4-2-2-7 7"/>
                                        </svg>
                                    </div>

                                @endforelse
                            </div>


                            {{-- =================================================
                                MAIN IMAGE
                            ================================================== --}}

                            <div class="order-1 min-w-0 sm:order-2">

                                <div
                                    class="relative overflow-hidden rounded-2xl border border-[var(--color-border)] bg-white"
                                >

                                    <button
                                        type="button"
                                        @click="activeUrl && (zoom = true)"
                                        class="group relative block aspect-square w-full cursor-zoom-in overflow-hidden bg-[var(--color-neutral-50)]"
                                        aria-label="بزرگ‌نمایی تصویر محصول"
                                    >


                                        {{-- Soft Background --}}

                                        <div
                                            class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_top_right,var(--color-brand-50),transparent_42%),radial-gradient(circle_at_bottom_left,var(--color-accent-50),transparent_42%)]"
                                        ></div>



                                        {{-- Main Image --}}

                                        @if($firstImage)

                                            <img
                                                src="{{ asset('storage/' . ltrim($firstImage->image, '/')) }}"
                                                x-bind:src="activeUrl"
                                                x-bind:alt="activeAlt"
                                                alt="{{ $firstImage->alt ?: $product->name }}"
                                                width="900"
                                                height="900"
                                                loading="eager"
                                                decoding="async"
                                                class="relative z-[1] block h-full w-full object-contain p-6 transition duration-300 sm:p-8 lg:p-10"
                                            >

                                        @else

                                            <div
                                                class="absolute inset-0 flex flex-col items-center justify-center text-[var(--color-neutral-400)]"
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



                                        {{-- =================================================
                                            DISCOUNT
                                        ================================================== --}}

                                        @if($hasDiscount && $displayDiscount > 0)

                                            <span
                                                class="absolute right-3.5 top-3.5 z-10 rounded-full bg-[var(--color-accent-600)] px-3 py-1.5 text-[11px] font-black text-white shadow-md"
                                            >
                                                {{ $displayDiscount }}٪ تخفیف
                                            </span>

                                        @elseif($product->is_featured)

                                            <span
                                                class="absolute right-3.5 top-3.5 z-10 rounded-full bg-[var(--color-brand-950)] px-3 py-1.5 text-[11px] font-black text-white shadow-md"
                                            >
                                                محصول ویژه
                                            </span>

                                        @endif



                                        {{-- =================================================
                                            STOCK
                                        ================================================== --}}

                                        @if(!$product->is_active || $product->stock <= 0)

                                            <span
                                                class="absolute left-3.5 top-3.5 z-10 rounded-full bg-[var(--color-brand-950)]/95 px-3 py-1.5 text-[11px] font-black text-white"
                                            >
                                                ناموجود
                                            </span>

                                        @elseif($product->stock <= 5)

                                            <span
                                                class="absolute left-3.5 top-3.5 z-10 rounded-full border border-white bg-white/95 px-3 py-1.5 text-[11px] font-black text-[var(--color-text-primary)] shadow-sm"
                                            >
                                                فقط {{ $product->stock }} عدد
                                            </span>

                                        @endif



                                        {{-- =================================================
                                            ZOOM
                                        ================================================== --}}

                                        @if($firstImage)

                                            <span
                                                class="absolute bottom-3.5 left-3.5 z-10 flex h-9 w-9 items-center justify-center rounded-xl border border-[var(--color-border)] bg-white/95 text-[var(--color-text-secondary)] shadow-sm transition group-hover:bg-white group-hover:text-[var(--color-brand-900)]"
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



                                {{-- Gallery Count --}}

                                @if($galleryImages->count() > 0)

                                    <div
                                        class="mt-2.5 flex items-center justify-between px-0.5 text-[10px] text-[var(--color-text-muted)]"
                                    >

                                        <span>
                                            گالری محصول
                                        </span>

                                        <span>

                                            <strong
                                                class="font-black text-[var(--color-text-secondary)]"
                                            >
                                                {{ number_format($galleryImages->count()) }}
                                            </strong>

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
                                class="fixed inset-0 z-[100] flex items-center justify-center bg-black/70 p-4 backdrop-blur-sm"
                            >

                                <div
                                    class="relative flex max-h-[88vh] max-w-[92vw] items-center justify-center overflow-hidden rounded-2xl bg-white p-3 shadow-2xl sm:p-5"
                                >

                                    <img
                                        src="{{ asset('storage/' . ltrim($firstImage->image, '/')) }}"
                                        x-bind:src="activeUrl"
                                        x-bind:alt="activeAlt"
                                        alt="{{ $firstImage->alt ?: $product->name }}"
                                        width="1200"
                                        height="1200"
                                        decoding="async"
                                        class="max-h-[82vh] max-w-[88vw] object-contain"
                                    >


                                    <button
                                        type="button"
                                        @click="zoom = false"
                                        class="absolute left-3 top-3 flex h-9 w-9 items-center justify-center rounded-xl bg-black/80 text-white transition hover:bg-black"
                                        aria-label="بستن"
                                    >

                                        <svg
                                            class="h-4 w-4"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            aria-hidden="true"
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
                        GALLERY BENEFITS
                    ================================================== --}}

                    <div class="mt-3.5 grid grid-cols-2 gap-2.5 sm:grid-cols-4">

                        <div
                            class="rounded-xl border border-[var(--color-border)] bg-white px-3 py-3"
                        >

                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-lg bg-[var(--color-brand-50)] text-[var(--color-brand-800)]"
                            >

                                <svg
                                    class="h-4 w-4"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                    aria-hidden="true"
                                >
                                    <path d="M3 7h11v10H3z"/>
                                    <path d="M14 10h3l4 4v3h-7z"/>
                                    <circle cx="7" cy="19" r="1.5"/>
                                    <circle cx="18" cy="19" r="1.5"/>
                                </svg>

                            </div>

                            <p
                                class="mt-2 text-[10px] font-black text-[var(--color-text-primary)]"
                            >
                                ارسال مطمئن
                            </p>

                        </div>


                        <div
                            class="rounded-xl border border-[var(--color-border)] bg-white px-3 py-3"
                        >

                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-lg bg-[var(--color-brand-50)] text-[var(--color-brand-800)]"
                            >

                                <svg
                                    class="h-4 w-4"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                    aria-hidden="true"
                                >
                                    <path d="M12 3 5 6v5c0 5 3 8.5 7 10 4-1.5 7-5 7-10V6l-7-3Z"/>
                                    <path d="m9 12 2 2 4-4"/>
                                </svg>

                            </div>

                            <p
                                class="mt-2 text-[10px] font-black text-[var(--color-text-primary)]"
                            >
                                خرید امن
                            </p>

                        </div>


                        <div
                            class="rounded-xl border border-[var(--color-border)] bg-white px-3 py-3"
                        >

                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-lg bg-[var(--color-accent-50)] text-[var(--color-accent-700)]"
                            >

                                <svg
                                    class="h-4 w-4"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                    aria-hidden="true"
                                >
                                    <circle cx="12" cy="12" r="9"/>
                                    <path d="M12 7v5l3 2"/>
                                </svg>

                            </div>

                            <p
                                class="mt-2 text-[10px] font-black text-[var(--color-text-primary)]"
                            >
                                پاسخ‌گویی سریع
                            </p>

                        </div>


                        <div
                            class="rounded-xl border border-[var(--color-border)] bg-white px-3 py-3"
                        >

                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-lg bg-[var(--color-accent-50)] text-[var(--color-accent-700)]"
                            >

                                <svg
                                    class="h-4 w-4"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                    aria-hidden="true"
                                >
                                    <path d="M12 3 4 7v5c0 4.5 3.2 7.6 8 9 4.8-1.4 8-4.5 8-9V7l-8-4Z"/>
                                    <path d="m8.5 12 2.2 2.2 4.8-5"/>
                                </svg>

                            </div>

                            <p
                                class="mt-2 text-[10px] font-black text-[var(--color-text-primary)]"
                            >
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

                        <div
                            class="rounded-2xl border border-[var(--color-border)] bg-white p-5 shadow-[var(--shadow-xs)] sm:p-6"
                        >


                            {{-- Brand / Category --}}

                            <div class="flex flex-wrap items-center gap-2">

                                @if($product->brand)

                                    <span
                                        class="rounded-lg bg-[var(--color-brand-50)] px-2.5 py-1.5 text-[11px] font-black text-[var(--color-brand-800)]"
                                    >
                                        {{ $product->brand }}
                                    </span>

                                @endif


                                @if($product->category)

                                    <a
                                        href="{{ route('categories.show', $product->category) }}"
                                        class="text-[11px] font-semibold text-[var(--color-text-muted)] transition hover:text-[var(--color-brand-700)]"
                                    >
                                        {{ $product->category->name }}
                                    </a>

                                @endif

                            </div>



                            {{-- Title --}}

                            <h1
                                class="mt-3 text-[1.55rem] font-black leading-[1.65] tracking-tight text-[var(--color-text-primary)] sm:text-[1.8rem]"
                            >
                                {{ $product->name }}
                            </h1>



                            {{-- Rating --}}

                            <div class="mt-4 flex items-center gap-2.5">

                                @if($product->review_count > 0)

                                    <a
                                        href="#reviews"
                                        class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-2.5 py-1.5 text-[11px] font-black text-amber-700"
                                    >

                                        <svg
                                            class="h-3.5 w-3.5 text-amber-500"
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
                                        class="text-[11px] text-[var(--color-text-muted)] hover:text-[var(--color-brand-700)]"
                                    >
                                        {{ number_format($product->review_count) }} نظر
                                    </a>

                                @else

                                    <span
                                        class="text-[11px] text-[var(--color-text-muted)]"
                                    >
                                        هنوز امتیازی ثبت نشده است
                                    </span>

                                @endif

                            </div>



                            {{-- Description --}}

                            @if($product->short_description)

                                <p
                                    class="mt-5 text-sm leading-7 text-[var(--color-text-secondary)]"
                                >
                                    {{ $product->short_description }}
                                </p>

                            @endif



                            {{-- Quick info --}}

                            <div
                                class="mt-5 rounded-xl bg-[var(--color-neutral-50)] p-3.5"
                            >

                                <div
                                    class="mb-2.5 text-[11px] font-black text-[var(--color-text-primary)]"
                                >
                                    اطلاعات محصول
                                </div>


                                <div class="grid gap-2 sm:grid-cols-2">

                                    @if($product->brand)

                                        <div
                                            class="flex items-center justify-between gap-3 rounded-lg bg-white px-3 py-2.5"
                                        >

                                            <span
                                                class="text-[10px] text-[var(--color-text-muted)]"
                                            >
                                                برند
                                            </span>

                                            <span
                                                class="text-[11px] font-black text-[var(--color-text-primary)]"
                                            >
                                                {{ $product->brand }}
                                            </span>

                                        </div>

                                    @endif


                                    @if($product->category)

                                        <div
                                            class="flex items-center justify-between gap-3 rounded-lg bg-white px-3 py-2.5"
                                        >

                                            <span
                                                class="text-[10px] text-[var(--color-text-muted)]"
                                            >
                                                دسته‌بندی
                                            </span>

                                            <span
                                                class="max-w-[60%] truncate text-[11px] font-black text-[var(--color-text-primary)]"
                                            >
                                                {{ $product->category->name }}
                                            </span>

                                        </div>

                                    @endif


                                    @if($product->sku)

                                        <div
                                            class="flex items-center justify-between gap-3 rounded-lg bg-white px-3 py-2.5"
                                        >

                                            <span
                                                class="text-[10px] text-[var(--color-text-muted)]"
                                            >
                                                کد کالا
                                            </span>

                                            <span
                                                dir="ltr"
                                                class="font-mono text-[11px] font-bold text-[var(--color-text-primary)]"
                                            >
                                                {{ $product->sku }}
                                            </span>

                                        </div>

                                    @endif


                                    <div
                                        class="flex items-center justify-between gap-3 rounded-lg bg-white px-3 py-2.5"
                                    >

                                        <span
                                            class="text-[10px] text-[var(--color-text-muted)]"
                                        >
                                            وضعیت
                                        </span>


                                        @if($product->is_active && $product->stock > 0)

                                            <span
                                                class="inline-flex items-center gap-1.5 text-[11px] font-black text-emerald-700"
                                            >

                                                <span
                                                    class="h-1.5 w-1.5 rounded-full bg-emerald-500"
                                                ></span>

                                                موجود

                                            </span>

                                        @else

                                            <span
                                                class="text-[11px] font-black text-red-600"
                                            >
                                                ناموجود
                                            </span>

                                        @endif

                                    </div>

                                </div>

                            </div>



                            {{-- Divider --}}

                            <div
                                class="my-5 border-t border-[var(--color-border)]"
                            ></div>



                            {{-- Price --}}

                            <div>

                                <div
                                    class="flex items-end justify-between gap-4"
                                >

                                    <div>

                                        <p
                                            class="text-[10px] font-bold text-[var(--color-text-muted)]"
                                        >
                                            قیمت فروش
                                        </p>


                                        <div
                                            class="mt-1.5 flex items-baseline gap-2"
                                        >

                                            <strong
                                                class="text-[2rem] font-black tracking-tight text-[var(--color-brand-950)] sm:text-[2.25rem]"
                                            >
                                                {{ number_format($product->price) }}
                                            </strong>

                                            <span
                                                class="text-[11px] font-bold text-[var(--color-text-muted)]"
                                            >
                                                تومان
                                            </span>

                                        </div>

                                    </div>


                                    @if($hasDiscount && $displayDiscount > 0)

                                        <span
                                            class="rounded-lg bg-[var(--color-accent-50)] px-2.5 py-1.5 text-[11px] font-black text-[var(--color-accent-700)]"
                                        >
                                            {{ $displayDiscount }}٪
                                        </span>

                                    @endif

                                </div>


                                @if($hasDiscount)

                                    <div
                                        class="mt-2.5 flex items-center gap-2.5"
                                    >

                                        <span
                                            class="text-xs font-bold text-[var(--color-text-soft)] line-through"
                                        >
                                            {{ number_format($product->old_price) }}
                                        </span>

                                        <span
                                            class="text-[10px] text-[var(--color-text-muted)]"
                                        >
                                            قیمت قبل
                                        </span>

                                    </div>


                                    <div
                                        class="mt-3 rounded-lg bg-[var(--color-accent-50)] px-3.5 py-2.5 text-[10px] font-bold leading-6 text-[var(--color-accent-700)]"
                                    >

                                        صرفه‌جویی شما:

                                        <strong class="font-black">
                                            {{ number_format($discountAmount) }}
                                        </strong>

                                        تومان

                                    </div>

                                @endif

                            </div>



                            {{-- Add To Cart --}}

                            @if($product->is_active && $product->stock > 0)

                                <form
                                    action="{{ route('customer.cart.add') }}"
                                    method="POST"
                                    class="mt-5"
                                >

                                    @csrf


                                    <input
                                        type="hidden"
                                        name="product_id"
                                        value="{{ $product->id }}"
                                    >


                                    <div class="flex gap-2.5">


                                        {{-- Quantity --}}

                                        <div
                                            class="flex h-12 w-28 shrink-0 items-center justify-between rounded-xl border border-[var(--color-border)] bg-white px-2.5"
                                        >

                                            <button
                                                type="button"
                                                onclick="
                                                    const input =
                                                        document.getElementById('productQuantity');

                                                    input.value = Math.max(
                                                        1,
                                                        parseInt(
                                                            input.value || 1,
                                                            10
                                                        ) - 1
                                                    );
                                                "
                                                class="flex h-8 w-8 items-center justify-center rounded-lg text-sm text-[var(--color-text-secondary)] transition hover:bg-[var(--color-neutral-100)]"
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
                                                class="w-8 border-0 bg-transparent p-0 text-center text-xs font-black text-[var(--color-text-primary)] outline-none focus:ring-0"
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
                                                    parseInt(
                                                    input.value || 1,
                                                    10
                                                    ) + 1
                                                    );
                                                    "
                                                class="flex h-8 w-8 items-center justify-center rounded-lg text-sm text-[var(--color-text-secondary)] transition hover:bg-[var(--color-neutral-100)]"
                                                aria-label="افزایش تعداد"
                                            >
                                                +
                                            </button>

                                        </div>



                                        {{-- Submit --}}

                                        <button
                                            type="submit"
                                            class="group flex h-12 min-w-0 flex-1 items-center justify-center gap-2 rounded-xl bg-[var(--color-accent-600)] px-4 text-xs font-black text-white shadow-md shadow-[var(--color-accent-600)]/15 transition hover:-translate-y-0.5 hover:bg-[var(--color-accent-700)] focus:outline-none focus:ring-4 focus:ring-[var(--color-accent-100)]"
                                        >

                                            <svg
                                                class="h-4.5 w-4.5 shrink-0"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                aria-hidden="true"
                                            >
                                                <path d="M3 4h2l2.4 11.2a2 2 0 0 0 2 1.6h7.9a2 2 0 0 0 2-1.6L21 7H6"/>
                                                <circle cx="10" cy="20" r="1"/>
                                                <circle cx="18" cy="20" r="1"/>
                                            </svg>

                                            <span>
                                                افزودن به سبد خرید
                                            </span>

                                        </button>

                                    </div>

                                </form>

                            @else

                                <div
                                    class="mt-5 rounded-xl border border-red-200 bg-red-50 px-3.5 py-3"
                                >

                                    <div class="flex items-center gap-2.5">

                                        <svg
                                            class="h-4.5 w-4.5 shrink-0 text-red-600"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            aria-hidden="true"
                                        >
                                            <circle cx="12" cy="12" r="9"/>
                                            <path d="M12 8v5"/>
                                            <path d="M12 16h.01"/>
                                        </svg>


                                        <div>

                                            <div
                                                class="text-xs font-black text-red-700"
                                            >
                                                این محصول فعلاً قابل سفارش نیست.
                                            </div>


                                            <div
                                                class="mt-1 text-[10px] text-red-600/80"
                                            >
                                                در صورت موجود شدن، خرید فعال خواهد شد.
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @endif



                            {{-- Seller --}}

                            <div
                                class="mt-4 rounded-xl border border-[var(--color-border)] bg-[var(--color-neutral-50)] px-3.5 py-3.5"
                            >

                                <div
                                    class="flex items-center justify-between gap-3"
                                >

                                    <div class="flex items-center gap-2.5">

                                        <div
                                            class="flex h-9 w-9 items-center justify-center rounded-lg bg-white text-[var(--color-brand-900)] shadow-sm"
                                        >

                                            <svg
                                                class="h-4.5 w-4.5"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.7"
                                                aria-hidden="true"
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
                                                class="text-[11px] font-black text-[var(--color-text-primary)]"
                                            >
                                                فروشگاه فرزین
                                            </div>

                                            <div
                                                class="mt-0.5 text-[10px] text-[var(--color-text-muted)]"
                                            >
                                                فروشنده رسمی
                                            </div>

                                        </div>

                                    </div>


                                    <span
                                        class="rounded-full bg-emerald-50 px-2.5 py-1 text-[9px] font-black text-emerald-700"
                                    >
                                        عملکرد مطلوب
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            {{-- =====================================================
                CONTENT NAV
            ====================================================== --}}

            <div
                class="mt-7 overflow-x-auto rounded-xl border border-[var(--color-border)] bg-white"
            >

                <nav
                    class="flex min-w-max items-center gap-0.5 p-1.5"
                >

                    <a
                        href="#description"
                        class="rounded-lg px-4 py-2.5 text-[11px] font-black text-[var(--color-text-secondary)] transition hover:bg-[var(--color-neutral-50)] hover:text-[var(--color-brand-800)]"
                    >
                        معرفی
                    </a>


                    <a
                        href="#specifications"
                        class="rounded-lg px-4 py-2.5 text-[11px] font-black text-[var(--color-text-secondary)] transition hover:bg-[var(--color-neutral-50)] hover:text-[var(--color-brand-800)]"
                    >
                        مشخصات
                    </a>


                    <a
                        href="#reviews"
                        class="rounded-lg px-4 py-2.5 text-[11px] font-black text-[var(--color-text-secondary)] transition hover:bg-[var(--color-neutral-50)] hover:text-[var(--color-brand-800)]"
                    >
                        دیدگاه‌ها

                        @if($product->review_count > 0)
                            ({{ number_format($product->review_count) }})
                        @endif

                    </a>


                    @if($relatedProducts->count())

                        <a
                            href="#related"
                            class="rounded-lg px-4 py-2.5 text-[11px] font-black text-[var(--color-text-secondary)] transition hover:bg-[var(--color-neutral-50)] hover:text-[var(--color-brand-800)]"
                        >
                            محصولات مرتبط
                        </a>

                    @endif

                </nav>

            </div>



            {{-- =====================================================
                DESCRIPTION
            ====================================================== --}}

            <section
                id="description"
                class="scroll-mt-24 border-b border-[var(--color-border)] py-12"
            >

                <div
                    class="grid gap-6 lg:grid-cols-[180px_minmax(0,1fr)] lg:gap-10"
                >

                    <div>

                        <div
                            class="text-[9px] font-black uppercase tracking-[0.2em] text-[var(--color-accent-600)]"
                        >
                            Description
                        </div>

                        <h2
                            class="mt-2.5 text-xl font-black text-[var(--color-text-primary)]"
                        >
                            معرفی محصول
                        </h2>

                    </div>


                    <div>

                        @if($product->description)

                            <div
                                class="rounded-2xl border border-[var(--color-border)] bg-white p-5 sm:p-6"
                            >

                                <div
                                    class="max-w-4xl text-sm leading-8 text-[var(--color-text-secondary)]"
                                >
                                    {!! nl2br(e($product->description)) !!}
                                </div>

                            </div>

                        @else

                            <div
                                class="rounded-2xl border border-dashed border-[var(--color-border-strong)] bg-white p-8 text-center"
                            >

                                <p
                                    class="text-xs font-bold text-[var(--color-text-muted)]"
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
                class="scroll-mt-24 border-b border-[var(--color-border)] py-12"
            >

                <div
                    class="grid gap-6 lg:grid-cols-[180px_minmax(0,1fr)] lg:gap-10"
                >

                    <div>

                        <div
                            class="text-[9px] font-black uppercase tracking-[0.2em] text-[var(--color-accent-600)]"
                        >
                            Specifications
                        </div>

                        <h2
                            class="mt-2.5 text-xl font-black text-[var(--color-text-primary)]"
                        >
                            مشخصات محصول
                        </h2>

                    </div>


                    <div
                        class="overflow-hidden rounded-2xl border border-[var(--color-border)] bg-white"
                    >

                        <div
                            class="divide-y divide-[var(--color-border)]"
                        >

                            @if($product->brand)

                                <div
                                    class="grid gap-1.5 px-5 py-3.5 sm:grid-cols-[160px_1fr]"
                                >

                                    <span
                                        class="text-[11px] font-bold text-[var(--color-text-muted)]"
                                    >
                                        برند
                                    </span>

                                    <span
                                        class="text-xs font-black text-[var(--color-text-primary)]"
                                    >
                                        {{ $product->brand }}
                                    </span>

                                </div>

                            @endif


                            @if($product->category)

                                <div
                                    class="grid gap-1.5 px-5 py-3.5 sm:grid-cols-[160px_1fr]"
                                >

                                    <span
                                        class="text-[11px] font-bold text-[var(--color-text-muted)]"
                                    >
                                        دسته‌بندی
                                    </span>

                                    <span
                                        class="text-xs font-black text-[var(--color-text-primary)]"
                                    >
                                        {{ $product->category->name }}
                                    </span>

                                </div>

                            @endif


                            @if($product->sku)

                                <div
                                    class="grid gap-1.5 px-5 py-3.5 sm:grid-cols-[160px_1fr]"
                                >

                                    <span
                                        class="text-[11px] font-bold text-[var(--color-text-muted)]"
                                    >
                                        کد محصول
                                    </span>

                                    <span
                                        dir="ltr"
                                        class="font-mono text-xs font-bold text-[var(--color-text-primary)]"
                                    >
                                        {{ $product->sku }}
                                    </span>

                                </div>

                            @endif


                            <div
                                class="grid gap-1.5 px-5 py-3.5 sm:grid-cols-[160px_1fr]"
                            >

                                <span
                                    class="text-[11px] font-bold text-[var(--color-text-muted)]"
                                >
                                    موجودی
                                </span>


                                @if($product->is_active && $product->stock > 0)

                                    <span
                                        class="text-xs font-black text-emerald-700"
                                    >
                                        موجود
                                    </span>

                                @else

                                    <span
                                        class="text-xs font-black text-red-600"
                                    >
                                        ناموجود
                                    </span>

                                @endif

                            </div>


                            <div
                                class="grid gap-1.5 px-5 py-3.5 sm:grid-cols-[160px_1fr]"
                            >

                                <span
                                    class="text-[11px] font-bold text-[var(--color-text-muted)]"
                                >
                                    وضعیت انتشار
                                </span>

                                <span
                                    class="text-xs font-black text-[var(--color-text-primary)]"
                                >
                                    {{ $product->is_active ? 'فعال' : 'غیرفعال' }}
                                </span>

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
                class="scroll-mt-24 border-b border-[var(--color-border)] py-12"
            >

                <div
                    class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between"
                >

                    <div>

                        <div
                            class="text-[9px] font-black uppercase tracking-[0.2em] text-[var(--color-accent-600)]"
                        >
                            Reviews
                        </div>

                        <h2
                            class="mt-2.5 text-xl font-black text-[var(--color-text-primary)] sm:text-2xl"
                        >
                            دیدگاه خریداران
                        </h2>

                    </div>


                    @if($product->review_count > 0)

                        <div
                            class="inline-flex items-center gap-2.5 rounded-xl border border-[var(--color-border)] bg-white px-3.5 py-2.5"
                        >

                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-lg bg-amber-50"
                            >

                                <svg
                                    class="h-4 w-4 text-amber-500"
                                    viewBox="0 0 24 24"
                                    fill="currentColor"
                                    aria-hidden="true"
                                >
                                    <path d="m12 2.8 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2-5.6-3-5.6 3 1.1-6.2L3 9.4l6.2-.9L12 2.8Z"/>
                                </svg>

                            </div>

                            <div>

                                <div
                                    class="text-sm font-black text-amber-700"
                                >
                                    {{ number_format($product->rating, 1) }}
                                </div>

                                <div
                                    class="text-[9px] text-[var(--color-text-muted)]"
                                >
                                    از ۵
                                </div>

                            </div>

                        </div>

                    @endif

                </div>


                <div class="mt-6 grid gap-3 md:grid-cols-2">

                    @forelse($product->reviews as $review)

                        <article
                            class="rounded-2xl border border-[var(--color-border)] bg-white p-5"
                        >

                            <div
                                class="flex items-start justify-between gap-3"
                            >

                                <div
                                    class="flex min-w-0 items-center gap-2.5"
                                >

                                    <div
                                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-[var(--color-brand-50)] text-xs font-black text-[var(--color-brand-900)]"
                                    >
                                        {{ mb_substr($review->user?->name ?? 'ک', 0, 1) }}
                                    </div>


                                    <div class="min-w-0">

                                        <div
                                            class="truncate text-xs font-black text-[var(--color-text-primary)]"
                                        >
                                            {{ $review->user?->name ?? 'کاربر' }}
                                        </div>

                                        <div
                                            class="mt-0.5 text-[9px] text-[var(--color-text-muted)]"
                                        >
                                            {{ $review->created_at?->format('Y/m/d') }}
                                        </div>

                                    </div>

                                </div>


                                <div
                                    class="inline-flex shrink-0 items-center gap-1 rounded-lg bg-amber-50 px-2 py-1 text-[10px] font-black text-amber-700"
                                >

                                    <svg
                                        class="h-3 w-3 text-amber-500"
                                        viewBox="0 0 24 24"
                                        fill="currentColor"
                                        aria-hidden="true"
                                    >
                                        <path d="m12 2.8 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2-5.6-3-5.6 3 1.1-6.2L3 9.4l6.2-.9L12 2.8Z"/>
                                    </svg>

                                    {{ $review->rating }}

                                </div>

                            </div>


                            @if($review->title)

                                <h3
                                    class="mt-4 text-xs font-black text-[var(--color-text-primary)]"
                                >
                                    {{ $review->title }}
                                </h3>

                            @endif


                            <p
                                class="mt-2.5 text-xs leading-7 text-[var(--color-text-secondary)]"
                            >
                                {{ $review->body }}
                            </p>

                        </article>

                    @empty

                        <div
                            class="md:col-span-2 rounded-2xl border border-dashed border-[var(--color-border-strong)] bg-white px-5 py-12 text-center"
                        >

                            <div
                                class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-[var(--color-brand-50)] text-[var(--color-brand-800)]"
                            >

                                <svg
                                    class="h-6 w-6"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                    aria-hidden="true"
                                >
                                    <path d="M4 5a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v13a2 2 0 0 1-2 2H8l-4 3V5Z"/>
                                    <path d="M8 9h8M8 13h5"/>
                                </svg>

                            </div>


                            <h3
                                class="mt-4 text-xs font-black text-[var(--color-text-primary)]"
                            >
                                هنوز نظری برای این محصول ثبت نشده است.
                            </h3>


                            <p
                                class="mt-1.5 text-[10px] leading-6 text-[var(--color-text-muted)]"
                            >
                                اولین نفری باشید که تجربه خود را ثبت می‌کند.
                            </p>

                        </div>

                    @endforelse

                </div>

            </section>



            {{-- =====================================================
                RELATED PRODUCTS
            ====================================================== --}}

            @if($relatedProducts->count())

                <section
                    id="related"
                    class="scroll-mt-24 py-12"
                >

                    <div
                        class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between"
                    >

                        <div>

                            <div
                                class="text-[9px] font-black uppercase tracking-[0.2em] text-[var(--color-accent-600)]"
                            >
                                Related Products
                            </div>

                            <h2
                                class="mt-2.5 text-xl font-black text-[var(--color-text-primary)] sm:text-2xl"
                            >
                                محصولات مرتبط
                            </h2>

                        </div>


                        @if($product->category)

                            <a
                                href="{{ route('categories.show', $product->category) }}"
                                class="inline-flex items-center gap-1.5 text-[11px] font-black text-[var(--color-brand-800)] transition hover:text-[var(--color-accent-600)]"
                            >

                                مشاهده دسته‌بندی

                                <svg
                                    class="h-3.5 w-3.5"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    aria-hidden="true"
                                >
                                    <path d="m9 18 6-6-6-6"/>
                                </svg>

                            </a>

                        @endif

                    </div>


                    <div
                        class="mt-6 grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4"
                    >

                        @foreach($relatedProducts as $relatedProduct)

                            @include('partials.product_card', [
                                'product' => $relatedProduct,
                            ])

                        @endforeach

                    </div>

                </section>

            @endif

        </section>

    </div>

@endsection

