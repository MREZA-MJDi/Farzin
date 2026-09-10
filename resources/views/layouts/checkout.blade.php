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

    @vite([
    'resources/css/app.css',
    'resources/css/components.css',
    'resources/js/app.js',
    ])

</head>

<body>

<div class="app">

    <header class="checkout-header">

        <div class="container">

            <a
                href="/"
                class="site-logo"
                aria-label="فرزین"
            >
                    <span class="site-logo__text">
                        FARZIN
                    </span>
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
