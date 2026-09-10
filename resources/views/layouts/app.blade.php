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
        @yield('title', 'فرزین | هود و سینک')
    </title>

    <meta
        name="description"
        content="@yield(
            'meta_description',
            'فرزین؛ انتخابی حرفه‌ای برای هود و سینک مدرن با طراحی زیبا، کیفیت قابل اعتماد و تجربه خرید مطمئن.'
        )"
    >

    @stack('meta')

    @vite('resources/js/app.js')

    @stack('styles')

</head>


<body>

<div id="app" class="app">

    <x-layout.header />

    <main class="app-main">
        @yield('content')
    </main>

    <x-layout.footer />

</div>


@stack('scripts')

</body>

</html>
