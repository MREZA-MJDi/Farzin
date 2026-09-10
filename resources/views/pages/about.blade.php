@extends('layouts.app')

@section('title', 'درباره فرزین | هود و سینک')

@section(
    'meta_description',
    'درباره فرزین؛ داستان برند، نگاه ما به طراحی، کیفیت و تجربه خرید محصولات آشپزخانه.'
)

@section('content')

    <main class="about-page">

        <section class="section section--sm">

            <div class="container">

                <div class="section__inner">

                    <x-layout.breadcrumb
                        :items="[
                            ['label' => 'درباره ما']
                        ]"
                    />

                    <header class="page-header">

                        <span class="page-header__eyebrow">
                            درباره فرزین
                        </span>

                        <h1 class="page-header__title">
                            طراحی بهتر،
                            برای زندگی بهتر.
                        </h1>

                        <p class="page-header__description">
                            فرزین با تمرکز بر هود و سینک،
                            تلاش می‌کند انتخاب و خرید تجهیزات آشپزخانه را
                            ساده‌تر، شفاف‌تر و حرفه‌ای‌تر کند.
                        </p>

                    </header>

                </div>

            </div>

        </section>


        <section class="section section--top-none">

            <div class="container">

                <div class="grid grid-cols-2 gap-8">

                    <article class="card card--padded">

                        <div class="stack stack--md">

                            <span class="section-header__eyebrow">
                                نگاه ما
                            </span>

                            <h2>
                                محصول فقط یک وسیله نیست.
                            </h2>

                            <p>
                                کیفیت، طراحی، جزئیات و تجربه استفاده روزمره،
                                همه بخشی از انتخاب درست هستند.
                            </p>

                            <p>
                                ما تلاش می‌کنیم اطلاعات محصول را روشن و قابل فهم
                                ارائه کنیم تا خرید برای شما ساده‌تر باشد.
                            </p>

                        </div>

                    </article>


                    <figure class="card overflow-hidden">

                        <img
                            src="{{ asset('images/about/about.webp') }}"
                            alt="فضای مدرن آشپزخانه فرزین"
                            width="900"
                            height="700"
                            loading="lazy"
                            class="w-full h-full object-cover"
                        >

                    </figure>

                </div>

            </div>

        </section>

    </main>

@endsection
