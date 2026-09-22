<section
    class="section section--sm home-section home-section--newsletter janan-newsletter"
    aria-labelledby="newsletter-title"
>
    <div class="container">

        <div class="section__inner">

            <div class="newsletter janan-newsletter__box">

                {{-- Decorative --}}
                <div
                    class="janan-newsletter__glow janan-newsletter__glow--one"
                    aria-hidden="true"
                ></div>

                <div
                    class="janan-newsletter__glow janan-newsletter__glow--two"
                    aria-hidden="true"
                ></div>


                <div class="newsletter__inner janan-newsletter__inner">

                    {{-- =================================================
                        CONTENT
                    ================================================== --}}

                    <div class="newsletter__content janan-newsletter__content">

                        <span class="newsletter__eyebrow janan-newsletter__eyebrow">
                            JANAN JOURNAL
                        </span>

                        <h2
                            id="newsletter-title"
                            class="newsletter__title janan-newsletter__title"
                        >
                            چیزهای خوب،
                            <em>منتظر خبر کردن تو هستند.</em>
                        </h2>

                        <p class="newsletter__description janan-newsletter__description">
                            جدیدترین انتخاب‌ها، مجموعه‌های تازه و نوشته‌های ژنان
                            را گاهی مهمان ایمیلت می‌کنیم؛
                            بدون شلوغی و بدون خبرهای اضافه.
                        </p>

                    </div>


                    {{-- =================================================
                        FORM
                    ================================================== --}}

                    <form
                        action="{{ route('newsletter.subscribe') }}"
                        method="POST"
                        class="newsletter__form janan-newsletter__form"
                    >

                        @csrf

                        <div class="newsletter__input janan-newsletter__input">

                            <label
                                for="newsletter-email"
                                class="sr-only"
                            >
                                ایمیل
                            </label>

                            <input
                                id="newsletter-email"
                                type="email"
                                name="email"
                                class="form-input"
                                placeholder="ایمیل شما"
                                autocomplete="email"
                                required
                            >

                        </div>


                        <button
                            type="submit"
                            class="btn janan-newsletter__button"
                        >
                            عضویت در ژنان

                            <svg
                                width="15"
                                height="15"
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
                        </button>

                    </form>

                </div>


                {{-- Small label --}}
                <div class="janan-newsletter__bottom">
                    <span>JANAN</span>
                    <span>CURATED FOR YOU</span>
                </div>

            </div>

        </div>

    </div>
</section>
