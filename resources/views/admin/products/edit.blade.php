@extends('layouts.admin')

@section('title', 'ویرایش محصول')

@section('content')

    <div class="space-y-6">

        {{-- =========================================================
            HEADER
        ========================================================== --}}

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div class="min-w-0">

                <div class="flex flex-wrap items-center gap-2 text-xs font-bold text-[var(--color-text-muted)]">

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="transition hover:text-[var(--color-brand-700)]"
                    >
                        داشبورد
                    </a>

                    <span>/</span>

                    <a
                        href="{{ route('admin.products.index') }}"
                        class="transition hover:text-[var(--color-brand-700)]"
                    >
                        محصولات
                    </a>

                    <span>/</span>

                    <span class="text-[var(--color-text-secondary)]">
                        ویرایش
                    </span>

                </div>


                <div class="mt-2 flex min-w-0 items-center gap-3">

                    <h1 class="truncate text-xl font-black tracking-tight text-[var(--color-text-primary)] sm:text-2xl">
                        ویرایش محصول
                    </h1>

                    @if($product->is_active)

                        <span class="shrink-0 rounded-full bg-emerald-50 px-2.5 py-1 text-[10px] font-black text-emerald-700">
                            فعال
                        </span>

                    @else

                        <span class="shrink-0 rounded-full bg-red-50 px-2.5 py-1 text-[10px] font-black text-red-600">
                            غیرفعال
                        </span>

                    @endif

                </div>


                <p class="mt-1.5 truncate text-xs leading-6 text-[var(--color-text-secondary)] sm:text-sm">
                    ویرایش اطلاعات محصول «{{ $product->name }}»
                </p>

            </div>


            <div class="flex flex-col gap-2 sm:flex-row">

                <a
                    href="{{ route('products.show', $product) }}"
                    target="_blank"
                    rel="noopener"
                    class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl border border-[var(--color-border)] bg-white px-4 py-2.5 text-xs font-black text-[var(--color-text-primary)] shadow-[var(--shadow-xs)] transition hover:bg-[var(--color-neutral-50)]"
                >

                    <svg
                        class="h-4 w-4"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        aria-hidden="true"
                    >
                        <path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/>
                        <circle cx="12" cy="12" r="2.5"/>
                    </svg>

                    مشاهده محصول

                </a>


                <a
                    href="{{ route('admin.products.index') }}"
                    class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl border border-[var(--color-border)] bg-white px-4 py-2.5 text-xs font-black text-[var(--color-text-primary)] shadow-[var(--shadow-xs)] transition hover:bg-[var(--color-neutral-50)]"
                >

                    <svg
                        class="h-4 w-4"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        aria-hidden="true"
                    >
                        <path d="M19 12H5"/>
                        <path d="m12 19-7-7 7-7"/>
                    </svg>

                    بازگشت

                </a>

            </div>

        </div>


        {{-- =========================================================
            PRODUCT SUMMARY
        ========================================================== --}}

        <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">

            {{-- SKU --}}
            <div class="rounded-xl border border-[var(--color-border)] bg-white p-4 shadow-[var(--shadow-xs)]">

                <p class="text-[10px] font-bold text-[var(--color-text-muted)]">
                    SKU
                </p>

                <p
                    dir="ltr"
                    class="mt-1.5 truncate font-mono text-xs font-black text-[var(--color-text-primary)]"
                >
                    {{ $product->sku ?: '—' }}
                </p>

            </div>


            {{-- Price --}}
            <div class="rounded-xl border border-[var(--color-border)] bg-white p-4 shadow-[var(--shadow-xs)]">

                <p class="text-[10px] font-bold text-[var(--color-text-muted)]">
                    قیمت فروش
                </p>

                <p class="mt-1.5 text-xs font-black text-[var(--color-text-primary)]">
                    {{ number_format((int) $product->price) }}
                    <span class="text-[9px] font-bold text-[var(--color-text-muted)]">
                        تومان
                    </span>
                </p>

            </div>


            {{-- Stock --}}
            <div class="rounded-xl border border-[var(--color-border)] bg-white p-4 shadow-[var(--shadow-xs)]">

                <p class="text-[10px] font-bold text-[var(--color-text-muted)]">
                    موجودی
                </p>

                <p class="mt-1.5 text-xs font-black {{ $product->stock > 0 ? 'text-emerald-700' : 'text-red-600' }}">
                    {{ number_format((int) $product->stock) }}
                    <span class="text-[9px] font-bold text-[var(--color-text-muted)]">
                        عدد
                    </span>
                </p>

            </div>


            {{-- Images --}}
            <div class="rounded-xl border border-[var(--color-border)] bg-white p-4 shadow-[var(--shadow-xs)]">

                <p class="text-[10px] font-bold text-[var(--color-text-muted)]">
                    تصاویر
                </p>

                <p class="mt-1.5 text-xs font-black text-[var(--color-text-primary)]">
                    {{ $product->images->count() }}
                    <span class="text-[9px] font-bold text-[var(--color-text-muted)]">
                        تصویر
                    </span>
                </p>

            </div>

        </div>


        {{-- =========================================================
            VALIDATION ERRORS
        ========================================================== --}}

        @if($errors->any())

            <div class="rounded-2xl border border-red-200 bg-red-50 p-4">

                <div class="flex items-start gap-3">

                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-600">

                        <svg
                            class="h-4 w-4"
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

                    </div>


                    <div class="min-w-0">

                        <p class="text-xs font-black text-red-700">
                            اطلاعات واردشده دارای خطا است.
                        </p>

                        <ul class="mt-2 space-y-1 text-[11px] leading-5 text-red-600">

                            @foreach($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif


        {{-- =========================================================
            FORM
        ========================================================== --}}

        <form
            action="{{ route('admin.products.update', $product) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            @method('PUT')


            @include('admin.products._form', [
                'product' => $product,
                'submitLabel' => 'ذخیره تغییرات',
            ])

        </form>

    </div>

@endsection
