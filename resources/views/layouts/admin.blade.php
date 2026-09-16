<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    {{-- =========================================================
        SEO
    ========================================================== --}}

    <title>
        @yield('title', 'پنل مدیریت | فرزین')
    </title>

    <meta
        name="description"
        content="@yield('meta_description', 'پنل مدیریت فروشگاه فرزین')"
    >

    <meta
        name="robots"
        content="noindex, nofollow"
    >

    {{-- =========================================================
        Brand
    ========================================================== --}}

    <meta
        name="theme-color"
        content="#0d1b3d"
    >

    <link
        rel="icon"
        type="image/png"
        href="{{ asset('images/brand/logo.png') }}"
    >

    <link
        rel="apple-touch-icon"
        href="{{ asset('images/brand/logo.png') }}"
    >

    {{-- =========================================================
        Assets
    ========================================================== --}}

    @vite([
    'resources/css/app.css',
    'resources/js/app.js',
    ])

    @stack('head')
</head>

<body
    class="min-h-screen bg-[var(--color-neutral-50)] text-[var(--color-text-primary)] antialiased"
>

<div
    x-data="{ sidebarOpen: false }"
    class="min-h-screen"
>

    {{-- =========================================================
        Mobile Backdrop
    ========================================================== --}}

    <div
        x-show="sidebarOpen"
        x-cloak
        x-transition.opacity
        @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-[var(--color-brand-950)]/45 backdrop-blur-sm lg:hidden"
    ></div>


    {{-- =========================================================
        Sidebar
    ========================================================== --}}

    @include('admin.partials.sidebar')


    {{-- =========================================================
        Main Area
    ========================================================== --}}

    <div class="min-h-screen lg:mr-[280px]">

        {{-- =====================================================
            Topbar
        ====================================================== --}}

        <header
            class="sticky top-0 z-30 border-b border-[var(--color-border)] bg-white/90 backdrop-blur-xl"
        >

            <div
                class="flex min-h-[72px] items-center justify-between gap-4 px-4 sm:px-6 lg:px-8"
            >

                {{-- =================================================
                    Right Side
                ================================================== --}}

                <div class="flex min-w-0 items-center gap-3">

                    {{-- Mobile Menu --}}

                    <button
                        type="button"
                        @click="sidebarOpen = true"
                        class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-[var(--color-border)] bg-white text-[var(--color-text-secondary)] transition duration-200 hover:border-[var(--color-brand-300)] hover:bg-[var(--color-brand-50)] hover:text-[var(--color-brand-900)] lg:hidden"
                        aria-label="باز کردن منو"
                        aria-controls="admin-sidebar"
                    >
                        <svg
                            class="h-5 w-5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            aria-hidden="true"
                        >
                            <path d="M4 7h16" />
                            <path d="M4 12h16" />
                            <path d="M4 17h16" />
                        </svg>
                    </button>


                    {{-- Page Heading --}}

                    <div class="min-w-0">

                        <div
                            class="truncate text-sm font-black text-[var(--color-text-primary)] sm:text-base"
                        >
                            @yield('page_title', 'داشبورد')
                        </div>

                        <div
                            class="mt-0.5 hidden text-xs text-[var(--color-text-muted)] sm:block"
                        >
                            مدیریت فروشگاه فرزین
                        </div>

                    </div>

                </div>


                {{-- =================================================
                    Left Side
                ================================================== --}}

                <div class="flex shrink-0 items-center">

                    {{-- =================================================
                        Admin Profile
                    ================================================== --}}

                    <div
                        id="adminProfile"
                        class="relative"
                    >

                        <button
                            type="button"
                            id="adminProfileButton"
                            class="flex items-center gap-2 rounded-xl border border-[var(--color-border)] bg-white px-2 py-2 transition duration-200 hover:border-[var(--color-brand-300)] hover:bg-[var(--color-brand-50)] sm:gap-3 sm:px-2.5"
                            aria-expanded="false"
                            aria-haspopup="menu"
                            aria-controls="adminProfileMenu"
                        >

                            {{-- Avatar --}}

                            <span
                                class="relative flex h-9 w-9 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-[var(--color-brand-900)] text-sm font-black text-white shadow-sm"
                            >
                                {{ mb_substr(auth()->user()->name ?? 'A', 0, 1) }}

                                <span
                                    class="absolute bottom-0.5 left-0.5 h-2.5 w-2.5 rounded-full border-2 border-[var(--color-brand-900)] bg-emerald-400"
                                    aria-hidden="true"
                                ></span>
                            </span>


                            {{-- User Details --}}

                            <span class="hidden text-right sm:block">

                                <span
                                    class="block max-w-[130px] truncate text-xs font-black text-[var(--color-text-primary)]"
                                >
                                    {{ auth()->user()->name ?? 'Admin' }}
                                </span>

                                <span
                                    class="mt-0.5 block text-[11px] font-medium text-[var(--color-text-muted)]"
                                >
                                    مدیر سیستم
                                </span>

                            </span>


                            {{-- Chevron --}}

                            <svg
                                id="adminProfileChevron"
                                class="hidden h-4 w-4 text-[var(--color-text-muted)] transition duration-200 sm:block"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                aria-hidden="true"
                            >
                                <path d="m7 10 5 5 5-5" />
                            </svg>

                        </button>


                        {{-- =================================================
                            Profile Dropdown
                        ================================================== --}}

                        <div
                            id="adminProfileMenu"
                            class="absolute left-0 top-[calc(100%+10px)] z-50 hidden w-64 overflow-hidden rounded-2xl border border-[var(--color-border)] bg-white p-2 shadow-[var(--shadow-lg)]"
                            role="menu"
                            aria-hidden="true"
                        >

                            {{-- Profile Header --}}

                            <div class="mb-1 rounded-xl bg-[var(--color-brand-50)] p-3">

                                <div class="flex items-center gap-3">

                                    <span
                                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[var(--color-brand-900)] text-sm font-black text-white"
                                    >
                                        {{ mb_substr(auth()->user()->name ?? 'A', 0, 1) }}
                                    </span>

                                    <div class="min-w-0">

                                        <p
                                            class="truncate text-xs font-black text-[var(--color-text-primary)]"
                                        >
                                            {{ auth()->user()->name ?? 'Admin' }}
                                        </p>

                                        <p
                                            class="mt-0.5 truncate text-[11px] text-[var(--color-text-muted)]"
                                        >
                                            {{ auth()->user()->email ?? 'admin' }}
                                        </p>

                                    </div>

                                </div>

                            </div>


                            {{-- Profile Link --}}

                            <a
                                href="#"
                                role="menuitem"
                                class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-bold text-[var(--color-text-secondary)] transition duration-150 hover:bg-[var(--color-neutral-50)] hover:text-[var(--color-text-primary)]"
                            >

                                <span
                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-[var(--color-neutral-100)] text-[var(--color-brand-900)]"
                                >
                                    <svg
                                        class="h-4 w-4"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        aria-hidden="true"
                                    >
                                        <path d="M20 21a8 8 0 0 0-16 0" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                </span>

                                پروفایل

                            </a>


                            {{-- Separator --}}

                            <div
                                class="my-1.5 border-t border-[var(--color-border)]"
                            ></div>


                            {{-- Logout --}}

                            <form
                                method="POST"
                                action="{{ route('logout') }}"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    role="menuitem"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-bold text-[var(--color-danger-700)] transition duration-150 hover:bg-[var(--color-danger-50)]"
                                >

                                    <span
                                        class="flex h-8 w-8 items-center justify-center rounded-lg bg-[var(--color-danger-50)]"
                                    >
                                        <svg
                                            class="h-4 w-4"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            aria-hidden="true"
                                        >
                                            <path d="M10 17l5-5-5-5" />
                                            <path d="M15 12H3" />
                                            <path d="M21 3v18" />
                                        </svg>
                                    </span>

                                    خروج از حساب

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </header>


        {{-- =====================================================
            Page Content
        ====================================================== --}}

        <main class="px-4 py-6 sm:px-6 lg:px-8 lg:py-8">

            {{-- =================================================
                Flash Success
            ================================================== --}}

            @if(session('success'))

                <div
                    class="mb-6 flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3.5 text-sm text-emerald-800 shadow-sm"
                    role="status"
                >

                    <div
                        class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-700"
                    >
                        <svg
                            class="h-4 w-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            aria-hidden="true"
                        >
                            <path d="m5 12 4 4L19 6" />
                        </svg>
                    </div>

                    <div class="pt-1 font-bold">
                        {{ session('success') }}
                    </div>

                </div>

            @endif


            {{-- =================================================
                Flash Error
            ================================================== --}}

            @if(session('error'))

                <div
                    class="mb-6 flex items-start gap-3 rounded-2xl border border-red-200 bg-red-50 px-4 py-3.5 text-sm text-red-800 shadow-sm"
                    role="alert"
                >

                    <div
                        class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-700"
                    >
                        <svg
                            class="h-4 w-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            aria-hidden="true"
                        >
                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            />

                            <path d="M12 8v5" />

                            <path d="M12 16h.01" />
                        </svg>
                    </div>

                    <div class="pt-1 font-bold">
                        {{ session('error') }}
                    </div>

                </div>

            @endif


            {{-- =================================================
                Validation Errors
            ================================================== --}}

            @if($errors->any())

                <div
                    class="mb-6 overflow-hidden rounded-2xl border border-red-200 bg-white shadow-sm"
                    role="alert"
                >

                    <div
                        class="flex items-center gap-3 border-b border-red-100 bg-red-50 px-4 py-3.5"
                    >

                        <div
                            class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-700"
                        >
                            <svg
                                class="h-4 w-4"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                aria-hidden="true"
                            >
                                <circle
                                    cx="12"
                                    cy="12"
                                    r="9"
                                />

                                <path d="M12 8v5" />

                                <path d="M12 16h.01" />
                            </svg>
                        </div>

                        <div>

                            <div class="text-sm font-black text-red-800">
                                خطا در اطلاعات واردشده
                            </div>

                            <div class="mt-0.5 text-xs text-red-600">
                                لطفاً موارد زیر را بررسی و اصلاح کنید.
                            </div>

                        </div>

                    </div>


                    <div class="px-4 py-4">

                        <ul class="space-y-2">

                            @foreach($errors->all() as $error)

                                <li
                                    class="flex items-start gap-2 text-xs font-semibold leading-6 text-red-700"
                                >

                                    <span
                                        class="mt-2 h-1.5 w-1.5 shrink-0 rounded-full bg-red-500"
                                    ></span>

                                    <span>
                                        {{ $error }}
                                    </span>

                                </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            @endif


            {{-- =================================================
                Content
            ================================================== --}}

            @yield('content')

        </main>

    </div>

