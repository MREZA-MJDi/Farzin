@extends('layouts.app')

@section('title', 'ژنان | ظرافت، راحتی و انتخابی برای تو')

@section(
    'meta_description',
    'ژنان؛ فروشگاه آنلاین لباس زیر زنانه با تمرکز بر ظرافت، راحتی، کیفیت و تجربه‌ای دلنشین از خرید.'
)

@section('content')

    <div class="overflow-hidden bg-[var(--background)]">


        {{-- =========================================================
            HERO
        ========================================================== --}}

        <x-home.hero
            :hero-products="$heroProducts"
        />



        {{-- =========================================================
            INTRO / BRAND STATEMENT
        ========================================================== --}}

        <section
            class="border-b border-[var(--border)] bg-white"
        >

            <div
                class="mx-auto max-w-7xl px-4 py-12 sm:px-6 sm:py-16 lg:px-8 lg:py-20"
            >

                <div
                    class="grid gap-8 lg:grid-cols-[220px_minmax(0,1fr)] lg:gap-16"
                >

                    <div>

                        <span
                            class="text-[10px] font-black uppercase tracking-[0.24em] text-[var(--primary)]"
                        >
                            JANAN
                        </span>

                    </div>


                    <div>

                        <h2
                            class="max-w-4xl text-2xl font-black leading-[1.7] tracking-[-0.025em] text-[var(--text)] sm:text-3xl lg:text-4xl"
                        >
                            زیبایی وقتی کامل می‌شود که
                            <span class="text-[var(--primary)]">
                                احساس راحتی
                            </span>
                            هم همراهش باشد.
                        </h2>


                        <p
                            class="mt-5 max-w-3xl text-sm leading-8 text-[var(--text-secondary)]"
                        >
                            در ژنان، انتخاب لباس زیر فقط خرید یک محصول نیست؛
                            بخشی از حس خوب، اعتمادبه‌نفس و آرامش هر روز توست.
                            برای همین هر انتخاب را با دقت، ظرافت و توجه به کیفیت کنار هم آورده‌ایم.
                        </p>

                    </div>

                </div>

            </div>

        </section>



        {{-- =========================================================
            TRUST / FEATURES
        ========================================================== --}}

        <section
            class="bg-[var(--surface-soft)]"
        >

            <div
                class="mx-auto max-w-7xl px-4 py-9 sm:px-6 sm:py-11 lg:px-8"
            >

                <div
                    class="grid divide-y divide-[var(--border)] sm:grid-cols-2 sm:divide-x sm:divide-y-0 lg:grid-cols-4 lg:divide-x"
                >


                    <div class="px-4 py-4 first:pt-0 sm:py-2 lg:px-6">

                        <div
                            class="text-[11px] font-black text-[var(--primary)]"
                        >
                            01
                        </div>

                        <h3
                            class="mt-2 text-sm font-black text-[var(--text)]"
                        >
                            انتخاب با دقت
                        </h3>

                        <p
                            class="mt-1.5 text-[11px] leading-6 text-[var(--text-muted)]"
                        >
                            محصولاتی که برای زیبایی و راحتی روزمره انتخاب شده‌اند.
                        </p>

                    </div>


                    <div class="px-4 py-4 sm:py-2 lg:px-6">

                        <div
                            class="text-[11px] font-black text-[var(--primary)]"
                        >
                            02
                        </div>

                        <h3
                            class="mt-2 text-sm font-black text-[var(--text)]"
                        >
                            خرید ساده
                        </h3>

                        <p
                            class="mt-1.5 text-[11px] leading-6 text-[var(--text-muted)]"
                        >
                            از انتخاب محصول تا ثبت سفارش، همه‌چیز ساده و روشن.
                        </p>

                    </div>


                    <div class="px-4 py-4 sm:py-2 lg:px-6">

                        <div
                            class="text-[11px] font-black text-[var(--primary)]"
                        >
                            03
                        </div>

                        <h3
                            class="mt-2 text-sm font-black text-[var(--text)]"
                        >
                            ارسال مطمئن
                        </h3>

                        <p
                            class="mt-1.5 text-[11px] leading-6 text-[var(--text-muted)]"
                        >
                            سفارش تو با دقت آماده و برایت ارسال می‌شود.
                        </p>

                    </div>


                    <div class="px-4 py-4 last:pb-0 sm:py-2 lg:px-6">

                        <div
                            class="text-[11px] font-black text-[var(--accent)]"
                        >
                            04
                        </div>

                        <h3
                            class="mt-2 text-sm font-black text-[var(--text)]"
                        >
                            همراه تو
                        </h3>

                        <p
                            class="mt-1.5 text-[11px] leading-6 text-[var(--text-muted)]"
                        >
                            برای انتخاب بهتر، قبل و بعد از خرید کنار تو هستیم.
                        </p>

                    </div>

                </div>

            </div>

        </section>



        {{-- =========================================================
            CATEGORIES
        ========================================================== --}}

        <section
            class="bg-white"
        >

            <div
                class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-20"
            >

                <div
                    class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between"
                >

                    <div>

                        <div
                            class="flex items-center gap-3 text-[10px] font-black uppercase tracking-[0.22em] text-[var(--primary)]"
                        >

                            <span class="h-px w-8 bg-[var(--primary)]/45"></span>

                            Shop by mood

                        </div>


                        <h2
                            class="mt-3 text-2xl font-black tracking-tight text-[var(--text)] sm:text-3xl"
                        >
                            برای خودت انتخاب کن
                        </h2>


                        <p
                            class="mt-2.5 max-w-xl text-xs leading-7 text-[var(--text-secondary)] sm:text-sm"
                        >
                            از میان دسته‌های مختلف، چیزی را پیدا کن که بیشتر با تو و سبک تو هماهنگ است.
                        </p>

                    </div>


                    <a
                        href="{{ route('shop.index') }}"
                        class="inline-flex items-center gap-2 text-xs font-black text-[var(--primary)] transition hover:text-[var(--accent)]"
                    >

                        مشاهده همه

                        <svg
                            class="h-4 w-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            aria-hidden="true"
                        >
                            <path d="m9 18 6-6-6-6"/>
                        </svg>

                    </a>

                </div>


                <div
                    class="mt-8 grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-5"
                >

                    @forelse($categories ?? [] as $category)

                        <a
                            href="{{ route('categories.show', $category) }}"
                            class="group relative overflow-hidden rounded-[24px] bg-[var(--surface-soft)] p-2 transition duration-500 hover:-translate-y-1 hover:shadow-[0_20px_45px_rgba(72,91,105,0.09)]"
                        >

                            <div
                                class="relative aspect-[0.86] overflow-hidden rounded-[19px] bg-white"
                            >

                                @if($category->image)

                                    <img
                                        src="{{ asset('storage/' . ltrim($category->image, '/')) }}"
                                        alt="{{ $category->name }}"
                                        class="h-full w-full object-cover transition duration-700 ease-[cubic-bezier(.22,1,.36,1)] group-hover:scale-[1.045]"
                                        loading="lazy"
                                        decoding="async"
                                    >

                                    <div
                                        class="pointer-events-none absolute inset-0 bg-gradient-to-t from-slate-900/35 via-transparent to-transparent opacity-70"
                                    ></div>

                                @else

                                    <div
                                        class="flex h-full items-center justify-center bg-[linear-gradient(145deg,rgba(126,199,232,0.08),rgba(245,214,223,0.18))] text-[var(--text-light)]"
                                    >

                                        <svg
                                            class="h-10 w-10"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.2"
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
                                                r="1.3"
                                            />

                                            <path d="m21 15-5-5-4.5 4.5-2.5-2.5L3 18"/>

                                        </svg>

                                    </div>

                                @endif


                                <div
                                    class="absolute inset-x-3 bottom-3"
                                >

                                    <span
                                        class="inline-flex rounded-full bg-white/88 px-3 py-1.5 text-[9px] font-black text-[var(--text)] shadow-sm backdrop-blur-md"
                                    >
                                        {{ $category->name }}
                                    </span>

                                </div>

                            </div>


                            <div
                                class="flex items-center justify-between px-2.5 py-3"
                            >

                                <span
                                    class="text-[11px] font-bold text-[var(--text-secondary)]"
                                >
                                    مشاهده مجموعه
                                </span>


                                <span
                                    class="flex h-7 w-7 items-center justify-center rounded-full bg-white text-[var(--primary)] transition duration-300 group-hover:bg-[var(--primary)] group-hover:text-white"
                                >

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

                                </span>

                            </div>

                        </a>

                    @empty

                        <div
                            class="col-span-full rounded-[24px] border border-dashed border-[var(--border-dark)] bg-[var(--surface-soft)] px-6 py-12 text-center text-sm text-[var(--text-muted)]"
                        >
                            هنوز دسته‌بندی‌ای ثبت نشده است.
                        </div>

                    @endforelse

                </div>

            </div>

        </section>



        {{-- =========================================================
            FEATURED PRODUCTS
        ========================================================== --}}

        <section
            class="relative overflow-hidden bg-[linear-gradient(180deg,#f5fbfe_0%,#fff7f9_100%)]"
        >

            <div
                class="pointer-events-none absolute -right-24 top-16 h-72 w-72 rounded-full bg-[var(--primary)]/8 blur-3xl"
            ></div>

            <div
                class="pointer-events-none absolute -left-20 bottom-10 h-64 w-64 rounded-full bg-[var(--accent)]/10 blur-3xl"
            ></div>


            <div
                class="relative mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-20"
            >

                <div
                    class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between"
                >

                    <div>

                        <div
                            class="text-[10px] font-black uppercase tracking-[0.22em] text-[var(--accent)]"
                        >
                            JANAN EDIT
                        </div>


                        <h2
                            class="mt-3 text-2xl font-black tracking-tight text-[var(--text)] sm:text-3xl"
                        >
                            انتخاب‌های این فصل
                        </h2>


                        <p
                            class="mt-2.5 max-w-2xl text-xs leading-7 text-[var(--text-secondary)] sm:text-sm"
                        >
                            مجموعه‌ای از مدل‌هایی که ظرافت و راحتی را کنار هم نگه می‌دارند.
                        </p>

                    </div>


                    <a
                        href="{{ route('shop.index') }}"
                        class="inline-flex items-center gap-2 text-xs font-black text-[var(--primary)] transition hover:text-[var(--accent)]"
                    >

                        همه محصولات

                        <span class="text-sm">
                            ←
                        </span>

                    </a>

                </div>


                <div
                    class="mt-9 grid grid-cols-2 gap-x-3 gap-y-7 sm:gap-x-5 md:grid-cols-3 lg:grid-cols-4"
                >

                    @forelse($featuredProducts ?? [] as $product)

                        @include('partials.product_card', [
                            'product' => $product
                        ])

                    @empty

                        <div
                            class="col-span-full rounded-[24px] border border-dashed border-[var(--border-dark)] bg-white px-6 py-12 text-center text-sm text-[var(--text-muted)]"
                        >
                            هنوز محصول ویژه‌ای موجود نیست.
                        </div>

                    @endforelse

                </div>

            </div>

        </section>



        {{-- =========================================================
            EDITORIAL FEATURE
        ========================================================== --}}

        <section
            class="bg-white"
        >

            <div
                class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-20"
            >

                <div
                    class="overflow-hidden rounded-[32px] border border-[var(--border)] bg-[linear-gradient(135deg,#eef8fc_0%,#fff4f7_100%)]"
                >

                    <div
                        class="grid min-h-[460px] lg:grid-cols-[0.94fr_1.06fr]"
                    >


                        {{-- Visual --}}

                        <div
                            class="relative min-h-[300px] overflow-hidden sm:min-h-[380px]"
                        >

                            @if(isset($heroProducts) && $heroProducts->first()?->primaryImage)

                                <img
                                    src="{{ asset('storage/' . ltrim($heroProducts->first()->primaryImage->image, '/')) }}"
                                    alt="ژنان"
                                    class="absolute inset-0 h-full w-full object-cover transition duration-700 hover:scale-[1.02]"
                                    loading="lazy"
                                    decoding="async"
                                >

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-900/20 via-transparent to-transparent"
                                ></div>

                            @else

                                <div
                                    class="absolute inset-0 bg-[radial-gradient(circle_at_40%_35%,rgba(126,199,232,0.20),transparent_30%),radial-gradient(circle_at_70%_70%,rgba(245,214,223,0.32),transparent_34%),linear-gradient(135deg,#eef8fc,#fff4f7)]"
                                ></div>

                            @endif


                            <div
                                class="absolute right-5 top-5 rounded-full border border-white/80 bg-white/75 px-3 py-1.5 text-[9px] font-black uppercase tracking-[0.16em] text-[var(--primary)] shadow-sm backdrop-blur-md"
                            >
                                JANAN JOURNAL
                            </div>

                        </div>


                        {{-- Content --}}

                        <div
                            class="flex flex-col justify-center p-7 sm:p-10 lg:p-14"
                        >

                            <div
                                class="text-[10px] font-black uppercase tracking-[0.2em] text-[var(--primary)]"
                            >
                                The Janan Edit
                            </div>


                            <h2
                                class="mt-4 max-w-xl text-3xl font-black leading-[1.5] tracking-[-0.025em] text-[var(--text)] sm:text-4xl"
                            >
                                انتخابی که
                                <span class="text-[var(--accent)]">
                                    بیشتر از ظاهر
                                </span>
                                معنا دارد.
                            </h2>


                            <p
                                class="mt-5 max-w-xl text-sm leading-8 text-[var(--text-secondary)]"
                            >
                                درباره انتخاب سایز، فرم مناسب، مراقبت از لباس زیر
                                و چیزهایی بخوان که کمک می‌کنند انتخابی راحت‌تر و آگاهانه‌تر داشته باشی.
                            </p>


                            <div class="mt-7">

                                <a
                                    href="{{ route('blog.index') }}"
                                    class="inline-flex items-center gap-2.5 rounded-full bg-[var(--primary)] px-5 py-3.5 text-xs font-black text-white shadow-[0_12px_28px_rgba(126,199,232,0.18)] transition duration-300 hover:-translate-y-0.5 hover:bg-[var(--primary-hover)]"
                                >

                                    خواندن مجله

                                    <svg
                                        class="h-4 w-4"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        aria-hidden="true"
                                    >
                                        <path d="m9 18 6-6-6-6"/>
                                    </svg>

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>



        {{-- =========================================================
            LATEST PRODUCTS
        ========================================================== --}}

        <section
            class="bg-[var(--surface-soft)]"
        >

            <div
                class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-20"
            >

                <div
                    class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between"
                >

                    <div>

                        <div
                            class="flex items-center gap-3 text-[10px] font-black uppercase tracking-[0.22em] text-[var(--primary)]"
                        >

                            <span class="h-px w-8 bg-[var(--primary)]/45"></span>

                            New In

                        </div>


                        <h2
                            class="mt-3 text-2xl font-black tracking-tight text-[var(--text)] sm:text-3xl"
                        >
                            تازه‌واردهای ژنان
                        </h2>


                        <p
                            class="mt-2.5 text-xs leading-7 text-[var(--text-secondary)] sm:text-sm"
                        >
                            جدیدترین انتخاب‌هایی که به مجموعه ژنان اضافه شده‌اند.
                        </p>

                    </div>


                    <a
                        href="{{ route('shop.index', ['sort' => 'latest']) }}"
                        class="inline-flex items-center gap-2 text-xs font-black text-[var(--primary)] transition hover:text-[var(--accent)]"
                    >

                        مشاهده تازه‌ها

                        <span class="text-sm">
                            ←
                        </span>

                    </a>

                </div>


                <div
                    class="mt-9 grid grid-cols-2 gap-x-3 gap-y-7 sm:gap-x-5 md:grid-cols-3 lg:grid-cols-4"
                >

                    @forelse($latestProducts ?? [] as $product)

                        @include('partials.product_card', [
                            'product' => $product
                        ])

                    @empty

                        <div
                            class="col-span-full rounded-[24px] border border-dashed border-[var(--border-dark)] bg-white px-6 py-12 text-center text-sm text-[var(--text-muted)]"
                        >
                            هنوز محصولی ثبت نشده است.
                        </div>

                    @endforelse

                </div>

            </div>

        </section>



        {{-- =========================================================
            SOFT CTA
        ========================================================== --}}

        <section
            class="bg-white"
        >

            <div
                class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-18"
            >

                <div
                    class="relative overflow-hidden rounded-[30px] border border-[var(--border)] bg-[linear-gradient(135deg,#eef8fc_0%,#fff4f7_100%)] px-6 py-9 sm:px-9 sm:py-11 lg:px-12"
                >

                    <div
                        class="pointer-events-none absolute -right-16 -top-20 h-52 w-52 rounded-full bg-[var(--primary)]/10 blur-3xl"
                    ></div>

                    <div
                        class="pointer-events-none absolute -bottom-16 -left-16 h-52 w-52 rounded-full bg-[var(--accent)]/10 blur-3xl"
                    ></div>


                    <div
                        class="relative flex flex-col gap-7 lg:flex-row lg:items-center lg:justify-between"
                    >

                        <div class="max-w-2xl">

                            <div
                                class="text-[10px] font-black uppercase tracking-[0.2em] text-[var(--primary)]"
                            >
                                JANAN
                            </div>


                            <h2
                                class="mt-3 text-2xl font-black tracking-tight text-[var(--text)] sm:text-3xl"
                            >
                                چیزی برای خودت پیدا کن.
                            </h2>


                            <p
                                class="mt-3 text-sm leading-7 text-[var(--text-secondary)]"
                            >
                                مجموعه ژنان را ببین و انتخابی داشته باش که با تو،
                                سبک تو و حال خوبت هماهنگ باشد.
                            </p>

                        </div>


                        <a
                            href="{{ route('shop.index') }}"
                            class="inline-flex shrink-0 items-center justify-center gap-2 rounded-full bg-[var(--primary)] px-6 py-3.5 text-xs font-black text-white shadow-[0_12px_28px_rgba(126,199,232,0.18)] transition duration-300 hover:-translate-y-0.5 hover:bg-[var(--primary-hover)]"
                        >

                            ورود به فروشگاه

                            <svg
                                class="h-4 w-4"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                aria-hidden="true"
                            >
                                <path d="m9 18 6-6-6-6"/>
                            </svg>

                        </a>

                    </div>

                </div>

            </div>

        </section>

    </div>

@endsection
