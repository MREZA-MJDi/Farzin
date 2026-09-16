@extends('layouts.admin')

@section('title', 'افزودن محصول')

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

                    <a
                        href="{{ route('admin.products.index') }}"
                        class="transition hover:text-[var(--color-brand-700)]"
                    >
                        محصولات
                    </a>

                    <span>/</span>

                    <span class="text-[var(--color-text-secondary)]">
                        افزودن
                    </span>
                </div>

                <h1 class="mt-2 text-xl font-black tracking-tight text-[var(--color-text-primary)] sm:text-2xl">
                    افزودن محصول
                </h1>

                <p class="mt-1.5 text-xs leading-6 text-[var(--color-text-secondary)] sm:text-sm">
                    اطلاعات محصول، قیمت، موجودی، تصاویر و تنظیمات سئو را وارد کنید.
                </p>

            </div>


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

                بازگشت به محصولات

            </a>

        </div>


        {{-- =========================================================
            VALIDATION ERROR
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
                            اطلاعات واردشده کامل نیست.
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
            action="{{ route('admin.products.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            @include('admin.products._form', [
                'product' => null,
                'submitLabel' => 'ثبت محصول',
            ])

        </form>

    </div>

@endsection
