<div
    id="mobile-menu"
    class="mobile-menu"
    data-mobile-menu
    hidden
>
    <div
        class="mobile-menu__inner"
        role="dialog"
        aria-modal="true"
        aria-label="منوی سایت"
    >

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="mobile-menu__header">

            <div>

                <span class="mobile-menu__title">
                    منو
                </span>

                <span class="block mt-1 text-[8px] font-black uppercase tracking-[0.22em] text-[var(--text-muted)]">
                    JANAN
                </span>

            </div>


            <button
                type="button"
                class="icon-btn icon-btn--border"
                aria-label="بستن منو"
                data-menu-close
            >
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.7"
                    aria-hidden="true"
                >
                    <path
                        d="M6 6L18 18"
                        stroke-linecap="round"
                    />

                    <path
                        d="M18 6L6 18"
                        stroke-linecap="round"
                    />
                </svg>
            </button>

        </div>


        {{-- =====================================================
             NAVIGATION
        ====================================================== --}}

        <nav
            class="mobile-menu__nav"
            aria-label="منوی موبایل"
        >

            <a
                href="{{ route('home') }}"
                class="mobile-menu__link {{ request()->routeIs('home') ? 'is-active' : '' }}"
            >
                <span>خانه</span>

                <span aria-hidden="true">
                    ←
                </span>
            </a>


            <a
                href="{{ route('shop.index') }}"
                class="mobile-menu__link {{ request()->routeIs('shop.*') ? 'is-active' : '' }}"
            >
                <span>فروشگاه</span>

                <span aria-hidden="true">
                    ←
                </span>
            </a>


            <a
                href="{{ route('categories.index') }}"
                class="mobile-menu__link {{ request()->routeIs('categories.*') ? 'is-active' : '' }}"
            >
                <span>دسته‌بندی‌ها</span>

                <span aria-hidden="true">
                    ←
                </span>
            </a>


            <a
                href="{{ route('blog.index') }}"
                class="mobile-menu__link {{ request()->routeIs('blog.*') ? 'is-active' : '' }}"
            >
                <span>ژورنال</span>

                <span aria-hidden="true">
                    ←
                </span>
            </a>


            <a
                href="{{ route('about') }}"
                class="mobile-menu__link {{ request()->routeIs('about') ? 'is-active' : '' }}"
            >
                <span>درباره ژنان</span>

                <span aria-hidden="true">
                    ←
                </span>
            </a>


            <a
                href="{{ route('contact.index') }}"
                class="mobile-menu__link {{ request()->routeIs('contact.*') ? 'is-active' : '' }}"
            >
                <span>تماس با ما</span>

                <span aria-hidden="true">
                    ←
                </span>
            </a>


            <a
                href="{{ route('wishlist') }}"
                class="mobile-menu__link {{ request()->routeIs('wishlist') ? 'is-active' : '' }}"
            >
                <span>علاقه‌مندی‌ها</span>

                <span aria-hidden="true">
                    ←
                </span>
            </a>


            <a
                href="{{ route('customer.cart.index') }}"
                class="mobile-menu__link {{ request()->routeIs('customer.cart.*') ? 'is-active' : '' }}"
            >
                <span>سبد خرید</span>

                <span aria-hidden="true">
                    ←
                </span>
            </a>

        </nav>


        {{-- =====================================================
             FOOTER
        ====================================================== --}}

        <div class="mobile-menu__footer">

            <a
                href="{{ route('contact.index') }}"
                class="mobile-menu__link"
            >
                <span>
                    پشتیبانی و تماس
                </span>

                <span aria-hidden="true">
                    ←
                </span>
            </a>


            <div class="mt-4 border-t border-[var(--border)] pt-4">

                <span class="block text-[7px] font-black uppercase tracking-[0.22em] text-[var(--text-muted)]">
                    JANAN
                </span>

                <span class="mt-1 block text-[9px] text-[var(--text-muted)]">
                    Everyday Beauty
                </span>

            </div>

        </div>

    </div>
</div>
