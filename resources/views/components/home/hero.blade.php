<section
    class="hero"
    aria-labelledby="hero-title"
    data-hero
>
    <div class="hero__inner">

        {{-- =====================================================
             VISUAL
        ====================================================== --}}
        <div
            class="hero__visual"
            data-hero-visual
        >

            <div
                class="hero__image-wrap"
                data-hero-media
            >

                <video
                    autoplay
                    muted
                    loop
                    playsinline
                    preload="metadata"
                    data-hero-image
                >
                    <source
                        src="{{ asset('videos/home/hero.webm') }}"
                        type="video/webm"
                    >

                    <source
                        src="{{ asset('videos/home/hero.mp4') }}"
                        type="video/mp4"
                    >
                </video>
            </div>


            {{-- =================================================
                 FLOATING CARD
            ================================================== --}}
            <div class="hero__floating-card">

                <span class="hero__floating-label">
                    طراحی فرزین
                </span>

                <strong>
                    جزئیات، تفاوت را می‌سازند
                </strong>

                <span>
                    ترکیب طراحی، کیفیت و کارایی
                </span>

            </div>

        </div>


        {{-- =====================================================
             CONTENT
        ====================================================== --}}
        <div class="hero__content">

            <span
                class="hero__eyebrow"
                data-hero-item
            >
                طراحی برای آشپزخانه امروز
            </span>


            <h1
                id="hero-title"
                class="hero__title"
                data-hero-item
            >
                آشپزخانه،
                <span>با نگاه فرزین</span>
            </h1>


            <p
                class="hero__description"
                data-hero-item
            >
                سینک و هودهایی با طراحی مدرن،
                کیفیت قابل اعتماد و جزئیاتی که
                برای استفاده هر روز ساخته شده‌اند.
            </p>


            <div
                class="hero__actions"
                data-hero-item
            >

                <a
                    href="{{ route('shop') }}"
                    class="btn btn--primary btn--lg"
                >
                    مشاهده محصولات
                </a>

                <a
                    href="{{ route('about') }}"
                    class="btn btn--outline btn--lg"
                >
                    درباره فرزین
                </a>

            </div>


            {{-- =================================================
                 META
            ================================================== --}}
            <div
                class="hero__meta"
                data-hero-item
            >

                <div class="hero__meta-item">

                    <strong>
                        کیفیت
                    </strong>

                    <span>
                        انتخاب دقیق محصولات
                    </span>

                </div>


                <span
                    class="hero__meta-divider"
                    aria-hidden="true"
                ></span>


                <div class="hero__meta-item">

                    <strong>
                        طراحی
                    </strong>

                    <span>
                        برای فضای امروز
                    </span>

                </div>


                <span
                    class="hero__meta-divider"
                    aria-hidden="true"
                ></span>


                <div class="hero__meta-item">

                    <strong>
                        همراهی
                    </strong>

                    <span>
                        از انتخاب تا خرید
                    </span>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         SCROLL INDICATOR
    ========================================================== --}}
    <div
        class="hero__scroll"
        aria-hidden="true"
    >

        <span>
            SCROLL
        </span>

        <i></i>

    </div>

</section>
