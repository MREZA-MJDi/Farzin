<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'فرزین')
    </title>

    <meta
        name="description"
        content="@yield(
            'meta_description',
            'فرزین؛ هود و سینک مدرن با طراحی و کیفیت قابل اعتماد.'
        )"
    >

    @stack('meta')

    @vite('resources/js/app.js')

    @stack('styles')

</head>


<body>

<div id="app" class="app">

    <main class="app-main">
        @yield('content')
    </main>

</div>


@stack('scripts')

</body>

</html>
