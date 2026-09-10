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
        content="@yield('meta_description', 'فرزین')"
    >

    @vite([
    'resources/css/app.css',
    'resources/css/components.css',
    'resources/js/app.js',
    ])

</head>

<body>

<main class="app-main">

    @yield('content')

</main>

@stack('scripts')

</body>

</html>
