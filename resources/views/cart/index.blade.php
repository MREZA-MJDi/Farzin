@extends('layouts.app')

@section('title', 'سبد خرید | ژنان')

@section('meta_description', 'سبد خرید شما در ژنان؛ محصولات انتخاب‌شده خود را بررسی و سفارش خود را تکمیل کنید.')

@section('content')

    <div class="min-h-screen bg-[var(--background)]">

        <section class="mx-auto max-w-7xl px-4 py-7 sm:px-6 sm:py-10 lg:px-8 lg:py-12">

            {{-- =========================================================
                HEADER
            ========================================================== --}}

            <div class="relative overflow-hidden rounded-[28px] border border-[var(--border)] bg-white px-5 py-7 shadow-[var(--shadow-xs)] sm:px-7 sm:py-8 lg:px-9">

                {{-- Decorative background --}}
                <div
                    class="pointer-events-none absolute -right-20 -top-24 h-56 w-56 rounded-full bg-[var(--primary)]/10 blur-3xl"
                    aria-hidden="true"
                ></div>

                <div
                    class="pointer-events-none absolute -bottom-24 left-10 h-52 w-52 rounded-full bg-[var(--accent)]/10 blur-3xl"
                    aria-hidden="true"
                ></div>


                <div class="relative flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

                    <div class="min-w-0">

                        <div class="inline-flex items-center gap-2 text-[9px] font-black uppercase tracking-[0.24em] text-[var(--primary)] sm:text-[10px]">

                            <span class="h-1.5 w-1.5 rounded-full bg-[var(--primary)]"></span>

                            Your Cart

                        </div>


                        <h1 class="mt-2 text-2xl font-black tracking-tight text-[var(--text)] sm:text-3xl lg:text-4xl">
                            سبد خرید شما
                        </h1>


                        <p class="mt-2 max-w-2xl text-xs leading-7 text-[var(--text-secondary)] sm:text-sm">
                            انتخاب‌های تو اینجا جمع شده‌اند.
                            قبل از ادامه، محصولات و تعداد آن‌ها را بررسی کن.
                        </p>

                    </div>


                    @if($itemCount > 0)

                        <div class="inline-flex w-fit shrink-0 items-center gap-2 rounded-full border border-[var(--primary)]/15 bg-[var(--surface-soft)] px-4 py-2.5 text-[10px] font-black text-[var(--primary)]">

                            <svg
                                class="h-3.5 w-3.5"
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

                            {{ number_format($itemCount) }}

                            آیتم

                        </div>

                    @endif

                </div>

            </div>


            {{-- =========================================================
                FLASH MESSAGE
            ========================================================== --}}

            @if(session('success'))

                <div class="mt-5 rounded-2xl border border-emerald-200 bg-emerald-50/80 px-4 py-3.5 shadow-[var(--shadow-xs)]">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">

                            <svg
                                class="h-4 w-4"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path d="m5 12 4 4L19 6"/>
                            </svg>

                        </div>

                        <p class="text-xs font-bold text-emerald-700">
                            {{ session('success') }}
                        </p>

                    </div>

                </div>

            @endif


            {{-- =========================================================
                ERROR MESSAGE
            ========================================================== --}}

            @if(session('error'))

                <div class="mt-5 rounded-2xl border border-red-200 bg-red-50/80 px-4 py-3.5 shadow-[var(--shadow-xs)]">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-red-100 text-red-700">

                            <svg
                                class="h-4 w-4"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <circle cx="12" cy="12" r="9"/>
                                <path d="M12 8v5"/>
                                <path d="M12 16h.01"/>
                            </svg>

                        </div>

                        <p class="text-xs font-bold text-red-700">
                            {{ session('error') }}
                        </p>

                    </div>

                </div>

            @endif


            {{-- =========================================================
                EMPTY CART
            ========================================================== --}}

            @if($items->isEmpty())

                <div class="mt-6 overflow-hidden rounded-[28px] border border-[var(--border)] bg-white shadow-[var(--shadow-sm)]">

                    <div class="relative flex flex-col items-center overflow-hidden px-5 py-20 text-center sm:py-24">

                        {{-- Decorative --}}
                        <div
                            class="pointer-events-none absolute -right-16 -top-16 h-52 w-52 rounded-full bg-[var(--primary)]/10 blur-3xl"
                            aria-hidden="true"
                        ></div>

                        <div
                            class="pointer-events-none absolute -bottom-20 -left-16 h-56 w-56 rounded-full bg-[var(--accent)]/10 blur-3xl"
                            aria-hidden="true"
                        ></div>


                        {{-- Icon --}}
                        <div class="relative flex h-20 w-20 items-center justify-center rounded-[24px] border border-[var(--primary)]/10 bg-[linear-gradient(145deg,#eff9fd_0%,#fff4f7_100%)] text-[var(--primary)] shadow-[var(--shadow-xs)] sm:h-24 sm:w-24">

                            <svg
                                class="h-8 w-8 sm:h-9 sm:w-9"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.4"
                                aria-hidden="true"
                            >
                                <path d="M3 4h2l2.4 11.2a2 2 0 0 0 2 1.6h7.9a2 2 0 0 0 2-1.6L21 7H6"/>
                                <circle cx="10" cy="20" r="1"/>
                                <circle cx="18" cy="20" r="1"/>
                            </svg>

                        </div>


                        <span class="relative mt-7 text-[9px] font-black uppercase tracking-[0.25em] text-[var(--primary)]">
                            JANAN
                        </span>


                        <h2 class="relative mt-2 text-xl font-black text-[var(--text)] sm:text-2xl lg:text-3xl">
                            سبد خریدت خالیه
                        </h2>


                        <p class="relative mt-3 max-w-md text-xs leading-7 text-[var(--text-secondary)] sm:text-sm">
                            هنوز محصولی به سبد خرید اضافه نکردی.
                            چند انتخاب ظریف و دوست‌داشتنی منتظر تو هستند.
                        </p>


                        <a
                            href="{{ route('shop.index') }}"
                            class="group relative mt-7 inline-flex items-center gap-2.5 rounded-full bg-[var(--primary)] px-6 py-3.5 text-xs font-black text-white shadow-[0_14px_30px_rgba(143,201,232,.25)] transition duration-300 hover:-translate-y-0.5 hover:bg-[var(--primary-hover)]"
                        >

                            رفتن به فروشگاه

                            <svg
                                class="h-4 w-4 transition duration-300 group-hover:-translate-x-1"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path d="m9 18 6-6-6-6"/>
                            </svg>

                        </a>

                    </div>

                </div>

            @else

                {{-- =====================================================
                    CART CONTENT
                ====================================================== --}}

                <div class="mt-6 grid items-start gap-5 lg:grid-cols-[minmax(0,1fr)_360px] xl:gap-7">

                    {{-- =================================================
                        CART ITEMS
                    ================================================== --}}

                    <div class="space-y-3.5">

                        @foreach($items as $item)

                            @php
                                $product = $item->product;

                                /*
                                |--------------------------------------------------------------------------
                                | Image priority
                                |--------------------------------------------------------------------------
                                | 1. Primary image
                                | 2. First gallery image
                                | 3. Placeholder
                                |--------------------------------------------------------------------------
                                */

                                $imageModel = $product?->primaryImage;

                                if (
                                    !$imageModel &&
                                    $product &&
                                    $product->relationLoaded('images')
                                ) {
                                    $imageModel = $product->images->first();
                                }

                                /*
                                |--------------------------------------------------------------------------
                                | Fallback lazy relation
                                |--------------------------------------------------------------------------
                                */

                                if (!$imageModel && $product) {
                                    $imageModel = $product->images
                                        ->sortBy('sort_order')
                                        ->sortBy('id')
                                        ->first();
                                }

                                $image = $imageModel?->image;

                                $imageUrl = $image
                                    ? asset('storage/' . ltrim($image, '/'))
                                    : null;


                                /*
                                |--------------------------------------------------------------------------
                                | Line total
                                |--------------------------------------------------------------------------
                                */

                                $lineTotal =
                                    (int) $item->unit_price *
                                    (int) $item->quantity;


                                /*
                                |--------------------------------------------------------------------------
                                | Quantity
                                |--------------------------------------------------------------------------
                                */

                                $maxQuantity =
                                    min(
                                        max((int) ($product?->stock ?? 1), 1),
                                        99
                                    );


                                /*
                                |--------------------------------------------------------------------------
                                | Availability
                                |--------------------------------------------------------------------------
                                */

                                $isAvailable =
                                    $product &&
                                    $product->is_active &&
                                    (int) $product->stock > 0;
                            @endphp


                            @if($product)

                                <article class="group overflow-hidden rounded-[24px] border border-[var(--border)] bg-white p-3 shadow-[var(--shadow-xs)] transition duration-300 hover:border-[var(--primary)]/20 hover:shadow-[var(--shadow-sm)] sm:p-4">

                                    <div class="flex gap-3.5 sm:gap-5">


                                        {{-- =================================================
                                            PRODUCT IMAGE
                                        ================================================== --}}

                                        <a
                                            href="{{ route('products.show', $product) }}"
                                            class="block shrink-0"
                                        >

                                            <div class="relative h-28 w-24 overflow-hidden rounded-[18px] bg-[linear-gradient(145deg,#edf8fc_0%,#fff3f7_100%)] sm:h-32 sm:w-28">

                                                {{-- Soft light --}}
                                                <div
                                                    class="pointer-events-none absolute -right-4 -top-4 z-[1] h-20 w-20 rounded-full bg-white/70 blur-2xl"
                                                    aria-hidden="true"
                                                ></div>


                                                @if($imageUrl)

                                                    <img
                                                        src="{{ $imageUrl }}"
                                                        alt="{{ $imageModel?->alt ?: $product->name }}"
                                                        class="relative h-full w-full object-cover transition duration-700 group-hover:scale-[1.05]"
                                                        loading="lazy"
                                                        decoding="async"
                                                    >

                                                @else

                                                    <div class="flex h-full w-full items-center justify-center text-[var(--primary)]/45">

                                                        <svg
                                                            class="h-8 w-8"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="1.2"
                                                            aria-hidden="true"
                                                        >
                                                            <rect x="3" y="4" width="18" height="16" rx="2"/>
                                                            <circle cx="8.5" cy="9" r="1.4"/>
                                                            <path d="m21 15-5-5-4.5 4.5-2.5-2.5L3 18"/>
                                                        </svg>

                                                    </div>

                                                @endif


                                                @if(!$isAvailable)

                                                    <div class="absolute inset-0 z-10 flex items-center justify-center bg-slate-900/10">

                                                        <span class="rounded-full bg-white/95 px-2.5 py-1.5 text-[8px] font-black text-slate-700 shadow-sm backdrop-blur">
                                                            ناموجود
                                                        </span>

                                                    </div>

                                                @endif

                                            </div>

                                        </a>


                                        {{-- =================================================
                                            PRODUCT DETAILS
                                        ================================================== --}}

                                        <div class="min-w-0 flex-1">

                                            <div class="flex items-start justify-between gap-3">

                                                <div class="min-w-0">

                                                    @if($product->category)

                                                        <a
                                                            href="{{ route('categories.show', $product->category) }}"
                                                            class="inline-block max-w-full truncate text-[9px] font-black text-[var(--primary)] transition hover:text-[var(--primary-hover)] sm:text-[10px]"
                                                        >
                                                            {{ $product->category->name }}
                                                        </a>

                                                    @endif


                                                    <a
                                                        href="{{ route('products.show', $product) }}"
                                                        class="mt-1 block"
                                                    >

                                                        <h2 class="line-clamp-2 text-sm font-black leading-6 text-[var(--text)] transition hover:text-[var(--primary)] sm:text-base sm:leading-7">
                                                            {{ $item->product_name ?? $product->name }}
                                                        </h2>

                                                    </a>


                                                    @if($item->product_sku)

                                                        <div class="mt-1.5 text-[10px] text-[var(--text-muted)] sm:text-[11px]">

                                                            کد:

                                                            <span
                                                                dir="ltr"
                                                                class="font-mono font-bold text-[var(--text-secondary)]"
                                                            >
                                                                {{ $item->product_sku }}
                                                            </span>

                                                        </div>

                                                    @endif

                                                </div>


                                                {{-- Remove --}}
                                                <form
                                                    action="{{ route('customer.cart.remove', $product) }}"
                                                    method="POST"
                                                    class="shrink-0"
                                                    onsubmit="return confirm('آیا از حذف این محصول از سبد خرید مطمئن هستید؟');"
                                                >

                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="flex h-9 w-9 items-center justify-center rounded-xl text-[var(--text-muted)] transition hover:bg-red-50 hover:text-red-600"
                                                        title="حذف از سبد"
                                                        aria-label="حذف {{ $product->name }} از سبد خرید"
                                                    >

                                                        <svg
                                                            class="h-4 w-4"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="1.7"
                                                        >
                                                            <path d="M3 6h18"/>
                                                            <path d="M8 6V4h8v2"/>
                                                            <path d="M19 6l-1 15H6L5 6"/>
                                                            <path d="M10 11v6"/>
                                                            <path d="M14 11v6"/>
                                                        </svg>

                                                    </button>

                                                </form>

                                            </div>


                                            {{-- =================================================
                                                ITEM FOOTER
                                            ================================================== --}}

                                            <div class="mt-4 flex flex-col gap-3.5 sm:flex-row sm:items-end sm:justify-between">


                                                {{-- Quantity --}}
                                                <form
                                                    action="{{ route('customer.cart.update', $product) }}"
                                                    method="POST"
                                                    class="flex items-center gap-2.5"
                                                >

                                                    @csrf
                                                    @method('PATCH')

                                                    <input
                                                        type="hidden"
                                                        name="product_id"
                                                        value="{{ $product->id }}"
                                                    >

                                                    <span class="text-[10px] font-bold text-[var(--text-muted)] sm:text-[11px]">
                                                        تعداد
                                                    </span>


                                                    <div class="flex h-9 items-center overflow-hidden rounded-xl border border-[var(--border)] bg-[var(--surface-soft)]">

                                                        <button
                                                            type="button"
                                                            onclick="changeCartQuantity(this, -1)"
                                                            class="flex h-full w-9 items-center justify-center text-sm text-[var(--text-muted)] transition hover:bg-white hover:text-[var(--primary)]"
                                                            aria-label="کاهش تعداد"
                                                        >
                                                            −
                                                        </button>


                                                        <input
                                                            type="number"
                                                            name="quantity"
                                                            value="{{ $item->quantity }}"
                                                            min="1"
                                                            max="{{ $maxQuantity }}"
                                                            class="h-full w-11 border-x border-[var(--border)] bg-transparent text-center text-xs font-black text-[var(--text)] outline-none"
                                                            onchange="this.form.submit()"
                                                            aria-label="تعداد {{ $product->name }}"
                                                        >


                                                        <button
                                                            type="button"
                                                            onclick="changeCartQuantity(this, 1)"
                                                            class="flex h-full w-9 items-center justify-center text-sm text-[var(--text-muted)] transition hover:bg-white hover:text-[var(--primary)]"
                                                            aria-label="افزایش تعداد"
                                                        >
                                                            +
                                                        </button>

                                                    </div>

                                                </form>


                                                {{-- Price --}}
                                                <div class="text-right sm:text-left">

                                                    <div class="text-[10px] text-[var(--text-muted)] sm:text-[11px]">

                                                        {{ number_format((int) $item->unit_price) }}
                                                        تومان

                                                        <span class="mx-0.5">
                                                            ×
                                                        </span>

                                                        {{ number_format((int) $item->quantity) }}

                                                    </div>


                                                    <div class="mt-0.5 text-base font-black text-[var(--text)] sm:text-lg">

                                                        {{ number_format($lineTotal) }}

                                                        <span class="text-[9px] font-bold text-[var(--text-muted)] sm:text-[10px]">
                                                            تومان
                                                        </span>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </article>

                            @endif

                        @endforeach


                        {{-- =================================================
                            CLEAR CART
                        ================================================== --}}

                        <div class="flex justify-end pt-1">

                            <form
                                action="{{ route('customer.cart.clear') }}"
                                method="POST"
                                onsubmit="return confirm('از خالی کردن سبد خرید مطمئنی؟');"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="inline-flex items-center gap-2 rounded-full px-3.5 py-2 text-[10px] font-bold text-[var(--text-muted)] transition hover:bg-red-50 hover:text-red-600 sm:text-[11px]"
                                >

                                    <svg
                                        class="h-3.5 w-3.5"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.7"
                                    >
                                        <path d="M3 6h18"/>
                                        <path d="M8 6V4h8v2"/>
                                        <path d="M19 6l-1 15H6L5 6"/>
                                        <path d="M10 11v6"/>
                                        <path d="M14 11v6"/>
                                    </svg>

                                    خالی کردن سبد

                                </button>

                            </form>

                        </div>

                    </div>


                    {{-- =================================================
                        SUMMARY
                    ================================================== --}}

                    <aside class="lg:sticky lg:top-24 lg:self-start">

                        <div class="overflow-hidden rounded-[26px] border border-[var(--border)] bg-white shadow-[var(--shadow-sm)]">

                            {{-- Summary Header --}}
                            <div class="relative overflow-hidden border-b border-[var(--border)] px-5 py-5">

                                <div
                                    class="pointer-events-none absolute -right-10 -top-10 h-28 w-28 rounded-full bg-[var(--primary)]/10 blur-2xl"
                                    aria-hidden="true"
                                ></div>

                                <div class="relative">

                                    <div class="text-[9px] font-black uppercase tracking-[0.22em] text-[var(--primary)]">
                                        Order Summary
                                    </div>

                                    <h2 class="mt-1.5 text-lg font-black text-[var(--text)] sm:text-xl">
                                        خلاصه سفارش
                                    </h2>

                                </div>

                            </div>


                            <div class="space-y-4 px-5 py-5">

                                {{-- Count --}}
                                <div class="flex items-center justify-between gap-4 text-xs">

                                    <span class="text-[var(--text-secondary)]">
                                        تعداد اقلام
                                    </span>

                                    <span class="font-black text-[var(--text)]">
                                        {{ number_format($itemCount) }}
                                    </span>

                                </div>


                                {{-- Subtotal --}}
                                <div class="flex items-center justify-between gap-4 text-xs">

                                    <span class="text-[var(--text-secondary)]">
                                        مبلغ کالاها
                                    </span>

                                    <span class="font-black text-[var(--text)]">

                                        {{ number_format($subtotal) }}

                                        <span class="text-[9px] font-bold text-[var(--text-muted)]">
                                            تومان
                                        </span>

                                    </span>

                                </div>


                                {{-- Shipping --}}
                                <div class="flex items-center justify-between gap-4 text-xs">

                                    <span class="text-[var(--text-secondary)]">
                                        هزینه ارسال
                                    </span>

                                    <span class="rounded-full border border-[var(--border)] bg-[var(--surface-soft)] px-2.5 py-1.5 text-[9px] font-black text-[var(--text-muted)]">
                                        در مرحله بعد
                                    </span>

                                </div>


                                {{-- Total --}}
                                <div class="border-t border-dashed border-[var(--border)] pt-4">

                                    <div class="flex items-end justify-between gap-4">

                                        <div>

                                            <div class="text-[10px] text-[var(--text-muted)]">
                                                مبلغ فعلی سبد
                                            </div>

                                            <div class="mt-1 flex items-baseline gap-1.5">

                                                <span class="text-xl font-black tracking-tight text-[var(--text)] sm:text-2xl">
                                                    {{ number_format($subtotal) }}
                                                </span>

                                                <span class="text-[10px] font-bold text-[var(--text-muted)]">
                                                    تومان
                                                </span>

                                            </div>

                                        </div>


                                        <div class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1.5 text-[9px] font-black text-emerald-700">

                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                            امن

                                        </div>

                                    </div>

                                </div>


                                {{-- Checkout --}}
                                <a
                                    href="{{ route('customer.checkout.index') }}"
                                    class="group flex w-full items-center justify-center gap-2.5 rounded-xl bg-[var(--primary)] px-4 py-3.5 text-xs font-black text-white shadow-[0_14px_28px_rgba(143,201,232,.20)] transition duration-300 hover:-translate-y-0.5 hover:bg-[var(--primary-hover)]"
                                >

                                    ادامه و ثبت سفارش

                                    <svg
                                        class="h-4 w-4 transition duration-300 group-hover:-translate-x-1"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path d="m9 18 6-6-6-6"/>
                                    </svg>

                                </a>


                                {{-- Continue shopping --}}
                                <a
                                    href="{{ route('shop.index') }}"
                                    class="flex w-full items-center justify-center gap-2 rounded-xl border border-[var(--border)] px-4 py-3.5 text-xs font-black text-[var(--text-secondary)] transition hover:border-[var(--primary)]/30 hover:bg-[var(--surface-soft)] hover:text-[var(--primary)]"
                                >

                                    ادامه خرید

                                    <svg
                                        class="h-4 w-4"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path d="m9 18 6-6-6-6"/>
                                    </svg>

                                </a>

                            </div>


                            {{-- Trust --}}
                            <div class="border-t border-[var(--border)] bg-[linear-gradient(180deg,#f8fcfe_0%,#fff8fa_100%)] px-5 py-5">

                                <div class="space-y-4">

                                    <div class="flex items-start gap-2.5">

                                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-[var(--primary)] shadow-[var(--shadow-xs)]">

                                            <svg
                                                class="h-4 w-4"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <path d="M12 3 5 6v5c0 5 3 8.5 7 10 4-1.5 7-5 7-10V6l-7-3Z"/>
                                                <path d="m9 12 2 2 4-4"/>
                                            </svg>

                                        </div>

                                        <div>

                                            <div class="text-[10px] font-black text-[var(--text)]">
                                                پرداخت امن
                                            </div>

                                            <div class="mt-0.5 text-[9px] leading-5 text-[var(--text-muted)]">
                                                اطلاعات پرداخت شما محافظت می‌شود.
                                            </div>

                                        </div>

                                    </div>


                                    <div class="flex items-start gap-2.5">

                                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-[var(--primary)] shadow-[var(--shadow-xs)]">

                                            <svg
                                                class="h-4 w-4"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <path d="M3 7h11v10H3z"/>
                                                <path d="M14 10h3l4 4v3h-7z"/>
                                                <circle cx="7" cy="19" r="1.5"/>
                                                <circle cx="18" cy="19" r="1.5"/>
                                            </svg>

                                        </div>

                                        <div>

                                            <div class="text-[10px] font-black text-[var(--text)]">
                                                ارسال مطمئن
                                            </div>

                                            <div class="mt-0.5 text-[9px] leading-5 text-[var(--text-muted)]">
                                                شرایط ارسال در مرحله سفارش مشخص می‌شود.
                                            </div>

                                        </div>

                                    </div>


                                    <div class="flex items-start gap-2.5">

                                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-[var(--accent)] shadow-[var(--shadow-xs)]">

                                            <svg
                                                class="h-4 w-4"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4v8Z"/>
                                            </svg>

                                        </div>

                                        <div>

                                            <div class="text-[10px] font-black text-[var(--text)]">
                                                نیاز به کمک؟
                                            </div>

                                            <a
                                                href="{{ route('contact.index') }}"
                                                class="mt-0.5 inline-block text-[9px] font-bold text-[var(--primary)] hover:text-[var(--primary-hover)]"
                                            >
                                                تماس با پشتیبانی
                                            </a>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </aside>

                </div>

            @endif

        </section>

    </div>

@endsection


@push('scripts')

    <script>
        function changeCartQuantity(button, delta) {

            const form = button.closest('form');

            if (!form) {
                return;
            }


            const input = form.querySelector(
                'input[name="quantity"]'
            );

            if (!input) {
                return;
            }


            const min = parseInt(
                input.min || '1',
                10
            );


            const max = parseInt(
                input.max || '99',
                10
            );


            const current = parseInt(
                input.value || '1',
                10
            );


            const safeCurrent =
                Number.isFinite(current)
                    ? current
                    : min;


            const next = Math.min(
                max,
                Math.max(
                    min,
                    safeCurrent + delta
                )
            );


            input.value = next;

            form.submit();

        }
    </script>

@endpush
