@extends('layouts.app')

@section('title', 'فرزین | هود و سینک مدرن')

@section(
    'meta_description',
    'فرزین؛ انتخابی حرفه‌ای برای هود و سینک مدرن با طراحی زیبا، کیفیت قابل اعتماد و تجربه خرید مطمئن.'
)

@section('content')

    <main class="home-page">

        <x-home.hero />

        <x-home.categories />

        <x-home.featured-products />

        <x-home.features />

        <x-home.showcase />

        <x-home.blog />

        <x-home.newsletter />

    </main>

@endsection
