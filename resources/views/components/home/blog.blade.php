<section
    class="section home-section home-section--blog janan-blog"
    aria-labelledby="home-blog-title"
>
    <div class="container">

        <div class="section__inner">

            {{-- =========================================================
                HEADER
            ========================================================== --}}

            <x-ui.section-header
                eyebrow="JANAN JOURNAL"
                title="برای خودت، کمی بیشتر."
                description="یادداشت‌ها، راهنماها و ایده‌هایی درباره زیبایی، راحتی و انتخاب‌های روزمره."
                title-id="home-blog-title"
            >
                <x-slot:action>
                    <a
                        href="{{ route('blog.index') }}"
                        class="janan-blog__all"
                    >
                        ورود به مجله

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
                </x-slot:action>
            </x-ui.section-header>


            <div class="section-content">

                <div class="janan-blog__grid">

                    {{-- =================================================
                        FEATURED ARTICLE
                    ================================================== --}}

                    <article class="janan-blog-card janan-blog-card--featured">

                        <a
                            href="{{ route('blog.show', ['slug' => 'guide-to-choosing-hood']) }}"
                            class="janan-blog-card__media"
                        >

                            <img
                                src="{{ asset('images/blog/hood-guide.webp') }}"
                                alt="راهنمای انتخاب بهتر"
                                class="janan-blog-card__image"
                                loading="lazy"
                                decoding="async"
                            >

                            <div class="janan-blog-card__overlay"></div>


                            <div class="janan-blog-card__top">

                                <span class="janan-blog-card__category">
                                    راهنما
                                </span>

                                <span class="janan-blog-card__number">
                                    01
                                </span>

                            </div>


                            <div class="janan-blog-card__floating">
                                <span>
                                    JANAN JOURNAL
                                </span>
                            </div>

                        </a>


                        <div class="janan-blog-card__body">

                            <div class="janan-blog-card__meta">
                                ۵ دقیقه مطالعه
                                <span></span>
                                GUIDE
                            </div>


                            <a
                                href="{{ route('blog.show', ['slug' => 'guide-to-choosing-hood']) }}"
                                class="janan-blog-card__title"
                            >
                                چطور انتخابی داشته باشیم که
                                بیشتر شبیه خودمان باشد؟
                            </a>


                            <p class="janan-blog-card__excerpt">
                                گاهی انتخاب خوب، فقط درباره ظاهر نیست؛
                                درباره حسی است که بعد از انتخاب با خودت می‌بری.
                            </p>


                            <a
                                href="{{ route('blog.show', ['slug' => 'guide-to-choosing-hood']) }}"
                                class="janan-blog-card__read"
                            >
                                ادامه مطلب

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
                            </a>

                        </div>

                    </article>


                    {{-- =================================================
                        ARTICLE 02
                    ================================================== --}}

                    <article class="janan-blog-card">

                        <a
                            href="{{ route('blog.show', ['slug' => 'kitchen-sink-guide']) }}"
                            class="janan-blog-card__media"
                        >

                            <img
                                src="{{ asset('images/blog/sink-guide.webp') }}"
                                alt="راهنمای انتخاب لباس زیر"
                                class="janan-blog-card__image"
                                loading="lazy"
                                decoding="async"
                            >

                            <div class="janan-blog-card__overlay"></div>


                            <div class="janan-blog-card__top">

                                <span class="janan-blog-card__category">
                                    انتخاب
                                </span>

                                <span class="janan-blog-card__number">
                                    02
                                </span>

                            </div>

                        </a>


                        <div class="janan-blog-card__body">

                            <div class="janan-blog-card__meta">
                                ۴ دقیقه مطالعه
                                <span></span>
                                STYLE
                            </div>


                            <a
                                href="{{ route('blog.show', ['slug' => 'kitchen-sink-guide']) }}"
                                class="janan-blog-card__title"
                            >
                                زیبایی از جایی شروع می‌شود
                                که راحتی را فراموش نکنیم.
                            </a>


                            <p class="janan-blog-card__excerpt">
                                درباره انتخاب‌هایی که هم زیبا هستند
                                و هم برای استفاده روزمره احساس خوبی می‌سازند.
                            </p>


                            <a
                                href="{{ route('blog.show', ['slug' => 'kitchen-sink-guide']) }}"
                                class="janan-blog-card__read"
                            >
                                ادامه مطلب

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
                            </a>

                        </div>

                    </article>


                    {{-- =================================================
                        ARTICLE 03
                    ================================================== --}}

                    <article class="janan-blog-card">

                        <a
                            href="{{ route('blog.show', ['slug' => 'modern-kitchen-design']) }}"
                            class="janan-blog-card__media"
                        >

                            <img
                                src="{{ asset('images/blog/kitchen-design.webp') }}"
                                alt="استایل و انتخاب روزمره"
                                class="janan-blog-card__image"
                                loading="lazy"
                                decoding="async"
                            >

                            <div class="janan-blog-card__overlay"></div>


                            <div class="janan-blog-card__top">

                                <span class="janan-blog-card__category">
                                    الهام
                                </span>

                                <span class="janan-blog-card__number">
                                    03
                                </span>

                            </div>

                        </a>


                        <div class="janan-blog-card__body">

                            <div class="janan-blog-card__meta">
                                ۶ دقیقه مطالعه
                                <span></span>
                                JOURNAL
                            </div>


                            <a
                                href="{{ route('blog.show', ['slug' => 'modern-kitchen-design']) }}"
                                class="janan-blog-card__title"
                            >
                                چند انتخاب کوچک برای
                                احساس بهتر در هر روز
                            </a>


                            <p class="janan-blog-card__excerpt">
                                از رنگ و پارچه تا جزئیات ساده‌ای که
                                می‌توانند حال‌وهوای روزمره را تغییر دهند.
                            </p>


                            <a
                                href="{{ route('blog.show', ['slug' => 'modern-kitchen-design']) }}"
                                class="janan-blog-card__read"
                            >
                                ادامه مطلب

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
                            </a>

                        </div>

                    </article>

                </div>

            </div>

        </div>

    </div>
</section>
