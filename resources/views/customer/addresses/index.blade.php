@extends('layouts.app')

@section('title', 'آدرس‌های من | فرزین')

@section('meta_description', 'مدیریت و ویرایش آدرس‌های ارسال در حساب کاربری فرزین')

@section('content')

    <div class="min-h-screen bg-[var(--color-neutral-50)]">

        <section class="mx-auto max-w-5xl px-4 py-7 sm:px-6 sm:py-9 lg:px-8 lg:py-11">

            {{-- =========================================================
                HEADER
            ========================================================== --}}

            <header class="mb-7">

                <div class="inline-flex items-center gap-2 text-[9px] font-black uppercase tracking-[0.2em] text-[var(--color-accent-600)] sm:text-[10px]">

                    <span class="h-1.5 w-1.5 rounded-full bg-[var(--color-accent-600)]"></span>

                    Addresses

                </div>


                <div class="mt-2 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

                    <div>

                        <h1 class="text-2xl font-black tracking-tight text-[var(--color-text-primary)] sm:text-3xl">
                            آدرس‌های من
                        </h1>

                        <p class="mt-1.5 max-w-2xl text-xs leading-6 text-[var(--color-text-secondary)] sm:text-sm">
                            آدرس‌های ارسال خود را مدیریت کنید و موقعیت دقیق تحویل را ثبت کنید.
                        </p>

                    </div>


                    <a
                        href="{{ route('customer.addresses.create') }}"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[var(--color-brand-600)] px-4 py-3 text-xs font-black text-white transition hover:bg-[var(--color-brand-700)] sm:w-auto"
                    >

                        <svg
                            class="h-4 w-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path d="M12 5v14"/>
                            <path d="M5 12h14"/>
                        </svg>

                        افزودن آدرس

                    </a>

                </div>

            </header>


            {{-- =========================================================
                FLASH SUCCESS
            ========================================================== --}}

            @if(session('success'))

                <div class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3">

                    <div class="flex items-start gap-3">

                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">

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
                FLASH ERROR
            ========================================================== --}}

            @if(session('error'))

                <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 px-4 py-3">

                    <div class="flex items-start gap-3">

                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-red-100 text-red-700">

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
                                خطا
                            </div>

                            <p class="mt-0.5 text-[11px] font-bold leading-6 text-red-700">
                                {{ session('error') }}
                            </p>

                        </div>

                    </div>

                </div>

            @endif


            {{-- =========================================================
                ADDRESSES
            ========================================================== --}}

            @if($addresses->isNotEmpty())

                <div class="space-y-4">

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

                        @endphp


                        <article
                            class="overflow-hidden rounded-2xl border {{ $address->is_default
                                ? 'border-[var(--color-brand-300)]'
                                : 'border-[var(--color-border)]' }}
                                bg-white shadow-[var(--shadow-xs)]"
                        >

                            <div class="p-5 sm:p-6">

                                <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">

                                    {{-- Address content --}}
                                    <div class="min-w-0 flex-1">

                                        <div class="flex flex-wrap items-center gap-2">

                                            <h2 class="text-sm font-black text-[var(--color-text-primary)] sm:text-base">
                                                {{ $address->title ?: 'آدرس تحویل' }}
                                            </h2>


                                            @if($address->is_default)

                                                <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-[9px] font-black text-emerald-700">
                                                    پیش‌فرض
                                                </span>

                                            @endif

                                        </div>


                                        <p class="mt-3 text-xs leading-7 text-[var(--color-text-secondary)]">
                                            {{ $addressLabel }}
                                        </p>


                                        <div class="mt-3 flex flex-wrap items-center gap-x-5 gap-y-2 text-[10px] text-[var(--color-text-muted)]">

                                            @if($address->full_name)

                                                <span>
                                                    گیرنده:

                                                    <strong class="font-bold text-[var(--color-text-secondary)]">
                                                        {{ $address->full_name }}
                                                    </strong>
                                                </span>

                                            @endif


                                            @if($address->phone)

                                                <span dir="ltr">
                                                    {{ $address->phone }}
                                                </span>

                                            @endif


                                            @if($address->postal_code)

                                                <span>

                                                    کد پستی:

                                                    <strong
                                                        dir="ltr"
                                                        class="font-mono font-bold text-[var(--color-text-secondary)]"
                                                    >
                                                        {{ $address->postal_code }}
                                                    </strong>

                                                </span>

                                            @endif

                                        </div>


                                        <div class="mt-3 flex flex-wrap gap-2">

                                            @if(
                                                $address->latitude !== null &&
                                                $address->longitude !== null
                                            )

                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1.5 text-[8px] font-black text-emerald-700">

                                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                                    موقعیت روی نقشه ثبت شده

                                                </span>

                                            @else

                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-2.5 py-1.5 text-[8px] font-black text-amber-700">

                                                    موقعیت نقشه ثبت نشده

                                                </span>

                                            @endif

                                        </div>

                                    </div>


                                    {{-- Actions --}}
                                    <div class="flex flex-wrap items-center gap-2 lg:justify-end">

                                        @if(!$address->is_default)

                                            <form
                                                action="{{ route('customer.addresses.default', $address) }}"
                                                method="POST"
                                            >

                                                @csrf

                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center gap-1.5 rounded-xl border border-[var(--color-border)] bg-white px-3 py-2.5 text-[10px] font-black text-[var(--color-text-secondary)] transition hover:border-[var(--color-brand-300)] hover:bg-[var(--color-brand-50)] hover:text-[var(--color-brand-700)]"
                                                >

                                                    پیش‌فرض کردن

                                                </button>

                                            </form>

                                        @endif


                                        <a
                                            href="{{ route('customer.addresses.edit', $address) }}"
                                            class="inline-flex items-center gap-1.5 rounded-xl border border-[var(--color-brand-200)] bg-[var(--color-brand-50)] px-3 py-2.5 text-[10px] font-black text-[var(--color-brand-700)] transition hover:border-[var(--color-brand-300)] hover:bg-[var(--color-brand-100)]"
                                        >

                                            <svg
                                                class="h-3.5 w-3.5"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <path d="M12 20h9"/>
                                                <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z"/>
                                            </svg>

                                            ویرایش

                                        </a>


                                        <form
                                            action="{{ route('customer.addresses.destroy', $address) }}"
                                            method="POST"
                                            onsubmit="return confirm('آیا از حذف این آدرس مطمئن هستید؟');"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="inline-flex items-center gap-1.5 rounded-xl border border-red-200 bg-red-50 px-3 py-2.5 text-[10px] font-black text-red-700 transition hover:border-red-300 hover:bg-red-100"
                                            >

                                                <svg
                                                    class="h-3.5 w-3.5"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                >
                                                    <path d="M3 6h18"/>
                                                    <path d="M8 6V4h8v2"/>
                                                    <path d="m19 6-1 14H6L5 6"/>
                                                    <path d="M10 11v5M14 11v5"/>
                                                </svg>

                                                حذف

                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </div>


                            {{-- Map metadata --}}
                            @if(
                                $address->latitude !== null &&
                                $address->longitude !== null
                            )

                                <div class="border-t border-[var(--color-border)] bg-[var(--color-neutral-50)] px-5 py-3 sm:px-6">

                                    <div class="flex flex-wrap items-center justify-between gap-2">

                                        <span class="text-[9px] text-[var(--color-text-muted)]">
                                            موقعیت ثبت‌شده
                                        </span>

                                        <span
                                            dir="ltr"
                                            class="font-mono text-[9px] font-bold text-[var(--color-text-secondary)]"
                                        >
                                            {{ number_format((float) $address->latitude, 7) }},
                                            {{ number_format((float) $address->longitude, 7) }}
                                        </span>

                                    </div>

                                </div>

                            @endif

                        </article>

                    @endforeach

                </div>

            @else

                {{-- Empty state --}}
                <div class="rounded-2xl border border-dashed border-[var(--color-border-strong)] bg-white px-5 py-14 text-center shadow-[var(--shadow-xs)]">

                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-[var(--color-neutral-50)] text-[var(--color-text-muted)]">

                        <svg
                            class="h-6 w-6"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.7"
                        >
                            <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/>
                            <circle cx="12" cy="10" r="2.5"/>
                        </svg>

                    </div>


                    <h2 class="mt-4 text-sm font-black text-[var(--color-text-primary)]">
                        هنوز آدرسی ثبت نشده است
                    </h2>


                    <p class="mx-auto mt-1.5 max-w-md text-[10px] leading-6 text-[var(--color-text-muted)]">
                        برای سفارش سریع‌تر، اولین آدرس خود را همراه با موقعیت دقیق روی نقشه ثبت کنید.
                    </p>


                    <a
                        href="{{ route('customer.addresses.create') }}"
                        class="mt-5 inline-flex items-center gap-2 rounded-xl bg-[var(--color-brand-600)] px-4 py-3 text-[10px] font-black text-white transition hover:bg-[var(--color-brand-700)]"
                    >

                        افزودن اولین آدرس

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

            @endif

        </section>

    </div>

@endsection
