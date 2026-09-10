@extends('layouts.app')

@section('title', 'درباره فرزین | هود و سینک')

@section(
    'meta_description',
    'درباره فرزین؛ داستان برند، نگاه ما به طراحی، کیفیت و تجربه خرید محصولات آشپزخانه.'
)

@section('content')

    <main class="about-page">

        <x-layout.breadcrumb
            :items="[
                ['label' => 'درباره ما']
            ]"
        />


        <section class="section section--lg">

            <div class="container">

                <div class="content-hero">

                    <span class="content-hero__eyebrow">
                        درباره فرزین
                    </span>

                    <h1 class="content-hero__title">
                        طراحی بهتر،
                        برای زندگی بهتر.
                    </h1>

                    <p class="content-hero__description">
                        فرزین با تمرکز بر هود و سینک،
                        تلاش می‌کند انتخاب و خرید تجهیزات آشپزخانه را ساده‌تر،
                        شفاف‌تر و حرفه‌ای‌تر کند.
                    </p>

                </div>

            </div>

        </section>


        <section class="section">

            <div class="container">

                <div class="content-block">

                    <div class="content-block__content">

                        <span class="content-block__eyebrow">
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
                            ما تلاش می‌کنیم اطلاعات محصول را روشن و قابل فهم ارائه کنیم
                            تا خرید برای شما ساده‌تر باشد.
                        </p>

                    </div>


                    <div class="content-block__image">

                        <img
                            src="/images/about/about.webp"
                            alt="فضای مدرن آشپزخانه فرزین"
                            loading="lazy"
                        >

                    </div>

                </div>

            </div>

        </section>

    </main>

@endsection
