@extends('layouts.app')

@section('title', 'تکمیل سفارش | ژنان')

@section(
    'meta_description',
    'تکمیل سفارش و ثبت اطلاعات ارسال در ژنان'
)

@section('content')

    @php
        /*
        |--------------------------------------------------------------------------
        | Summary
        |--------------------------------------------------------------------------
        */

        $summarySubtotal = (int) ($summary['subtotal'] ?? 0);

        $summaryDiscount = (int) ($summary['discount'] ?? 0);

        $summaryShipping = (int) ($summary['shipping'] ?? 0);

        $summaryTotal = (int) ($summary['total'] ?? 0);

        $summaryItemCount = (int) (
            $summary['item_count']
            ?? $itemCount
            ?? 0
        );


        /*
        |--------------------------------------------------------------------------
        | Selected address
        |--------------------------------------------------------------------------
        */

        $defaultAddress = $addresses
            ->firstWhere('is_default', true)
            ?: $addresses->first();

        $selectedAddressId = old(
            'address_id',
            $defaultAddress?->id
        );
    @endphp


    <div class="min-h-screen bg-[var(--background)]">

        <section class="mx-auto max-w-7xl px-4 py-7 sm:px-6 sm:py-10 lg:px-8 lg:py-12">

            {{-- =========================================================
                HEADER
            ========================================================== --}}

            <header class="relative overflow-hidden rounded-[28px] border border-[var(--border)] bg-white px-5 py-7 shadow-[var(--shadow-xs)] sm:px-7 sm:py-8 lg:px-9">

                <div
                    class="pointer-events-none absolute -right-16 -top-20 h-48 w-48 rounded-full bg-[var(--primary)]/10 blur-3xl"
                    aria-hidden="true"
                ></div>

                <div
                    class="pointer-events-none absolute -bottom-20 left-20 h-48 w-48 rounded-full bg-[var(--accent)]/10 blur-3xl"
                    aria-hidden="true"
                ></div>


                <div class="relative flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

                    <div>

                        <div class="inline-flex items-center gap-2 text-[9px] font-black uppercase tracking-[0.22em] text-[var(--primary)] sm:text-[10px]">

                            <span class="h-1.5 w-1.5 rounded-full bg-[var(--primary)]"></span>

                            JANAN CHECKOUT

                        </div>


                        <h1 class="mt-2 text-2xl font-black tracking-tight text-[var(--text)] sm:text-3xl lg:text-4xl">
                            تکمیل سفارش
                        </h1>


                        <p class="mt-2 max-w-2xl text-xs leading-7 text-[var(--text-secondary)] sm:text-sm">
                            آدرس تحویل و اطلاعات سفارش را بررسی کن و سفارش خود را با خیال راحت ثبت کن.
                        </p>

                    </div>


                    <a
                        href="{{ route('customer.cart.index') }}"
                        class="group inline-flex w-fit items-center gap-2 rounded-full border border-[var(--border)] bg-[var(--surface-soft)] px-4 py-2.5 text-[10px] font-black text-[var(--text-secondary)] transition hover:border-[var(--primary)]/25 hover:bg-white hover:text-[var(--primary)]"
                    >

                        <svg
                            class="h-3.5 w-3.5 transition group-hover:translate-x-0.5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            aria-hidden="true"
                        >
                            <path d="m15 18-6-6 6-6"/>
                        </svg>

                        بازگشت به سبد

                    </a>

                </div>

            </header>


            {{-- =========================================================
                SUCCESS
            ========================================================== --}}

            @if(session('success'))

                <div class="mt-5 rounded-2xl border border-emerald-200 bg-emerald-50/80 px-4 py-3.5 shadow-[var(--shadow-xs)]">

                    <div class="flex items-start gap-3">

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


                        <div>

                            <div class="text-xs font-black text-emerald-800">
                                عملیات موفق
                            </div>

                            <p class="mt-0.5 text-[11px] font-bold leading-6 text-emerald-700">
                                {{ session('success') }}
                            </p>

                        </div>

                    </div>

                </div>

            @endif


            {{-- =========================================================
                ERROR
            ========================================================== --}}

            @if(session('error'))

                <div class="mt-5 rounded-2xl border border-red-200 bg-red-50/80 px-4 py-3.5 shadow-[var(--shadow-xs)]">

                    <div class="flex items-start gap-3">

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


                        <div>

                            <div class="text-xs font-black text-red-800">
                                خطا در ثبت سفارش
                            </div>

                            <p class="mt-0.5 text-[11px] font-bold leading-6 text-red-700">
                                {{ session('error') }}
                            </p>

                        </div>

                    </div>

                </div>

            @endif


            {{-- =========================================================
                VALIDATION
            ========================================================== --}}

            @if($errors->any())

                <div class="mt-5 rounded-2xl border border-red-200 bg-red-50/80 px-4 py-4">

                    <div class="text-xs font-black text-red-700">
                        لطفاً اطلاعات سفارش را بررسی کن.
                    </div>

                    <ul class="mt-2 space-y-1 text-[11px] leading-5 text-red-600">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- =========================================================
                CHECKOUT FORM
            ========================================================== --}}

            <form
                id="checkoutOrderForm"
                action="{{ route('customer.checkout.store') }}"
                method="POST"
                class="mt-6"
            >

                @csrf


                <div class="grid items-start gap-5 lg:grid-cols-[minmax(0,1fr)_360px] xl:gap-7">


                    {{-- =================================================
                        LEFT COLUMN
                    ================================================== --}}

                    <div class="space-y-5">


                        {{-- =================================================
                            SHIPPING ADDRESS
                        ================================================== --}}

                        <section class="overflow-hidden rounded-[25px] border border-[var(--border)] bg-white shadow-[var(--shadow-xs)]">

                            {{-- Header --}}
                            <div class="relative border-b border-[var(--border)] px-5 py-5 sm:px-6">

                                <div
                                    class="pointer-events-none absolute -right-10 -top-10 h-24 w-24 rounded-full bg-[var(--primary)]/8 blur-2xl"
                                    aria-hidden="true"
                                ></div>


                                <div class="relative flex items-start gap-3">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[linear-gradient(145deg,#eef9fd,#fff4f7)] text-[var(--primary)]">

                                        <svg
                                            class="h-5 w-5"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.7"
                                            aria-hidden="true"
                                        >
                                            <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/>
                                            <circle cx="12" cy="10" r="2.5"/>
                                        </svg>

                                    </div>


                                    <div class="min-w-0 flex-1">

                                        <div class="flex flex-wrap items-center gap-2">

                                            <h2 class="text-base font-black text-[var(--text)] sm:text-lg">
                                                آدرس ارسال
                                            </h2>


                                            <span class="rounded-full bg-[var(--surface-soft)] px-2.5 py-1 text-[8px] font-black text-[var(--text-muted)]">
                                                {{ number_format($addresses->count()) }} آدرس
                                            </span>

                                        </div>


                                        <p class="mt-1 text-xs leading-6 text-[var(--text-secondary)]">
                                            آدرس موردنظر برای تحویل سفارش را انتخاب کن.
                                        </p>

                                    </div>

                                </div>

                            </div>


                            {{-- Saved addresses --}}
                            <div class="px-5 py-5 sm:px-6">

                                @if($addresses->isNotEmpty())

                                    <div class="space-y-3">

                                        @foreach($addresses as $address)

                                            @php

                                                $addressLabel = collect([
                                                    $address->country ?? null,
                                                    $address->province ?? null,
                                                    $address->city ?? null,
                                                    $address->address ?? null,
                                                ])
                                                    ->filter()
                                                    ->implode('، ');


                                                $isChecked =
                                                    (string) $selectedAddressId ===
                                                    (string) $address->id;

                                            @endphp


                                            <label
                                                for="address-{{ $address->id }}"
                                                class="group block cursor-pointer"
                                            >

                                                <input
                                                    type="radio"
                                                    id="address-{{ $address->id }}"
                                                    name="address_id"
                                                    value="{{ $address->id }}"
                                                    form="checkoutOrderForm"
                                                    @checked($isChecked)
                                                    required
                                                    class="peer sr-only"
                                                >


                                                <div class="rounded-2xl border border-[var(--border)] bg-white p-4 transition duration-300 group-hover:border-[var(--primary)]/20 peer-checked:border-[var(--primary)]/35 peer-checked:bg-[linear-gradient(145deg,#f7fcfe,#fff8fa)] peer-checked:ring-4 peer-checked:ring-[var(--primary)]/8">

                                                    <div class="flex items-start gap-3">

                                                        {{-- Custom radio --}}
                                                        <div class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-full border-2 border-[var(--border-strong)] transition peer-checked:border-[var(--primary)]">

                                                            <span class="h-2.5 w-2.5 scale-50 rounded-full bg-[var(--primary)] opacity-0 transition peer-checked:scale-100 peer-checked:opacity-100"></span>

                                                        </div>


                                                        {{-- Content --}}
                                                        <div class="min-w-0 flex-1">

                                                            <div class="flex flex-wrap items-center gap-2">

                                                                <span class="text-xs font-black text-[var(--text)]">
                                                                    {{ $address->title ?: 'آدرس تحویل' }}
                                                                </span>


                                                                @if($address->is_default)

                                                                    <span class="rounded-full bg-emerald-50 px-2 py-1 text-[8px] font-black text-emerald-700">
                                                                        پیش‌فرض
                                                                    </span>

                                                                @endif

                                                            </div>


                                                            @if($addressLabel)

                                                                <p class="mt-2 text-xs leading-7 text-[var(--text-secondary)]">
                                                                    {{ $addressLabel }}
                                                                </p>

                                                            @endif


                                                            <div class="mt-2 flex flex-wrap items-center gap-x-4 gap-y-1 text-[10px] text-[var(--text-muted)]">

                                                                @if($address->full_name)

                                                                    <span>

                                                                        گیرنده:

                                                                        <strong class="font-bold text-[var(--text-secondary)]">
                                                                            {{ $address->full_name }}
                                                                        </strong>

                                                                    </span>

                                                                @endif


                                                                @if($address->phone)

                                                                    <span dir="ltr">
                                                                        {{ $address->phone }}
                                                                    </span>

                                                                @endif

                                                            </div>


                                                            <div class="mt-2 flex flex-wrap items-center gap-2">

                                                                @if($address->postal_code)

                                                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-[var(--surface-soft)] px-2.5 py-1 text-[8px] font-bold text-[var(--text-muted)]">

                                                                        کد پستی:

                                                                        <span
                                                                            dir="ltr"
                                                                            class="font-mono text-[var(--text-secondary)]"
                                                                        >
                                                                            {{ $address->postal_code }}
                                                                        </span>

                                                                    </span>

                                                                @endif


                                                                @if(
                                                                    $address->latitude !== null &&
                                                                    $address->longitude !== null
                                                                )

                                                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-[8px] font-bold text-emerald-700">

                                                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                                                        موقعیت روی نقشه ثبت شده

                                                                    </span>

                                                                @endif

                                                            </div>

                                                        </div>


                                                        {{-- Edit --}}
                                                        <a
                                                            href="{{ route('customer.addresses.edit', $address) }}"
                                                            class="shrink-0 rounded-lg px-2 py-1.5 text-[9px] font-black text-[var(--primary)] transition hover:bg-[var(--surface-soft)]"
                                                            onclick="event.stopPropagation();"
                                                        >
                                                            ویرایش
                                                        </a>

                                                    </div>

                                                </div>

                                            </label>

                                        @endforeach

                                    </div>


                                    {{-- Address actions --}}
                                    <div class="mt-5 flex flex-col gap-3 border-t border-[var(--border)] pt-5 sm:flex-row sm:items-center sm:justify-between">

                                        <div>

                                            <div class="text-xs font-black text-[var(--text)]">
                                                آدرس دیگری نیاز داری؟
                                            </div>

                                            <p class="mt-1 text-[10px] leading-5 text-[var(--text-muted)]">
                                                یک آدرس جدید همراه با موقعیت دقیق روی نقشه ثبت کن.
                                            </p>

                                        </div>


                                        <a
                                            href="{{ route('customer.addresses.create') }}"
                                            class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-[var(--primary)]/15 bg-[var(--surface-soft)] px-4 py-3 text-[10px] font-black text-[var(--primary)] transition hover:border-[var(--primary)]/30 hover:bg-white sm:w-auto"
                                        >

                                            <svg
                                                class="h-4 w-4"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                aria-hidden="true"
                                            >
                                                <path d="M12 5v14"/>
                                                <path d="M5 12h14"/>
                                            </svg>

                                            افزودن آدرس جدید

                                        </a>

                                    </div>

                                @else

                                    {{-- Empty address --}}
                                    <div class="relative overflow-hidden rounded-2xl border border-dashed border-[var(--border-strong)] bg-[linear-gradient(145deg,#f6fbfd,#fff7fa)] px-5 py-11 text-center">

                                        <div
                                            class="pointer-events-none absolute -right-10 -top-10 h-28 w-28 rounded-full bg-[var(--primary)]/10 blur-2xl"
                                            aria-hidden="true"
                                        ></div>


                                        <div class="relative mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-[var(--primary)] shadow-[var(--shadow-xs)]">

                                            <svg
                                                class="h-6 w-6"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.7"
                                                aria-hidden="true"
                                            >
                                                <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/>
                                                <circle cx="12" cy="10" r="2.5"/>
                                            </svg>

                                        </div>


                                        <h3 class="relative mt-4 text-sm font-black text-[var(--text)]">
                                            هنوز آدرس ارسالی ثبت نشده است
                                        </h3>


                                        <p class="relative mx-auto mt-1.5 max-w-md text-[10px] leading-6 text-[var(--text-muted)]">
                                            برای ادامه سفارش، ابتدا یک آدرس همراه با موقعیت دقیق روی نقشه ثبت کن.
                                        </p>


                                        <a
                                            href="{{ route('customer.addresses.create') }}"
                                            class="relative mt-5 inline-flex items-center gap-2 rounded-full bg-[var(--primary)] px-5 py-3 text-[10px] font-black text-white shadow-[0_12px_26px_rgba(143,201,232,.22)] transition hover:-translate-y-0.5 hover:bg-[var(--primary-hover)]"
                                        >

                                            <svg
                                                class="h-4 w-4"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                aria-hidden="true"
                                            >
                                                <path d="M12 5v14"/>
                                                <path d="M5 12h14"/>
                                            </svg>

                                            ثبت آدرس ارسال

                                        </a>

                                    </div>

                                @endif


                                @error('address_id')

                                <p class="mt-3 text-xs font-bold text-red-600">
                                    {{ $message }}
                                </p>

                                @enderror

                            </div>

                        </section>


                        {{-- =================================================
                            ORDER NOTES
                        ================================================== --}}

                        <section class="rounded-[25px] border border-[var(--border)] bg-white p-5 shadow-[var(--shadow-xs)] sm:p-6">

                            <div class="mb-5">

                                <div class="text-[9px] font-black uppercase tracking-[0.2em] text-[var(--primary)]">
                                    OPTIONAL
                                </div>

                                <h2 class="mt-1.5 text-base font-black text-[var(--text)] sm:text-lg">
                                    توضیحات سفارش
                                </h2>

                                <p class="mt-1 text-xs leading-6 text-[var(--text-secondary)]">
                                    توضیحات اختیاری مربوط به سفارش یا نحوه تحویل.
                                </p>

                            </div>


                            <textarea
                                id="notes"
                                name="notes"
                                rows="4"
                                maxlength="2000"
                                placeholder="مثلاً زمان مناسب تحویل، توضیحات ورود به ساختمان و..."
                                class="w-full resize-y rounded-2xl border border-[var(--border)] bg-[var(--surface-soft)] px-4 py-3.5 text-xs leading-7 text-[var(--text)] outline-none transition placeholder:text-[var(--text-muted)] focus:border-[var(--primary)]/35 focus:bg-white focus:ring-4 focus:ring-[var(--primary)]/8 @error('notes') border-red-400 @enderror"
                            >{{ old('notes') }}</textarea>


                            <div class="mt-2 flex items-center justify-between gap-3">

                                <span class="text-[10px] text-[var(--text-muted)]">
                                    اختیاری
                                </span>

                                <span class="text-[10px] text-[var(--text-muted)]">
                                    حداکثر ۲۰۰۰ کاراکتر
                                </span>

                            </div>


                            @error('notes')

                            <p class="mt-2 text-[10px] font-bold text-red-600">
                                {{ $message }}
                            </p>

                            @enderror

                        </section>


                        {{-- =================================================
                            ORDER ITEMS
                        ================================================== --}}

                        <section class="rounded-[25px] border border-[var(--border)] bg-white p-5 shadow-[var(--shadow-xs)] sm:p-6">

                            <div class="mb-5 flex items-end justify-between gap-3">

                                <div>

                                    <div class="text-[9px] font-black uppercase tracking-[0.2em] text-[var(--primary)]">
                                        YOUR ORDER
                                    </div>

                                    <h2 class="mt-1.5 text-base font-black text-[var(--text)] sm:text-lg">
                                        اقلام سفارش
                                    </h2>

                                </div>


                                <span class="rounded-full bg-[var(--surface-soft)] px-2.5 py-1.5 text-[9px] font-black text-[var(--text-secondary)]">

                                    {{ number_format($summaryItemCount) }}

                                    آیتم

                                </span>

                            </div>


                            <div class="divide-y divide-[var(--border)]">

                                @foreach($items as $item)

                                    @php

                                        $product = $item['product'] ?? null;

                                        $quantity = (int) (
                                            $item['quantity'] ?? 0
                                        );

                                        $unitPrice = (int) (
                                            $item['unit_price'] ?? 0
                                        );

                                        $lineTotal = (int) (
                                            $item['total']
                                            ?? (
                                                $unitPrice *
                                                $quantity
                                            )
                                        );


                                        $imageModel = null;

                                        if ($product) {

                                            $imageModel =
                                                $product->primaryImage
                                                ?? null;


                                            if (
                                                !$imageModel &&
                                                $product->relationLoaded('images')
                                            ) {

                                                $imageModel =
                                                    $product->images->first();

                                            }

                                        }


                                        $imageUrl =
                                            $imageModel?->image
                                                ? asset(
                                                    'storage/' .
                                                    ltrim(
                                                        $imageModel->image,
                                                        '/'
                                                    )
                                                )
                                                : null;

                                    @endphp


                                    @if($product)

                                        <div class="flex gap-3 py-4 first:pt-0 last:pb-0">

                                            {{-- Image --}}
                                            <a
                                                href="{{ route('products.show', $product) }}"
                                                class="h-[72px] w-[62px] shrink-0 overflow-hidden rounded-2xl bg-[linear-gradient(145deg,#edf8fc,#fff3f7)] sm:h-20 sm:w-[70px]"
                                            >

                                                @if($imageUrl)

                                                    <img
                                                        src="{{ $imageUrl }}"
                                                        alt="{{ $imageModel?->alt ?: $product->name }}"
                                                        class="h-full w-full object-cover transition duration-500 hover:scale-105"
                                                        loading="lazy"
                                                        decoding="async"
                                                    >

                                                @else

                                                    <div class="flex h-full w-full items-center justify-center text-[var(--primary)]/40">

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
                                                                r="1.4"
                                                            />

                                                            <path d="m21 15-5-5-4 4-2-2-7 7"/>
                                                        </svg>

                                                    </div>

                                                @endif

                                            </a>


                                            {{-- Info --}}
                                            <div class="min-w-0 flex-1">

                                                <a
                                                    href="{{ route('products.show', $product) }}"
                                                    class="block truncate text-xs font-black text-[var(--text)] transition hover:text-[var(--primary)] sm:text-sm"
                                                >
                                                    {{ $product->name }}
                                                </a>


                                                @if($product->sku)

                                                    <div class="mt-1 text-[9px] text-[var(--text-muted)]">

                                                        SKU:

                                                        <span
                                                            dir="ltr"
                                                            class="font-mono font-bold text-[var(--text-secondary)]"
                                                        >
                                                            {{ $product->sku }}
                                                        </span>

                                                    </div>

                                                @endif


                                                <div class="mt-1.5 text-[10px] text-[var(--text-muted)]">

                                                    {{ number_format($quantity) }}

                                                    عدد

                                                    <span class="mx-1">
                                                        ×
                                                    </span>

                                                    {{ number_format($unitPrice) }}

                                                    تومان

                                                </div>

                                            </div>


                                            {{-- Total --}}
                                            <div class="shrink-0 text-left">

                                                <div class="text-xs font-black text-[var(--text)] sm:text-sm">
                                                    {{ number_format($lineTotal) }}
                                                </div>

                                                <div class="mt-0.5 text-[9px] text-[var(--text-muted)]">
                                                    تومان
                                                </div>

                                            </div>

                                        </div>

                                    @endif

                                @endforeach

                            </div>

                        </section>

                    </div>


                    {{-- =================================================
                        RIGHT SUMMARY
                    ================================================== --}}

                    <aside class="lg:sticky lg:top-24 lg:self-start">

                        <div class="overflow-hidden rounded-[26px] border border-[var(--border)] bg-white shadow-[var(--shadow-sm)]">

                            {{-- Header --}}
                            <div class="relative overflow-hidden border-b border-[var(--border)] px-5 py-5">

                                <div
                                    class="pointer-events-none absolute -right-10 -top-10 h-28 w-28 rounded-full bg-[var(--primary)]/10 blur-2xl"
                                    aria-hidden="true"
                                ></div>


                                <div class="relative">

                                    <div class="text-[9px] font-black uppercase tracking-[0.2em] text-[var(--primary)]">
                                        ORDER SUMMARY
                                    </div>

                                    <h2 class="mt-1.5 text-lg font-black text-[var(--text)] sm:text-xl">
                                        خلاصه سفارش
                                    </h2>

                                </div>

                            </div>


                            {{-- Body --}}
                            <div class="space-y-4 px-5 py-5">

                                {{-- Item count --}}
                                <div class="flex items-center justify-between gap-4 text-xs">

                                    <span class="text-[var(--text-secondary)]">
                                        تعداد اقلام
                                    </span>

                                    <span class="font-black text-[var(--text)]">
                                        {{ number_format($summaryItemCount) }}
                                    </span>

                                </div>


                                {{-- Subtotal --}}
                                <div class="flex items-center justify-between gap-4 text-xs">

                                    <span class="text-[var(--text-secondary)]">
                                        مبلغ کالاها
                                    </span>

                                    <span class="font-black text-[var(--text)]">

                                        {{ number_format($summarySubtotal) }}

                                        <span class="text-[9px] font-bold text-[var(--text-muted)]">
                                            تومان
                                        </span>

                                    </span>

                                </div>


                                {{-- Discount --}}
                                @if($summaryDiscount > 0)

                                    <div class="flex items-center justify-between gap-4 text-xs">

                                        <span class="text-[var(--text-secondary)]">
                                            تخفیف
                                        </span>

                                        <span class="font-black text-emerald-700">

                                            -

                                            {{ number_format($summaryDiscount) }}

                                            <span class="text-[9px]">
                                                تومان
                                            </span>

                                        </span>

                                    </div>

                                @endif


                                {{-- Shipping --}}
                                <div class="flex items-center justify-between gap-4 text-xs">

                                    <span class="text-[var(--text-secondary)]">
                                        هزینه ارسال
                                    </span>


                                    @if($summaryShipping > 0)

                                        <span class="font-black text-[var(--text)]">

                                            {{ number_format($summaryShipping) }}

                                            <span class="text-[9px] text-[var(--text-muted)]">
                                                تومان
                                            </span>

                                        </span>

                                    @else

                                        <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-[9px] font-black text-emerald-700">
                                            رایگان
                                        </span>

                                    @endif

                                </div>


                                {{-- Total --}}
                                <div class="border-t border-dashed border-[var(--border)] pt-4">

                                    <div class="flex items-end justify-between gap-4">

                                        <div>

                                            <div class="text-[10px] text-[var(--text-muted)]">
                                                مبلغ نهایی
                                            </div>

                                            <div class="mt-1 flex items-baseline gap-1.5">

                                                <span class="text-xl font-black tracking-tight text-[var(--text)] sm:text-2xl">
                                                    {{ number_format($summaryTotal) }}
                                                </span>

                                                <span class="text-[10px] font-bold text-[var(--text-muted)]">
                                                    تومان
                                                </span>

                                            </div>

                                        </div>


                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1.5 text-[9px] font-black text-emerald-700">

                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                            امن

                                        </span>

                                    </div>

                                </div>


                                {{-- Submit --}}
                                <button
                                    type="submit"
                                    @disabled($addresses->isEmpty())
                                    class="group flex w-full items-center justify-center gap-2.5 rounded-xl bg-[var(--primary)] px-4 py-3.5 text-xs font-black text-white shadow-[0_14px_30px_rgba(143,201,232,.22)] transition duration-300 hover:-translate-y-0.5 hover:bg-[var(--primary-hover)] focus:outline-none focus:ring-4 focus:ring-[var(--primary)]/10 disabled:cursor-not-allowed disabled:bg-[var(--text-muted)] disabled:shadow-none disabled:hover:translate-y-0"
                                    >

                                    ثبت سفارش و ادامه پرداخت

                                    <svg
                                        class="h-4 w-4 transition duration-300 group-hover:-translate-x-1"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path d="m9 18 6-6-6-6"/>
                                    </svg>

                                </button>


                                <p class="text-center text-[9px] leading-5 text-[var(--text-muted)]">
                                    پس از ثبت سفارش به مرحله پرداخت منتقل خواهی شد.
                                </p>

                            </div>


                            {{-- Trust --}}
                            <div class="border-t border-[var(--border)] bg-[linear-gradient(180deg,#f8fcfe,#fff8fa)] px-5 py-5">

                                <div class="space-y-3.5">

                                    <div class="flex items-center gap-2.5">

                                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-[var(--primary)] shadow-[var(--shadow-xs)]">

                                            <svg
                                                class="h-4 w-4"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                aria-hidden="true"
                                            >
                                                <path d="M12 3 5 6v5c0 5 3 8.5 7 10 4-1.5 7-5 7-10V6l-7-3Z"/>
                                                <path d="m9 12 2 2 4-4"/>
                                            </svg>

                                        </div>

                                        <span class="text-[10px] font-bold text-[var(--text-secondary)]">
                                            پرداخت امن و محافظت‌شده
                                        </span>

                                    </div>


                                    <div class="flex items-center gap-2.5">

                                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-[var(--primary)] shadow-[var(--shadow-xs)]">

                                            <svg
                                                class="h-4 w-4"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                aria-hidden="true"
                                            >
                                                <path d="M3 7h11v10H3z"/>
                                                <path d="M14 10h3l4 4v3h-7z"/>
                                                <circle cx="7" cy="19" r="1.5"/>
                                                <circle cx="18" cy="19" r="1.5"/>
                                            </svg>

                                        </div>

                                        <span class="text-[10px] font-bold text-[var(--text-secondary)]">
                                            ارسال مطمئن سفارش
                                        </span>

                                    </div>


                                    @if($addresses->isNotEmpty())

                                        <div class="flex items-center gap-2.5">

                                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-[var(--accent)] shadow-[var(--shadow-xs)]">

                                                <svg
                                                    class="h-4 w-4"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                    aria-hidden="true"
                                                >
                                                    <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/>
                                                    <circle cx="12" cy="10" r="2.5"/>
                                                </svg>

                                            </div>

                                            <span class="text-[10px] font-bold text-[var(--text-secondary)]">
                                                آدرس آماده ارسال است
                                            </span>

                                        </div>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </aside>

                </div>

            </form>

        </section>

    </div>

@endsection
