<footer class="site-footer janan-footer">

    <div class="container">

        {{-- =========================================================
            MAIN
        ========================================================== --}}

        <div class="site-footer__main">

            {{-- =====================================================
                BRAND
            ====================================================== --}}

            <div class="site-footer__brand janan-footer__brand">

                <a
                    href="{{ route('home') }}"
                    class="site-footer__logo janan-footer__logo"
                    aria-label="ژنان"
                >
                    JANAN
                </a>


                <span class="janan-footer__brand-line">
                    SOFTNESS / EVERYDAY / YOU
                </span>


                <p class="site-footer__description janan-footer__description">
                    ژنان برای زنانی است که زیبایی را در کنار راحتی،
                    ظرافت و حس خوب انتخاب می‌کنند.
                </p>


                <a
                    href="{{ route('shop.index') }}"
                    class="janan-footer__discover"
                >
                    کشف مجموعه

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


            {{-- =====================================================
                SHOP
            ====================================================== --}}

            <div>

                <h3 class="site-footer__title janan-footer__title">
                    خرید
                </h3>


                <nav
                    class="site-footer__links janan-footer__links"
                    aria-label="لینک‌های خرید"
                >

                    <a
                        href="{{ route('shop.index') }}"
                        class="site-footer__link"
                    >
                        فروشگاه
                    </a>


                    <a
                        href="{{ route('categories.index') }}"
                        class="site-footer__link"
                    >
                        دسته‌بندی‌ها
                    </a>


                    <a
                        href="{{ route('shop.index') }}"
                        class="site-footer__link"
                    >
                        محصولات جدید
                    </a>


                    <a
                        href="{{ route('customer.cart.index') }}"
                        class="site-footer__link"
                    >
                        سبد خرید
                    </a>

                </nav>

            </div>


            {{-- =====================================================
                JOURNAL
            ====================================================== --}}

            <div>

                <h3 class="site-footer__title janan-footer__title">
                    ژورنال
                </h3>


                <nav
                    class="site-footer__links janan-footer__links"
                    aria-label="لینک‌های ژورنال"
                >

                    <a
                        href="{{ route('blog.index') }}"
                        class="site-footer__link"
                    >
                        ژنان ژورنال
                    </a>


                    <a
                        href="{{ route('blog.index') }}"
                        class="site-footer__link"
                    >
                        راهنما و ایده‌ها
                    </a>


                    <a
                        href="{{ route('blog.index') }}"
                        class="site-footer__link"
                    >
                        تازه‌ترین نوشته‌ها
                    </a>

                </nav>

            </div>


            {{-- =====================================================
                CONTACT
            ====================================================== --}}

            <div>

                <h3 class="site-footer__title janan-footer__title">
                    ارتباط
                </h3>


                <div class="site-footer__contact janan-footer__contact">

                    <a
                        href="tel:+982112345678"
                        class="site-footer__contact-item"
                    >
                        ۰۲۱-۱۲۳۴۵۶۷۸
                    </a>


                    <a
                        href="mailto:info@example.com"
                        class="site-footer__contact-item"
                    >
                        info@example.com
                    </a>


                    <a
                        href="{{ route('contact.index') }}"
                        class="site-footer__contact-item janan-footer__contact-link"
                    >
                        صفحه تماس با ما
                    </a>


                    <span class="site-footer__contact-item">
                        شنبه تا پنجشنبه
                    </span>

                </div>

            </div>

        </div>


        {{-- =========================================================
            NEWSLETTER STRIP
        ========================================================== --}}

        <div class="janan-footer__newsletter">

            <div class="janan-footer__newsletter-content">

                <span>
                    STAY CLOSE
                </span>

                <strong>
                    خبرهای خوب ژنان را زودتر ببین.
                </strong>

            </div>


            <a
                href="{{ route('blog.index') }}"
                class="janan-footer__newsletter-link"
            >
                ورود به ژورنال

                <svg
                    width="14"
                    height="14"
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


        {{-- =========================================================
            BOTTOM
        ========================================================== --}}

        <div class="site-footer__bottom janan-footer__bottom">

            <span>
                © {{ date('Y') }} JANAN.
                تمامی حقوق محفوظ است.
            </span>


            <div class="janan-footer__bottom-right">

                <span>
                    MADE FOR EVERYDAY BEAUTY
                </span>

                <span class="janan-footer__bottom-dot"></span>

                <span>
                    ژنان
                </span>

            </div>

        </div>

    </div>

</footer>