</div>


{{-- =============================================================
    Profile Dropdown Script
============================================================== --}}

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const profile = document.getElementById('adminProfile');
        const button = document.getElementById('adminProfileButton');
        const menu = document.getElementById('adminProfileMenu');
        const chevron = document.getElementById('adminProfileChevron');

        if (!profile || !button || !menu) {
            return;
        }

        function openProfile() {
            menu.classList.remove('hidden');

            button.setAttribute('aria-expanded', 'true');
            menu.setAttribute('aria-hidden', 'false');

            if (chevron) {
                chevron.classList.add('rotate-180');
            }

            menu.animate(
                [
                    {
                        opacity: 0,
                        transform: 'translateY(-5px) scale(0.98)'
                    },
                    {
                        opacity: 1,
                        transform: 'translateY(0) scale(1)'
                    }
                ],
                {
                    duration: 150,
                    easing: 'ease-out'
                }
            );
        }

        function closeProfile() {
            menu.classList.add('hidden');

            button.setAttribute('aria-expanded', 'false');
            menu.setAttribute('aria-hidden', 'true');

            if (chevron) {
                chevron.classList.remove('rotate-180');
            }
        }

        function toggleProfile(event) {
            event.preventDefault();
            event.stopPropagation();

            const isOpen = !menu.classList.contains('hidden');

            if (isOpen) {
                closeProfile();
            } else {
                openProfile();
            }
        }

        button.addEventListener('click', toggleProfile);

        document.addEventListener('click', function (event) {
            if (!profile.contains(event.target)) {
                closeProfile();
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeProfile();
            }
        });

        menu.addEventListener('click', function (event) {
            event.stopPropagation();
        });
    });
</script>


@stack('scripts')

</body>
</html>
