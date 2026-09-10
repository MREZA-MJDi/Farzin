@extends('layouts.app')

@section('title', 'فرزین | هود و سینک مدرن')

@section(
    'meta_description',
    'فرزین؛ انتخابی حرفه‌ای برای هود و سینک مدرن با طراحی زیبا، کیفیت قابل اعتماد و تجربه خرید مطمئن.'
)

@section('content')

    <main class="home-page">

        {{-- Hero --}}
        <x-home.hero />


        {{-- Categories --}}
        <x-home.categories
            :categories="$categories"
        />


        {{-- Featured Products --}}
        <x-home.featured-products
            :products="$featuredProducts"
        />


        {{-- Features --}}
        <x-home.features />


        {{-- Showcase --}}
        <x-home.showcase />


        {{-- Blog --}}
        <x-home.blog />


        {{-- Newsletter --}}
        <x-home.newsletter />

    </main>

@endsection

