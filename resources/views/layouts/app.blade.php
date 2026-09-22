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
        Primary SEO
    ========================================================== --}}

    <title>
        @yield('title', 'ژنان | فروشگاه آنلاین لباس زیر زنانه')
    </title>

    <meta
        name="description"
        content="@yield('meta_description', 'ژنان | فروشگاه آنلاین لباس زیر زنانه با طراحی ظریف، کیفیت بالا و انتخابی متنوع')"
    >

    <meta
        name="robots"
        content="@yield('meta_robots', 'index, follow')"
    >

    <link
        rel="canonical"
        href="@yield('canonical_url', url()->current())"
    >


    {{-- =========================================================
        Brand / Browser
    ========================================================== --}}

    <meta
        name="theme-color"
        content="#8fc9e8"
    >

    <meta
        name="application-name"
        content="ژنان"
    >

    {{-- Favicon --}}
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
        Open Graph
    ========================================================== --}}

    <meta
        property="og:type"
        content="@yield('og_type', 'website')"
    >

    <meta
        property="og:site_name"
        content="ژنان"
    >

    <meta
        property="og:title"
        content="@yield('og_title', trim($__env->yieldContent('title', 'ژنان | فروشگاه آنلاین لباس زیر زنانه')))"
    >

    <meta
        property="og:description"
        content="@yield('og_description', trim($__env->yieldContent('meta_description', 'ژنان | فروشگاه آنلاین لباس زیر زنانه با طراحی ظریف، کیفیت بالا و انتخابی متنوع')))"
    >

    <meta
        property="og:url"
        content="{{ url()->current() }}"
    >

    <meta
        property="og:locale"
        content="fa_IR"
    >

    <meta
        property="og:image"
        content="@yield('og_image', asset('images/brand/logo.png'))"
    >


    {{-- =========================================================
        Twitter / Social
    ========================================================== --}}

    <meta
        name="twitter:card"
        content="summary_large_image"
    >

    <meta
        name="twitter:title"
        content="@yield('twitter_title', trim($__env->yieldContent('title', 'ژنان | فروشگاه آنلاین لباس زیر زنانه')))"
    >

    <meta
        name="twitter:description"
        content="@yield('twitter_description', trim($__env->yieldContent('meta_description', 'ژنان | فروشگاه آنلاین لباس زیر زنانه با طراحی ظریف، کیفیت بالا و انتخابی متنوع')))"
    >

    <meta
        name="twitter:image"
        content="@yield('twitter_image', asset('images/brand/logo.png'))"
    >


    {{-- =========================================================
        Assets
    ========================================================== --}}

    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])

    @stack('styles')
</head>


<body class="min-h-screen bg-[var(--background)] text-[var(--text)] antialiased">

{{-- =========================================================
    Navbar
========================================================== --}}

@include('partials.navbar')


{{-- =========================================================
    Flash Messages
========================================================== --}}

@include('partials.flash')


{{-- =========================================================
    Main Content
========================================================== --}}

<main class="min-h-[70vh]">
    @yield('content')
</main>


{{-- =========================================================
    Footer
========================================================== --}}

@include('partials.footer')


{{-- =========================================================
    Page Scripts
========================================================== --}}

@stack('scripts')

</body>

</html>
