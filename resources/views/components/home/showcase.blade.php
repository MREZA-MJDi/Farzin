<section
    class="section home-section home-section--showcase janan-showcase"
    aria-labelledby="showcase-title"
>
    <div class="container">

        <div class="showcase janan-showcase__box">

            <div class="showcase__inner janan-showcase__inner">

                {{-- =================================================
                    MEDIA
                ================================================== --}}

                <div class="showcase__media janan-showcase__media">

                    <div class="janan-showcase__glow" aria-hidden="true"></div>

                    <img
                        src="{{ asset('images/home/showcase.jpg') }}"
                        alt="مجموعه ژنان"
                        width="1000"
                        height="780"
                        loading="lazy"
                        decoding="async"
                    >

                    <div class="janan-showcase__image-label">
                        JANAN / 2026
                    </div>

                </div>


                {{-- =================================================
                    CONTENT
                ================================================== --}}

                <div class="showcase__content janan-showcase__content">

                    <span class="showcase__eyebrow janan-showcase__eyebrow">
                        THE JANAN EDIT
                    </span>


                    <h2
                        id="showcase-title"
                        class="showcase__title janan-showcase__title"
                    >
                        جزئیات کوچک،
                        <em>حس بزرگ.</em>
                    </h2>


                    <p class="showcase__description janan-showcase__description">
                        زیبایی همیشه در چیزهای بزرگ نیست.
                        گاهی در لطافت یک پارچه،
                        انتخاب یک رنگ،
                        یا حسی است که وقتی چیزی را می‌پوشی با خودت داری.
                    </p>


                    <div class="janan-showcase__line" aria-hidden="true"></div>


                    <a
                        href="{{ route('shop.index') }}"
                        class="janan-showcase__button"
                    >
                        کشف مجموعه ژنان

                        <svg
                            width="16"
                            height="16"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <path d="M5 12h14"/>
                            <path d="m13 6 6 6-6 6"/>
                        </svg>

                    </a>

                </div>

            </div>


            {{-- =================================================
                DECORATIVE LABEL
            ================================================== --}}

            <div class="janan-showcase__side-label" aria-hidden="true">
                SOFT / SIMPLE / JANAN
            </div>

        </div>

    </div>
</section>
