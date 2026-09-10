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

    <title>
        @yield('title', 'تکمیل سفارش | فرزین')
    </title>

    <meta
        name="description"
        content="@yield(
            'meta_description',
            'تکمیل سفارش در فرزین'
        )"
    >

    @stack('meta')

    @vite('resources/js/app.js')

    @stack('styles')

</head>


<body>

<div class="app">

    <header class="checkout-header">

        <div class="container checkout-header__inner">

            <a
                href="{{ route('home') }}"
                class="checkout-header__logo"
                aria-label="بازگشت به فرزین"
            >
                FARZIN
            </a>

        </div>

    </header>


    <main class="app-main">
        @yield('content')
    </main>

</div>


@stack('scripts')

</body>

</html>
