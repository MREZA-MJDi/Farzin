@extends('layouts.app')

@section('title', 'فروشگاه | ژنان')

@section('content')

    <div class="min-h-screen bg-[var(--background)]">

        {{-- =========================================================
            PAGE HEADER
        ========================================================== --}}

        <section
            class="border-b border-[var(--border)] bg-white"
        >

            <div
                class="mx-auto max-w-7xl px-4 pb-8 pt-8 sm:px-6 lg:px-8 lg:pb-10 lg:pt-12"
            >

                <div
                    class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between"
                >

                    <div>

                        <div
                            class="flex items-center gap-3 text-[10px] font-black uppercase tracking-[0.2em] text-[var(--primary)]"
                        >

                            <span class="h-px w-8 bg-[var(--primary)]/45"></span>

                            Janan Collection

                        </div>


                        <h1
                            class="mt-3 text-4xl font-black tracking-[-0.025em] text-[var(--text)] sm:text-5xl"
                        >
                            فروشگاه
                        </h1>


                        <p
                            class="mt-3 max-w-2xl text-sm leading-8 text-[var(--text-secondary)]"
                        >
                            مجموعه‌ای از لباس‌های زیر زنانه با تمرکز بر ظرافت،
                            راحتی و انتخابی که با سلیقه شما هماهنگ باشد.
                        </p>

                    </div>


                    <div
                        class="inline-flex w-fit items-center gap-2 rounded-full bg-[var(--surface-soft)] px-4 py-2.5 text-[10px] font-black text-[var(--text-secondary)]"
                    >

                        <span
                            class="h-1.5 w-1.5 rounded-full bg-[var(--primary)]"
                        ></span>

                        {{ number_format($products->total()) }}
                        محصول

                    </div>

                </div>

            </div>

        </section>



        {{-- =========================================================
            SEARCH
        ========================================================== --}}

        <section
            class="mx-auto max-w-7xl px-4 pt-6 sm:px-6 lg:px-8"
        >

            <form
                action="{{ route('shop.index') }}"
                method="GET"
                class="relative"
            >

                <label
                    for="shop-search"
                    class="sr-only"
                >
                    جستجوی محصولات
                </label>


                <div
                    class="relative overflow-hidden rounded-[24px] border border-[var(--border)] bg-white shadow-[0_8px_30px_rgba(72,91,105,0.04)] transition duration-300 focus-within:border-[var(--primary)]/30 focus-within:shadow-[0_14px_34px_rgba(126,199,232,0.08)]"
                >

                    <div
                        class="pointer-events-none absolute right-4 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-xl bg-[var(--surface-soft)] text-[var(--primary)]"
                    >

                        <svg
                            class="h-4.5 w-4.5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.7"
                            aria-hidden="true"
                        >
                            <circle
                                cx="11"
                                cy="11"
                                r="7"
                            />

                            <path d="m20 20-3.5-3.5"/>

                        </svg>

                    </div>


                    <input
                        id="shop-search"
                        type="search"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="جستجوی محصول، برند یا کد کالا..."
                        autocomplete="off"
                        class="w-full bg-transparent py-4 pr-16 pl-32 text-sm text-[var(--text)] outline-none placeholder:text-[var(--text-light)]"
                    >


                    <button
                        type="submit"
                        class="absolute left-2 top-2 bottom-2 inline-flex min-w-[100px] items-center justify-center rounded-2xl bg-[var(--primary)] px-5 text-xs font-black text-white transition duration-300 hover:bg-[var(--primary-hover)]"
                    >
                        جستجو
                    </button>

                </div>

            </form>

        </section>



        {{-- =========================================================
            MAIN SHOP
        ========================================================== --}}

        <section
            class="mx-auto max-w-7xl px-4 pb-16 pt-7 sm:px-6 lg:px-8 lg:pb-24"
        >

            <div
                class="grid items-start gap-7 lg:grid-cols-[230px_minmax(0,1fr)] xl:grid-cols-[250px_minmax(0,1fr)]"
            >


                {{-- =================================================
                    FILTERS
                ================================================== --}}

                <aside
                    class="lg:sticky lg:top-24 lg:self-start"
                >

                    <form
                        action="{{ route('shop.index') }}"
                        method="GET"
                        class="rounded-[24px] border border-[var(--border)] bg-white p-5 shadow-[0_8px_30px_rgba(72,91,105,0.04)]"
                    >

                        @if(request('search'))

                            <input
                                type="hidden"
                                name="search"
                                value="{{ request('search') }}"
                            >

                        @endif


                        {{-- Filter Header --}}

                        <div
                            class="flex items-center justify-between gap-3"
                        >

                            <div>

                                <div
                                    class="text-[9px] font-black uppercase tracking-[0.18em] text-[var(--primary)]"
                                >
                                    Filter
                                </div>

                                <h2
                                    class="mt-1.5 text-sm font-black text-[var(--text)]"
                                >
                                    انتخاب محصولات
                                </h2>

                            </div>


                            <a
                                href="{{ route('shop.index') }}"
                                class="text-[10px] font-bold text-[var(--text-muted)] transition hover:text-[var(--accent)]"
                            >
                                پاک کردن
                            </a>

                        </div>


                        {{-- Category --}}

                        <div class="mt-6">

                            <label
                                for="shop-category"
                                class="text-[10px] font-black text-[var(--text-secondary)]"
                            >
                                دسته‌بندی
                            </label>


                            <div class="relative mt-2.5">

                                <select
                                    id="shop-category"
                                    name="category"
                                    class="w-full appearance-none rounded-xl border border-[var(--border)] bg-[var(--surface-soft)] px-3.5 py-3 text-xs font-semibold text-[var(--text)] outline-none transition focus:border-[var(--primary)] focus:bg-white focus:ring-4 focus:ring-[var(--primary)]/10"
                                >

                                    <option value="">
                                        همه دسته‌ها
                                    </option>

                                    @foreach($categories as $category)

                                        <option
                                            value="{{ $category->slug }}"
                                            @selected(request('category') === $category->slug)
                                        >
                                        {{ $category->name }}
                                        </option>

                                    @endforeach

                                </select>


                                <svg
                                    class="pointer-events-none absolute left-3 top-1/2 h-3.5 w-3.5 -translate-y-1/2 text-[var(--text-muted)]"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    aria-hidden="true"
                                >
                                    <path d="m6 9 6 6 6-6"/>
                                </svg>

                            </div>

                        </div>


                        {{-- Sort --}}

                        <div class="mt-5">

                            <label
                                for="shop-sort"
                                class="text-[10px] font-black text-[var(--text-secondary)]"
                            >
                                مرتب‌سازی
                            </label>


                            <div class="relative mt-2.5">

                                <select
                                    id="shop-sort"
                                    name="sort"
                                    class="w-full appearance-none rounded-xl border border-[var(--border)] bg-[var(--surface-soft)] px-3.5 py-3 text-xs font-semibold text-[var(--text)] outline-none transition focus:border-[var(--primary)] focus:bg-white focus:ring-4 focus:ring-[var(--primary)]/10"
                                >

                                    <option
                                        value="latest"
                                        @selected(request('sort', 'latest') === 'latest')
                                    >
                                    جدیدترین
                                    </option>

                                    <option
                                        value="price_asc"
                                        @selected(request('sort') === 'price_asc')
                                    >
                                    ارزان‌ترین
                                    </option>

                                    <option
                                        value="price_desc"
                                        @selected(request('sort') === 'price_desc')
                                    >
                                    گران‌ترین
                                    </option>

                                    <option
                                        value="popular"
                                        @selected(request('sort') === 'popular')
                                    >
                                    محبوب‌ترین
                                    </option>

                                    <option
                                        value="rating"
                                        @selected(request('sort') === 'rating')
                                    >
                                    بالاترین امتیاز
                                    </option>

                                </select>


                                <svg
                                    class="pointer-events-none absolute left-3 top-1/2 h-3.5 w-3.5 -translate-y-1/2 text-[var(--text-muted)]"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    aria-hidden="true"
                                >
                                    <path d="m6 9 6 6 6-6"/>
                                </svg>

                            </div>

                        </div>


                        {{-- Price --}}

                        <div class="mt-5">

                            <div
                                class="text-[10px] font-black text-[var(--text-secondary)]"
                            >
                                محدوده قیمت
                            </div>


                            <div class="mt-2.5 grid grid-cols-2 gap-2">

                                <div>

                                    <label
                                        for="min-price"
                                        class="sr-only"
                                    >
                                        حداقل قیمت
                                    </label>

                                    <input
                                        id="min-price"
                                        type="number"
                                        name="min_price"
                                        min="0"
                                        value="{{ request('min_price') }}"
                                        placeholder="{{ number_format($priceMin) }}"
                                        class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-soft)] px-3 py-3 text-[11px] font-semibold text-[var(--text)] outline-none transition placeholder:text-[var(--text-light)] focus:border-[var(--primary)] focus:bg-white focus:ring-4 focus:ring-[var(--primary)]/10"
                                    >

                                </div>


                                <div>

                                    <label
                                        for="max-price"
                                        class="sr-only"
                                    >
                                        حداکثر قیمت
                                    </label>

                                    <input
                                        id="max-price"
                                        type="number"
                                        name="max_price"
                                        min="0"
                                        value="{{ request('max_price') }}"
                                        placeholder="{{ number_format($priceMax) }}"
                                        class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-soft)] px-3 py-3 text-[11px] font-semibold text-[var(--text)] outline-none transition placeholder:text-[var(--text-light)] focus:border-[var(--primary)] focus:bg-white focus:ring-4 focus:ring-[var(--primary)]/10"
                                    >

                                </div>

                            </div>

                        </div>


                        {{-- Apply --}}

                        <button
                            type="submit"
                            class="mt-6 flex w-full items-center justify-center gap-2 rounded-xl bg-[var(--primary)] px-4 py-3.5 text-xs font-black text-white shadow-[0_10px_24px_rgba(126,199,232,0.16)] transition duration-300 hover:-translate-y-0.5 hover:bg-[var(--primary-hover)]"
                        >

                            اعمال فیلتر

                            <svg
                                class="h-3.5 w-3.5"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                aria-hidden="true"
                            >
                                <path d="M6 9h12"/>
                                <path d="M9 5h6"/>
                                <path d="M9 13h6"/>
                                <path d="M6 17h12"/>
                            </svg>

                        </button>

                    </form>

                </aside>



                {{-- =================================================
                    PRODUCTS
                ================================================== --}}

                <div class="min-w-0">


                    {{-- Toolbar --}}

                    <div
                        class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between"
                    >

                        <div>

                            <div
                                class="text-[10px] font-bold text-[var(--text-muted)]"
                            >
                                نمایش محصولات
                            </div>

                            @if(request('search'))

                                <div
                                    class="mt-1 text-xs font-black text-[var(--text)]"
                                >
                                    نتایج جستجو برای «{{ request('search') }}»
                                </div>

                            @else

                                <div
                                    class="mt-1 text-xs font-black text-[var(--text)]"
                                >
                                    جدیدترین انتخاب‌های ژنان
                                </div>

                            @endif

                        </div>


                        <div
                            class="hidden items-center gap-2 text-[10px] text-[var(--text-muted)] sm:flex"
                        >

                            <span>
                                مرتب‌سازی:
                            </span>

                            <span
                                class="font-black text-[var(--text-secondary)]"
                            >
                                @switch(request('sort', 'latest'))

                                    @case('price_asc')
                                    ارزان‌ترین
                                    @break

                                    @case('price_desc')
                                    گران‌ترین
                                    @break

                                    @case('popular')
                                    محبوب‌ترین
                                    @break

                                    @case('rating')
                                    بالاترین امتیاز
                                    @break

                                    @default
                                    جدیدترین

                                @endswitch
                            </span>

                        </div>

                    </div>


                    @if($products->count())

                        {{-- Product Grid --}}

                        <div
                            class="grid grid-cols-2 gap-x-3.5 gap-y-7 sm:gap-x-5 sm:gap-y-9 md:grid-cols-3 xl:grid-cols-4"
                        >

                            @foreach($products as $product)

                                @include('partials.product_card', [
                                    'product' => $product
                                ])

                            @endforeach

                        </div>


                        {{-- Pagination --}}

                        <div
                            class="mt-12 flex justify-center"
                        >
                            {{ $products->onEachSide(1)->links() }}
                        </div>

                    @else

                        {{-- Empty State --}}

                        <div
                            class="relative overflow-hidden rounded-[28px] border border-dashed border-[var(--border-dark)] bg-white px-6 py-24 text-center"
                        >

                            <div
                                class="pointer-events-none absolute -right-20 -top-20 h-48 w-48 rounded-full bg-[var(--primary)]/8 blur-3xl"
                            ></div>

                            <div
                                class="pointer-events-none absolute -bottom-20 -left-20 h-48 w-48 rounded-full bg-[var(--accent)]/10 blur-3xl"
                            ></div>


                            <div
                                class="relative mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[var(--surface-soft)] text-[var(--primary)]"
                            >

                                <svg
                                    class="h-7 w-7"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    aria-hidden="true"
                                >
                                    <circle
                                        cx="11"
                                        cy="11"
                                        r="7"
                                    />

                                    <path d="m16 16 5 5"/>

                                    <path d="M8.5 11h5"/>

                                </svg>

                            </div>


                            <h2
                                class="relative mt-5 text-xl font-black text-[var(--text)]"
                            >
                                محصولی پیدا نشد
                            </h2>


                            <p
                                class="relative mx-auto mt-2 max-w-md text-sm leading-7 text-[var(--text-muted)]"
                            >
                                عبارت جستجو یا فیلترها را کمی تغییر بده و دوباره امتحان کن.
                            </p>


                            <a
                                href="{{ route('shop.index') }}"
                                class="relative mt-6 inline-flex items-center justify-center rounded-xl bg-[var(--primary)] px-5 py-3 text-xs font-black text-white transition hover:bg-[var(--primary-hover)]"
                            >
                                بازنشانی فیلترها
                            </a>

                        </div>

                    @endif

                </div>

            </div>

        </section>

    </div>

@endsection
