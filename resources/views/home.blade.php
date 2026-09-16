@extends('layouts.app')

@section('title', 'فرزین | خرید مطمئن، انتخاب حرفه‌ای')

@section(
    'meta_description',
    'فرزین؛ فروشگاه آنلاین برای انتخاب محصولات باکیفیت، خرید مطمئن و تجربه‌ای حرفه‌ای و ساده.'
)

@section('content')

    {{-- =========================================================
        HERO
    ========================================================== --}}

    <x-home.hero
        :hero-products="$heroProducts"
    />


    {{-- =========================================================
        TRUST STRIP
    ========================================================== --}}

    <section class="border-b border-[var(--color-border)] bg-white">

        <div class="mx-auto grid max-w-7xl grid-cols-2 gap-px bg-[var(--color-neutral-100)] sm:px-6 lg:grid-cols-4 lg:px-8">

            <div class="bg-white px-4 py-6 sm:px-5">

                <div class="text-lg font-black text-[var(--color-accent-600)]">
                    01
                </div>

                <div class="mt-1.5 text-sm font-black text-[var(--color-text-primary)]">
                    انتخاب دقیق
                </div>

                <div class="mt-1 text-[11px] leading-5 text-[var(--color-text-muted)]">
                    تمرکز روی محصولاتی که ارزش خرید دارند.
                </div>

            </div>


            <div class="bg-white px-4 py-6 sm:px-5">

                <div class="text-lg font-black text-[var(--color-accent-600)]">
                    02
                </div>

                <div class="mt-1.5 text-sm font-black text-[var(--color-text-primary)]">
                    تجربه سریع
                </div>

                <div class="mt-1 text-[11px] leading-5 text-[var(--color-text-muted)]">
                    مسیر کوتاه از کشف محصول تا پرداخت.
                </div>

            </div>


            <div class="bg-white px-4 py-6 sm:px-5">

                <div class="text-lg font-black text-[var(--color-accent-600)]">
                    03
                </div>

                <div class="mt-1.5 text-sm font-black text-[var(--color-text-primary)]">
                    پرداخت امن
                </div>

                <div class="mt-1 text-[11px] leading-5 text-[var(--color-text-muted)]">
                    فرآیند ساده و شفاف برای خرید.
                </div>

            </div>


            <div class="bg-white px-4 py-6 sm:px-5">

                <div class="text-lg font-black text-[var(--color-accent-600)]">
                    04
                </div>

                <div class="mt-1.5 text-sm font-black text-[var(--color-text-primary)]">
                    پشتیبانی انسانی
                </div>

                <div class="mt-1 text-[11px] leading-5 text-[var(--color-text-muted)]">
                    وقتی نیاز داری، یک نفر پاسخ می‌دهد.
                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
        CATEGORIES
    ========================================================== --}}

    <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-16">

        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

            <div>

                <div class="text-[10px] font-black uppercase tracking-[0.24em] text-[var(--color-accent-600)]">
                    Explore
                </div>

                <h2 class="mt-2.5 text-2xl font-black tracking-tight text-[var(--color-text-primary)] sm:text-3xl">
                    دسته‌بندی‌ها
                </h2>

                <p class="mt-2 max-w-xl text-xs leading-7 text-[var(--color-text-secondary)] sm:text-sm">
                    مسیرت را سریع‌تر پیدا کن و مستقیماً وارد دسته مورد نظرت شو.
                </p>

            </div>


            <a
                href="{{ route('shop.index') }}"
                class="inline-flex items-center gap-2 text-xs font-black text-[var(--color-brand-900)] transition hover:text-[var(--color-accent-600)]"
            >
                مشاهده همه

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


        <div class="mt-7 grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-5">

            @forelse($categories ?? [] as $category)

                <a
                    href="{{ route('categories.show', $category) }}"
                    class="group overflow-hidden rounded-2xl border border-[var(--color-border)] bg-white p-2.5 shadow-[var(--shadow-xs)] transition duration-300 hover:-translate-y-1 hover:border-[var(--color-brand-300)] hover:shadow-[var(--shadow-md)]"
                >

                    <div class="relative aspect-[1.05] overflow-hidden rounded-xl bg-[var(--color-neutral-100)]">

                        @if($category->image)

                            <img
                                src="{{ asset('storage/' . $category->image) }}"
                                alt="{{ $category->name }}"
                                class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                                loading="lazy"
                                decoding="async"
                            >

                        @else

                            <div class="flex h-full items-center justify-center text-[var(--color-neutral-400)]">

                                <svg
                                    class="h-10 w-10"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.2"
                                >
                                    <rect x="3" y="4" width="18" height="16" rx="2"/>
                                    <circle cx="8.5" cy="9" r="1.3"/>
                                    <path d="m21 15-5-5-4.5 4.5-2.5-2.5L3 18"/>
                                </svg>

                            </div>

                        @endif

                    </div>


                    <div class="px-1.5 pb-1 pt-3">

                        <div class="flex items-center justify-between gap-2">

                            <span class="truncate text-xs font-black text-[var(--color-text-primary)] sm:text-sm">
                                {{ $category->name }}
                            </span>

                            <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg bg-[var(--color-brand-50)] text-[var(--color-brand-900)] transition group-hover:bg-[var(--color-accent-50)] group-hover:text-[var(--color-accent-600)]">

                                <svg
                                    class="h-3 w-3"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path d="m9 18 6-6-6-6"/>
                                </svg>

                            </span>

                        </div>

                    </div>

                </a>

            @empty

                <div class="col-span-full rounded-2xl border border-dashed border-[var(--color-border-strong)] bg-white px-6 py-10 text-center text-sm text-[var(--color-text-muted)]">
                    هنوز دسته‌بندی‌ای ثبت نشده است.
                </div>

            @endforelse

        </div>

    </section>


    {{-- =========================================================
        FEATURED PRODUCTS
    ========================================================== --}}

    <section class="bg-[var(--color-neutral-50)] py-14 sm:py-16">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

                <div>

                    <div class="text-[10px] font-black uppercase tracking-[0.24em] text-[var(--color-accent-600)]">
                        Farzin Selection
                    </div>

                    <h2 class="mt-2.5 text-2xl font-black tracking-tight text-[var(--color-text-primary)] sm:text-3xl">
                        انتخاب‌های ویژه
                    </h2>

                    <p class="mt-2 max-w-2xl text-xs leading-7 text-[var(--color-text-secondary)] sm:text-sm">
                        محصولاتی که برای کیفیت، کاربرد و ارزش خرید بیشتر انتخاب شده‌اند.
                    </p>

                </div>


                <a
                    href="{{ route('shop.index') }}"
                    class="inline-flex items-center gap-2 text-xs font-black text-[var(--color-brand-900)] transition hover:text-[var(--color-accent-600)]"
                >
                    دیدن فروشگاه

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


            <div class="mt-7 grid grid-cols-2 gap-x-3 gap-y-6 md:grid-cols-3 lg:grid-cols-4 lg:gap-x-4 lg:gap-y-8">

                @forelse($featuredProducts ?? [] as $product)

                    @include('partials.product_card', [
                        'product' => $product
                    ])

                @empty

                    <div class="col-span-full rounded-2xl border border-dashed border-[var(--color-border-strong)] bg-white px-6 py-12 text-center text-sm text-[var(--color-text-muted)]">
                        هنوز محصول ویژه‌ای موجود نیست.
                    </div>

                @endforelse

            </div>

        </div>

    </section>


    {{-- =========================================================
        EDITORIAL
    ========================================================== --}}

    <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-16">

        <div class="overflow-hidden rounded-[2rem] bg-[var(--color-brand-900)] text-white">

            <div class="grid items-center lg:grid-cols-[1fr_300px]">

                <div class="p-7 sm:p-10 lg:p-12">

                    <div class="text-[10px] font-black uppercase tracking-[0.24em] text-white/35">
                        Farzin Journal
                    </div>

                    <h2 class="mt-3 max-w-2xl text-2xl font-black leading-tight sm:text-4xl">
                        قبل از خرید،
                        <span class="text-[var(--color-accent-400)]">
                            بهتر انتخاب کن.
                        </span>
                    </h2>

                    <p class="mt-4 max-w-xl text-xs leading-7 text-white/55 sm:text-sm">
                        راهنماهای خرید، مقایسه‌ها و محتوای تخصصی که کمک می‌کنند
                        انتخاب دقیق‌تر و مطمئن‌تری داشته باشی.
                    </p>

                    <a
                        href="{{ route('blog.index') }}"
                        class="mt-6 inline-flex items-center gap-2 rounded-xl bg-[var(--color-accent-600)] px-5 py-3.5 text-xs font-black text-white transition hover:-translate-y-0.5 hover:bg-[var(--color-accent-700)]"
                    >
                        ورود به مجله

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


                <div class="hidden p-7 lg:block">

                    <div class="rounded-[1.6rem] border border-white/10 bg-white/[0.04] p-4">

                        <div class="rounded-[1.25rem] border border-white/10 bg-white/[0.025] p-4">

                            <div class="flex items-center justify-between">

                                <span class="text-[9px] font-bold text-white/30">
                                    FARZIN JOURNAL
                                </span>

                                <span class="h-2 w-2 rounded-full bg-[var(--color-accent-600)]"></span>

                            </div>

                            <div class="mt-4 space-y-2.5">
                                <div class="h-16 rounded-xl bg-white/[0.05]"></div>
                                <div class="h-12 rounded-xl bg-white/[0.035]"></div>
                                <div class="h-16 rounded-xl bg-white/[0.05]"></div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
        LATEST PRODUCTS
    ========================================================== --}}

    <section class="pb-14 sm:pb-16">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

                <div>

                    <div class="text-[10px] font-black uppercase tracking-[0.24em] text-[var(--color-accent-600)]">
                        New In
                    </div>

                    <h2 class="mt-2.5 text-2xl font-black tracking-tight text-[var(--color-text-primary)] sm:text-3xl">
                        تازه‌های فرزین
                    </h2>

                    <p class="mt-2 text-xs leading-7 text-[var(--color-text-secondary)] sm:text-sm">
                        جدیدترین محصولاتی که به فروشگاه اضافه شده‌اند.
                    </p>

                </div>


                <a
                    href="{{ route('shop.index', ['sort' => 'latest']) }}"
                    class="inline-flex items-center gap-2 text-xs font-black text-[var(--color-brand-900)] transition hover:text-[var(--color-accent-600)]"
                >
                    تازه‌ترین محصولات

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


            <div class="mt-7 grid grid-cols-2 gap-x-3 gap-y-6 md:grid-cols-3 lg:grid-cols-4 lg:gap-x-4 lg:gap-y-8">

                @forelse($latestProducts ?? [] as $product)

                    @include('partials.product_card', [
                        'product' => $product
                    ])

                @empty

                    <div class="col-span-full rounded-2xl border border-dashed border-[var(--color-border-strong)] bg-white px-6 py-12 text-center text-sm text-[var(--color-text-muted)]">
                        هنوز محصولی ثبت نشده است.
                    </div>

                @endforelse

            </div>

        </div>

    </section>


    {{-- =========================================================
        FINAL CTA
    ========================================================== --}}

    <section class="border-t border-[var(--color-border)] bg-white">

        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 sm:py-14 lg:px-8">

            <div class="relative overflow-hidden rounded-[1.75rem] bg-[var(--color-neutral-100)] p-6 sm:p-9 lg:p-10">

                <div
                    class="pointer-events-none absolute -right-16 -top-16 h-48 w-48 rounded-full bg-[var(--color-accent-600)]/10 blur-3xl"
                ></div>

                <div class="relative flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                    <div class="max-w-2xl">

                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-[var(--color-accent-600)]">
                            FARZIN
                        </span>

                        <h2 class="mt-2.5 text-2xl font-black text-[var(--color-text-primary)] sm:text-3xl">
                            آماده‌ای انتخاب بهتری داشته باشی؟
                        </h2>

                        <p class="mt-3 text-xs leading-7 text-[var(--color-text-secondary)] sm:text-sm">
                            محصولات را ببین، مقایسه کن و خریدت را با اطمینان انجام بده.
                        </p>

                    </div>


                    <a
                        href="{{ route('shop.index') }}"
                        class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl bg-[var(--color-accent-600)] px-6 py-3.5 text-xs font-black text-white shadow-lg shadow-black/10 transition hover:-translate-y-0.5 hover:bg-[var(--color-accent-700)]"
                    >
                        مشاهده فروشگاه

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

            </div>

        </div>

    </section>

@endsection
