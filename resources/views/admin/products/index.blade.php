@extends('layouts.admin')

@section('title', 'محصولات')

@section('content')

    <div class="space-y-6">

        {{-- =========================================================
            HEADER
        ========================================================== --}}

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div class="min-w-0">

                <div class="flex items-center gap-2 text-xs font-bold text-[var(--color-text-muted)]">
                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="transition hover:text-[var(--color-brand-700)]"
                    >
                        داشبورد
                    </a>

                    <span>/</span>

                    <span class="text-[var(--color-text-secondary)]">
                        محصولات
                    </span>
                </div>

                <h1 class="mt-2 text-xl font-black tracking-tight text-[var(--color-text-primary)] sm:text-2xl">
                    محصولات
                </h1>

                <p class="mt-1.5 text-xs leading-6 text-[var(--color-text-secondary)] sm:text-sm">
                    مدیریت، ویرایش، موجودی و تصاویر محصولات فروشگاه
                </p>

            </div>


            <a
                href="{{ route('admin.products.create') }}"
                class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl bg-[var(--color-brand-600)] px-4 py-2.5 text-xs font-black text-white shadow-sm transition hover:bg-[var(--color-brand-700)] focus:outline-none focus:ring-4 focus:ring-[var(--color-brand-100)]"
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

                افزودن محصول

            </a>

        </div>


        {{-- =========================================================
            FLASH MESSAGE
        ========================================================== --}}

        @if(session('success'))

            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3">

                <div class="flex items-center gap-2.5">

                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-700">

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
            FILTERS
        ========================================================== --}}

        <section class="rounded-2xl border border-[var(--color-border)] bg-white p-4 shadow-sm sm:p-5">

            <form
                method="GET"
                action="{{ route('admin.products.index') }}"
                class="grid grid-cols-1 gap-4 lg:grid-cols-12"
            >

                {{-- Search --}}
                <div class="lg:col-span-5">

                    <label
                        for="search"
                        class="mb-2 block text-xs font-black text-[var(--color-text-primary)]"
                    >
                        جستجو
                    </label>

                    <div class="relative">

                        <svg
                            class="pointer-events-none absolute right-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-[var(--color-text-muted)]"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <circle
                                cx="11"
                                cy="11"
                                r="7"
                            />
                            <path d="m20 20-4-4"/>
                        </svg>

                        <input
                            type="text"
                            id="search"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="نام محصول، SKU یا برند..."
                            class="w-full rounded-xl border border-[var(--color-border)] bg-white py-3 pl-4 pr-10 text-xs text-[var(--color-text-primary)] outline-none transition placeholder:text-[var(--color-text-muted)] focus:border-[var(--color-brand-600)] focus:ring-4 focus:ring-[var(--color-brand-100)]"
                        >

                    </div>

                </div>


                {{-- Category --}}
                <div class="lg:col-span-3">

                    <label
                        for="category_id"
                        class="mb-2 block text-xs font-black text-[var(--color-text-primary)]"
                    >
                        دسته‌بندی
                    </label>

                    <select
                        id="category_id"
                        name="category_id"
                        class="w-full rounded-xl border border-[var(--color-border)] bg-white px-3.5 py-3 text-xs text-[var(--color-text-primary)] outline-none transition focus:border-[var(--color-brand-600)] focus:ring-4 focus:ring-[var(--color-brand-100)]"
                    >

                        <option value="">
                            همه دسته‌بندی‌ها
                        </option>

                        @foreach($categories as $category)

                            <option
                                value="{{ $category->id }}"
                                @selected(
                                (string) request('category_id')
                            ===
                            (string) $category->id
                            )
                            >
                            {{ $category->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Status --}}
                <div class="lg:col-span-2">

                    <label
                        for="status"
                        class="mb-2 block text-xs font-black text-[var(--color-text-primary)]"
                    >
                        وضعیت
                    </label>

                    <select
                        id="status"
                        name="status"
                        class="w-full rounded-xl border border-[var(--color-border)] bg-white px-3.5 py-3 text-xs text-[var(--color-text-primary)] outline-none transition focus:border-[var(--color-brand-600)] focus:ring-4 focus:ring-[var(--color-brand-100)]"
                    >

                        <option value="">
                            همه
                        </option>

                        <option
                            value="active"
                            @selected(request('status') === 'active')
                        >
                        فعال
                        </option>

                        <option
                            value="inactive"
                            @selected(request('status') === 'inactive')
                        >
                        غیرفعال
                        </option>

                        <option
                            value="featured"
                            @selected(request('status') === 'featured')
                        >
                        ویژه
                        </option>

                        <option
                            value="out_of_stock"
                            @selected(request('status') === 'out_of_stock')
                        >
                        ناموجود
                        </option>

                        <option
                            value="low_stock"
                            @selected(request('status') === 'low_stock')
                        >
                        موجودی کم
                        </option>

                    </select>

                </div>


                {{-- Actions --}}
                <div class="flex items-end gap-2 lg:col-span-2">

                    <button
                        type="submit"
                        class="inline-flex h-[43px] flex-1 items-center justify-center gap-2 rounded-xl bg-[var(--color-brand-600)] px-4 text-xs font-black text-white transition hover:bg-[var(--color-brand-700)] focus:outline-none focus:ring-4 focus:ring-[var(--color-brand-100)]"
                    >

                        <svg
                            class="h-4 w-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path d="m21 21-4.3-4.3"/>
                            <circle
                                cx="11"
                                cy="11"
                                r="6.5"
                            />
                        </svg>

                        فیلتر

                    </button>


                    @if(request()->hasAny(['search', 'category_id', 'status']))

                        <a
                            href="{{ route('admin.products.index') }}"
                            class="inline-flex h-[43px] w-[43px] shrink-0 items-center justify-center rounded-xl border border-[var(--color-border)] bg-white text-[var(--color-text-secondary)] transition hover:bg-[var(--color-neutral-50)] hover:text-[var(--color-text-primary)]"
                            title="حذف فیلترها"
                        >

                            <svg
                                class="h-4 w-4"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path d="M6 6l12 12"/>
                                <path d="M18 6 6 18"/>
                            </svg>

                        </a>

                    @endif

                </div>

            </form>

        </section>


        {{-- =========================================================
            RESULT SUMMARY
        ========================================================== --}}

        <div class="flex flex-col gap-2 text-xs text-[var(--color-text-muted)] sm:flex-row sm:items-center sm:justify-between">

            <div>

                <span class="font-bold text-[var(--color-text-secondary)]">
                    {{ number_format($products->total()) }}
                </span>

                محصول

                @if($products->total() > 0)

                    <span class="mx-1">
                        —
                    </span>

                    صفحه

                    <span class="font-bold text-[var(--color-text-secondary)]">
                        {{ number_format($products->currentPage()) }}
                    </span>

                    از

                    <span class="font-bold text-[var(--color-text-secondary)]">
                        {{ number_format($products->lastPage()) }}
                    </span>

                @endif

            </div>


            @if(request()->hasAny(['search', 'category_id', 'status']))

                <div class="rounded-full bg-[var(--color-brand-50)] px-3 py-1.5 font-bold text-[var(--color-brand-700)]">
                    فیلتر فعال است
                </div>

            @endif

        </div>


        {{-- =========================================================
            PRODUCTS
        ========================================================== --}}

        <section class="overflow-hidden rounded-2xl border border-[var(--color-border)] bg-white shadow-sm">

            {{-- Desktop --}}
            <div class="hidden overflow-x-auto lg:block">

                <table class="min-w-full text-right">

                    <thead class="border-b border-[var(--color-border)] bg-[var(--color-neutral-50)]">

                    <tr>

                        <th class="px-5 py-3.5 text-[10px] font-black text-[var(--color-text-muted)]">
                            محصول
                        </th>

                        <th class="px-5 py-3.5 text-[10px] font-black text-[var(--color-text-muted)]">
                            دسته‌بندی
                        </th>

                        <th class="px-5 py-3.5 text-[10px] font-black text-[var(--color-text-muted)]">
                            قیمت
                        </th>

                        <th class="px-5 py-3.5 text-[10px] font-black text-[var(--color-text-muted)]">
                            موجودی
                        </th>

                        <th class="px-5 py-3.5 text-[10px] font-black text-[var(--color-text-muted)]">
                            وضعیت
                        </th>

                        <th class="px-5 py-3.5 text-left text-[10px] font-black text-[var(--color-text-muted)]">
                            عملیات
                        </th>

                    </tr>

                    </thead>


                    <tbody class="divide-y divide-[var(--color-border)]">

                    @forelse($products as $product)

                        <tr class="group transition hover:bg-[var(--color-neutral-50)]">

                            {{-- Product --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="relative h-14 w-14 shrink-0 overflow-hidden rounded-xl border border-[var(--color-border)] bg-[var(--color-neutral-50)]">

                                        @if($product->primaryImage)

                                            <img
                                                src="{{ asset('storage/' . ltrim($product->primaryImage->image, '/')) }}"
                                                alt="{{ $product->primaryImage->alt ?: $product->name }}"
                                                loading="lazy"
                                                class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                                            >

                                        @else

                                            <div class="flex h-full w-full items-center justify-center text-[var(--color-text-muted)]">

                                                <svg
                                                    class="h-6 w-6"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="1.5"
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

                                        @endif


                                        @if(($product->images_count ?? 0) > 1)

                                            <span class="absolute bottom-1 right-1 rounded-md bg-black/75 px-1.5 py-0.5 text-[8px] font-black text-white">
                                                    {{ number_format($product->images_count) }}
                                                </span>

                                        @endif

                                    </div>


                                    <div class="min-w-0">

                                        <a
                                            href="{{ route('admin.products.edit', $product) }}"
                                            class="block max-w-[280px] truncate text-xs font-black text-[var(--color-text-primary)] transition hover:text-[var(--color-brand-700)]"
                                        >
                                            {{ $product->name }}
                                        </a>


                                        <div class="mt-1 flex flex-wrap items-center gap-x-2 gap-y-1 text-[10px] text-[var(--color-text-muted)]">

                                                <span dir="ltr">
                                                    {{ $product->sku }}
                                                </span>

                                            @if($product->brand)

                                                <span class="text-[var(--color-border-strong)]">
                                                        •
                                                    </span>

                                                <span>
                                                        {{ $product->brand }}
                                                    </span>

                                            @endif

                                        </div>

                                    </div>

                                </div>

                            </td>


                            {{-- Category --}}
                            <td class="px-5 py-4">

                                    <span class="text-[11px] font-bold text-[var(--color-text-secondary)]">
                                        {{ $product->category?->name ?? 'بدون دسته‌بندی' }}
                                    </span>

                            </td>


                            {{-- Price --}}
                            <td class="px-5 py-4">

                                <div class="text-xs font-black text-[var(--color-text-primary)]">
                                    {{ number_format($product->price) }}
                                </div>

                                <div class="mt-0.5 text-[9px] font-bold text-[var(--color-text-muted)]">
                                    تومان
                                </div>


                                @if($product->old_price && $product->old_price > $product->price)

                                    <div class="mt-1 flex items-center gap-1.5">

                                            <span class="text-[9px] text-[var(--color-text-muted)] line-through">
                                                {{ number_format($product->old_price) }}
                                            </span>

                                        @if($product->discount)

                                            <span class="rounded bg-[var(--color-accent-50)] px-1.5 py-0.5 text-[8px] font-black text-[var(--color-accent-700)]">
                                                    {{ $product->discount }}٪
                                                </span>

                                        @endif

                                    </div>

                                @endif

                            </td>


                            {{-- Stock --}}
                            <td class="px-5 py-4">

                                @if($product->stock <= 0)

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-2.5 py-1 text-[10px] font-black text-red-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                                            ناموجود
                                        </span>

                                @elseif($product->stock <= 5)

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-2.5 py-1 text-[10px] font-black text-amber-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                            {{ number_format($product->stock) }} عدد
                                        </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-[10px] font-black text-emerald-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            {{ number_format($product->stock) }} عدد
                                        </span>

                                @endif

                            </td>


                            {{-- Status --}}
                            <td class="px-5 py-4">

                                <div class="flex flex-wrap gap-1.5">

                                    @if($product->is_active)

                                        <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-[9px] font-black text-emerald-700">
                                                فعال
                                            </span>

                                    @else

                                        <span class="rounded-full bg-red-50 px-2.5 py-1 text-[9px] font-black text-red-700">
                                                غیرفعال
                                            </span>

                                    @endif


                                    @if($product->is_featured)

                                        <span class="rounded-full bg-[var(--color-brand-50)] px-2.5 py-1 text-[9px] font-black text-[var(--color-brand-700)]">
                                                ویژه
                                            </span>

                                    @endif

                                </div>

                            </td>


                            {{-- Actions --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center justify-end gap-2">

                                    <a
                                        href="{{ route('admin.products.edit', $product) }}"
                                        class="inline-flex h-8 items-center justify-center rounded-lg border border-[var(--color-border)] bg-white px-3 text-[10px] font-black text-[var(--color-text-primary)] transition hover:bg-[var(--color-neutral-50)]"
                                    >
                                        ویرایش
                                    </a>


                                    <a
                                        href="{{ route('products.show', $product) }}"
                                        target="_blank"
                                        rel="noopener"
                                        class="flex h-8 w-8 items-center justify-center rounded-lg border border-[var(--color-border)] bg-white text-[var(--color-text-secondary)] transition hover:bg-[var(--color-neutral-50)] hover:text-[var(--color-brand-700)]"
                                        title="مشاهده محصول"
                                    >

                                        <svg
                                            class="h-3.5 w-3.5"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >
                                            <path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/>
                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="2.5"
                                            />
                                        </svg>

                                    </a>


                                    <form
                                        action="{{ route('admin.products.destroy', $product) }}"
                                        method="POST"
                                        onsubmit="return confirm('آیا از حذف این محصول مطمئن هستید؟ این عملیات قابل بازگشت نیست.');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-red-50 text-red-600 transition hover:bg-red-100"
                                            title="حذف محصول"
                                        >

                                            <svg
                                                class="h-3.5 w-3.5"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <path d="M4 7h16"/>
                                                <path d="M10 11v6M14 11v6"/>
                                                <path d="M6 7l1 13h10l1-13"/>
                                                <path d="M9 7V4h6v3"/>
                                            </svg>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="px-5 py-20 text-center"
                            >

                                <div class="mx-auto max-w-sm">

                                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-[var(--color-neutral-100)] text-[var(--color-text-muted)]">

                                        <svg
                                            class="h-7 w-7"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                        >
                                            <path d="M6 4h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Z"/>
                                            <path d="M8 9h8M8 13h5"/>
                                        </svg>

                                    </div>

                                    <h3 class="mt-4 text-sm font-black text-[var(--color-text-primary)]">
                                        محصولی پیدا نشد
                                    </h3>

                                    <p class="mt-1.5 text-xs leading-6 text-[var(--color-text-muted)]">
                                        فیلترهای فعلی نتیجه‌ای ندارند یا هنوز محصولی ثبت نشده است.
                                    </p>


                                    @if(request()->hasAny(['search', 'category_id', 'status']))

                                        <a
                                            href="{{ route('admin.products.index') }}"
                                            class="mt-4 inline-flex rounded-xl bg-[var(--color-brand-600)] px-4 py-2.5 text-[10px] font-black text-white transition hover:bg-[var(--color-brand-700)]"
                                        >
                                            حذف فیلترها
                                        </a>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>


            {{-- =====================================================
                MOBILE
            ====================================================== --}}

            <div class="divide-y divide-[var(--color-border)] lg:hidden">

                @forelse($products as $product)

                    <article class="p-4">

                        <div class="flex gap-3.5">

                            {{-- Image --}}
                            <div class="relative h-20 w-20 shrink-0 overflow-hidden rounded-xl border border-[var(--color-border)] bg-[var(--color-neutral-50)]">

                                @if($product->primaryImage)

                                    <img
                                        src="{{ asset('storage/' . ltrim($product->primaryImage->image, '/')) }}"
                                        alt="{{ $product->primaryImage->alt ?: $product->name }}"
                                        loading="lazy"
                                        class="h-full w-full object-cover"
                                    >

                                @else

                                    <div class="flex h-full w-full items-center justify-center text-[var(--color-text-muted)]">

                                        <svg
                                            class="h-6 w-6"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.5"
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

                                @endif


                                @if(($product->images_count ?? 0) > 1)

                                    <span class="absolute bottom-1 right-1 rounded-md bg-black/75 px-1.5 py-0.5 text-[8px] font-black text-white">
                                        {{ number_format($product->images_count) }}
                                    </span>

                                @endif

                            </div>


                            {{-- Main info --}}
                            <div class="min-w-0 flex-1">

                                <div class="flex items-start justify-between gap-2">

                                    <a
                                        href="{{ route('admin.products.edit', $product) }}"
                                        class="min-w-0 truncate text-xs font-black text-[var(--color-text-primary)]"
                                    >
                                        {{ $product->name }}
                                    </a>


                                    @if($product->is_featured)

                                        <span class="shrink-0 rounded-full bg-[var(--color-brand-50)] px-2 py-1 text-[8px] font-black text-[var(--color-brand-700)]">
                                            ویژه
                                        </span>

                                    @endif

                                </div>


                                <div class="mt-1.5 text-[10px] text-[var(--color-text-muted)]">
                                    {{ $product->category?->name ?? 'بدون دسته‌بندی' }}
                                </div>


                                <div class="mt-2 flex items-baseline gap-1.5">

                                    <span class="text-xs font-black text-[var(--color-text-primary)]">
                                        {{ number_format($product->price) }}
                                    </span>

                                    <span class="text-[9px] font-bold text-[var(--color-text-muted)]">
                                        تومان
                                    </span>

                                </div>


                                <div class="mt-2 flex flex-wrap items-center gap-1.5">

                                    @if($product->stock <= 0)

                                        <span class="rounded-full bg-red-50 px-2 py-1 text-[8px] font-black text-red-700">
                                            ناموجود
                                        </span>

                                    @elseif($product->stock <= 5)

                                        <span class="rounded-full bg-amber-50 px-2 py-1 text-[8px] font-black text-amber-700">
                                            {{ number_format($product->stock) }} عدد
                                        </span>

                                    @else

                                        <span class="rounded-full bg-emerald-50 px-2 py-1 text-[8px] font-black text-emerald-700">
                                            {{ number_format($product->stock) }} عدد
                                        </span>

                                    @endif


                                    @if($product->is_active)

                                        <span class="rounded-full bg-emerald-50 px-2 py-1 text-[8px] font-black text-emerald-700">
                                            فعال
                                        </span>

                                    @else

                                        <span class="rounded-full bg-red-50 px-2 py-1 text-[8px] font-black text-red-700">
                                            غیرفعال
                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>


                        {{-- Mobile actions --}}
                        <div class="mt-3 grid grid-cols-3 gap-2">

                            <a
                                href="{{ route('admin.products.edit', $product) }}"
                                class="inline-flex h-9 items-center justify-center rounded-lg border border-[var(--color-border)] text-[10px] font-black text-[var(--color-text-primary)]"
                            >
                                ویرایش
                            </a>


                            <a
                                href="{{ route('products.show', $product) }}"
                                target="_blank"
                                rel="noopener"
                                class="inline-flex h-9 items-center justify-center rounded-lg border border-[var(--color-border)] text-[10px] font-black text-[var(--color-text-secondary)]"
                            >
                                مشاهده
                            </a>


                            <form
                                action="{{ route('admin.products.destroy', $product) }}"
                                method="POST"
                                onsubmit="return confirm('آیا از حذف این محصول مطمئن هستید؟');"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="h-9 w-full rounded-lg bg-red-50 text-[10px] font-black text-red-700"
                                >
                                    حذف
                                </button>

                            </form>

                        </div>

                    </article>

                @empty

                    <div class="px-5 py-16 text-center">

                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-[var(--color-neutral-100)] text-[var(--color-text-muted)]">

                            <svg
                                class="h-6 w-6"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.5"
                            >
                                <path d="M6 4h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Z"/>
                                <path d="M8 9h8M8 13h5"/>
                            </svg>

                        </div>

                        <p class="mt-3 text-xs font-black text-[var(--color-text-primary)]">
                            محصولی پیدا نشد
                        </p>

                    </div>

                @endforelse

            </div>


            {{-- Pagination --}}
            @if($products->hasPages())

                <div class="border-t border-[var(--color-border)] px-4 py-4 sm:px-5">
                    {{ $products->withQueryString()->links() }}
                </div>

            @endif

        </section>

    </div>

@endsection
