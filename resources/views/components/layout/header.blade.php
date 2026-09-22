<header
    class="site-header janan-header"
    x-data="{ accountOpen: false }"
>

    <div class="site-header__main">

        <div class="container site-header__inner">

            {{-- =====================================================
                 LOGO
            ====================================================== --}}

            <a
                href="{{ route('home') }}"
                class="site-header__logo janan-header__logo"
                aria-label="ژنان"
            >

                <span class="site-header__logo-text">
                    JANAN
                </span>

                <span class="janan-header__logo-sub">
                    EVERYDAY BEAUTY
                </span>

            </a>


            {{-- =====================================================
                 DESKTOP NAVIGATION
            ====================================================== --}}

            <nav
                class="site-header__nav janan-header__nav"
                aria-label="منوی اصلی"
            >

                <a
                    href="{{ route('home') }}"
                    class="site-header__nav-link {{ request()->routeIs('home') ? 'is-active' : '' }}"
                >
                    خانه
                </a>


                <a
                    href="{{ route('shop.index') }}"
                    class="site-header__nav-link {{ request()->routeIs('shop.*') ? 'is-active' : '' }}"
                >
                    فروشگاه
                </a>


                <a
                    href="{{ route('categories.index') }}"
                    class="site-header__nav-link {{ request()->routeIs('categories.*') ? 'is-active' : '' }}"
                >
                    دسته‌بندی‌ها
                </a>


                <a
                    href="{{ route('blog.index') }}"
                    class="site-header__nav-link {{ request()->routeIs('blog.*') ? 'is-active' : '' }}"
                >
                    ژورنال
                </a>


                <a
                    href="{{ route('about') }}"
                    class="site-header__nav-link {{ request()->routeIs('about') ? 'is-active' : '' }}"
                >
                    درباره ژنان
                </a>


                <a
                    href="{{ route('contact.index') }}"
                    class="site-header__nav-link {{ request()->routeIs('contact.*') ? 'is-active' : '' }}"
                >
                    تماس
                </a>

            </nav>


            {{-- =====================================================
                 ACTIONS
            ====================================================== --}}

            <div class="site-header__actions janan-header__actions">

                {{-- Search --}}
                <button
                    type="button"
                    class="icon-btn site-header__action janan-header__action"
                    aria-label="جستجو"
                    aria-expanded="false"
                    data-search-toggle
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        aria-hidden="true"
                    >
                        <circle
                            cx="11"
                            cy="11"
                            r="6.5"
                        />

                        <path d="M16 16L21 21"/>
                    </svg>
                </button>


                {{-- Wishlist --}}
                <a
                    href="{{ route('wishlist') }}"
                    class="icon-btn site-header__action janan-header__action"
                    aria-label="علاقه‌مندی‌ها"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        aria-hidden="true"
                    >
                        <path
                            d="M20.8 8.8C20.8 13.7 12 19 12 19S3.2 13.7 3.2 8.8C3.2 6.2 5.2 4 7.8 4C9.5 4 11 4.9 12 6.2C13 4.9 14.5 4 16.2 4C18.8 4 20.8 6.2 20.8 8.8Z"
                        />
                    </svg>
                </a>


                {{-- =================================================
                     ACCOUNT
                ================================================== --}}

                @auth

                    <button
                        type="button"
                        class="icon-btn site-header__action janan-header__action"
                        aria-label="حساب کاربری"
                        aria-haspopup="dialog"
                        :aria-expanded="accountOpen ? 'true' : 'false'"
                        @click="accountOpen = true"
                    >
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            aria-hidden="true"
                        >
                            <circle
                                cx="12"
                                cy="8"
                                r="3.2"
                            />

                            <path
                                d="M5.2 20C5.9 16.6 8.4 14.8 12 14.8C15.6 14.8 18.1 16.6 18.8 20"
                            />
                        </svg>
                    </button>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="icon-btn site-header__action janan-header__action"
                        aria-label="ورود"
                    >
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            aria-hidden="true"
                        >
                            <circle
                                cx="12"
                                cy="8"
                                r="3.2"
                            />

                            <path
                                d="M5.2 20C5.9 16.6 8.4 14.8 12 14.8C15.6 14.8 18.1 16.6 18.8 20"
                            />
                        </svg>
                    </a>

                @endauth


                {{-- =================================================
                     CART
                ================================================== --}}

                <a
                    href="{{ route('customer.cart.index') }}"
                    class="site-header__cart janan-header__cart"
                    aria-label="سبد خرید"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        aria-hidden="true"
                    >
                        <path d="M4 5H6L8.2 15.5H18L20 8H7"/>

                        <circle
                            cx="9.5"
                            cy="19"
                            r="1.2"
                        />

                        <circle
                            cx="17"
                            cy="19"
                            r="1.2"
                        />
                    </svg>


                    @if(($cartCount ?? 0) > 0)

                        <span class="site-header__cart-count janan-header__cart-count">
                            {{ $cartCount }}
                        </span>

                    @endif

                </a>


                {{-- =================================================
                     MOBILE MENU
                ================================================== --}}

                <button
                    type="button"
                    class="icon-btn site-header__menu-toggle janan-header__menu-toggle"
                    aria-label="باز کردن منو"
                    aria-expanded="false"
                    aria-controls="mobile-menu"
                    data-menu-toggle
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        aria-hidden="true"
                    >
                        <path d="M4 7H20"/>
                        <path d="M4 12H20"/>
                        <path d="M4 17H20"/>
                    </svg>
                </button>

            </div>

        </div>

    </div>


    {{-- =============================================================
         SEARCH PANEL
    ============================================================== --}}

    <div
        class="site-header__search janan-header__search"
        data-search-panel
        hidden
    >

        <div class="container">

            <form
                action="{{ route('search') }}"
                method="GET"
                class="site-header__search-form janan-header__search-form"
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    aria-hidden="true"
                >
                    <circle
                        cx="11"
                        cy="11"
                        r="6.5"
                    />

                    <path d="M16 16L21 21"/>
                </svg>


                <label
                    for="header-search"
                    class="sr-only"
                >
                    جستجوی محصولات
                </label>


                <input
                    id="header-search"
                    type="search"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="در ژنان چه چیزی می‌خواهی پیدا کنی؟"
                    autocomplete="off"
                >


                <button
                    type="button"
                    class="site-header__search-close janan-header__search-close"
                    aria-label="بستن جستجو"
                    data-search-close
                >
                    ×
                </button>

            </form>

        </div>

    </div>


    {{-- =============================================================
         ACCOUNT MODAL
    ============================================================== --}}

    @auth

        <div
            x-cloak
            x-show="accountOpen"
            x-transition.opacity
            @keydown.escape.window="accountOpen = false"
            class="janan-account-modal fixed inset-0 z-[9999] flex items-center justify-center px-4"
            role="dialog"
            aria-modal="true"
            aria-label="حساب کاربری"
        >

            {{-- Backdrop --}}
            <button
                type="button"
                class="absolute inset-0 h-full w-full cursor-default bg-slate-900/25 backdrop-blur-sm"
                aria-label="بستن"
                @click="accountOpen = false"
            ></button>


            {{-- Modal --}}
            <div
                x-show="accountOpen"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="translate-y-3 scale-[.97] opacity-0"
                x-transition:enter-end="translate-y-0 scale-100 opacity-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="translate-y-0 scale-100 opacity-100"
                x-transition:leave-end="translate-y-3 scale-[.97] opacity-0"
                @click.stop
                class="relative z-10 w-full max-w-md overflow-hidden rounded-[28px] border border-[var(--border)] bg-white shadow-[0_30px_90px_rgba(51,78,90,.18)]"
            >

                {{-- Decorative --}}
                <div
                    class="pointer-events-none absolute -right-16 -top-16 h-40 w-40 rounded-full bg-[var(--primary)]/10 blur-3xl"
                    aria-hidden="true"
                ></div>

                <div
                    class="pointer-events-none absolute -bottom-20 -left-14 h-44 w-44 rounded-full bg-[var(--accent)]/10 blur-3xl"
                    aria-hidden="true"
                ></div>


                {{-- Modal Header --}}
                <div class="relative flex items-center justify-between border-b border-[var(--border)] px-6 py-5">

                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[linear-gradient(145deg,#eef9fd,#fff4f7)] text-[var(--primary)]">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                class="h-5 w-5"
                                aria-hidden="true"
                            >
                                <circle
                                    cx="12"
                                    cy="8"
                                    r="3.2"
                                />

                                <path
                                    d="M5.2 20C5.9 16.6 8.4 14.8 12 14.8C15.6 14.8 18.1 16.6 18.8 20"
                                />
                            </svg>

                        </div>


                        <div>

                            <div class="text-[9px] font-black uppercase tracking-[0.18em] text-[var(--primary)]">
                                JANAN
                            </div>

                            <h3 class="mt-1 text-sm font-black text-[var(--text)]">
                                حساب کاربری
                            </h3>

                            <p class="mt-1 text-[10px] text-[var(--text-muted)]">
                                {{ auth()->user()->name }}
                            </p>

                        </div>

                    </div>


                    {{-- Close --}}
                    <button
                        type="button"
                        @click="accountOpen = false"
                        class="flex h-9 w-9 items-center justify-center rounded-xl text-[var(--text-muted)] transition hover:bg-[var(--surface-soft)] hover:text-[var(--text)]"
                        aria-label="بستن"
                    >
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="h-5 w-5"
                            aria-hidden="true"
                        >
                            <path d="M6 6L18 18"/>
                            <path d="M18 6L6 18"/>
                        </svg>
                    </button>

                </div>


                {{-- Modal Body --}}
                <div class="relative space-y-3 p-6">

                    {{-- User Info --}}
                    <div class="rounded-2xl border border-[var(--border)] bg-[linear-gradient(145deg,#f6fbfd,#fff7fa)] p-4">

                        <p class="text-[9px] font-bold text-[var(--text-muted)]">
                            حساب واردشده
                        </p>

                        <p class="mt-1 text-sm font-bold text-[var(--text)]">
                            {{ auth()->user()->email }}
                        </p>

                    </div>


                    {{-- Home --}}
                    <a
                        href="{{ route('home') }}"
                        @click="accountOpen = false"
                        class="flex w-full items-center justify-center gap-2 rounded-2xl border border-[var(--border)] px-4 py-3.5 text-xs font-black text-[var(--text)] transition hover:border-[var(--primary)]/20 hover:bg-[var(--surface-soft)] hover:text-[var(--primary)]"
                    >
                        بازگشت به فروشگاه

                        <svg
                            class="h-4 w-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            aria-hidden="true"
                        >
                            <path d="m9 18 6-6-6-6"/>
                        </svg>

                    </a>


                    {{-- Cart --}}
                    <a
                        href="{{ route('customer.cart.index') }}"
                        @click="accountOpen = false"
                        class="flex w-full items-center justify-center gap-2 rounded-2xl border border-[var(--border)] px-4 py-3.5 text-xs font-black text-[var(--text)] transition hover:border-[var(--primary)]/20 hover:bg-[var(--surface-soft)] hover:text-[var(--primary)]"
                    >
                        سبد خرید

                        <svg
                            class="h-4 w-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            aria-hidden="true"
                        >
                            <path d="M4 5H6L8.2 15.5H18L20 8H7"/>
                            <circle cx="9.5" cy="19" r="1.2"/>
                            <circle cx="17" cy="19" r="1.2"/>
                        </svg>

                    </a>


                    {{-- Logout --}}
                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="flex w-full items-center justify-center gap-2 rounded-2xl bg-red-50 px-4 py-3.5 text-xs font-black text-red-600 transition hover:bg-red-100"
                        >

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                class="h-4 w-4"
                                aria-hidden="true"
                            >
                                <path d="M10 17L15 12L10 7"/>
                                <path d="M15 12H3"/>
                                <path d="M21 4V20"/>
                            </svg>

                            خروج از حساب کاربری

                        </button>

                    </form>

                </div>

            </div>

        </div>

    @endauth


    {{-- =============================================================
         MOBILE MENU
    ============================================================== --}}

    <x-layout.mobile-menu />

</header>
