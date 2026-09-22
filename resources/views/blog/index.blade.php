@extends('layouts.app')

@section('title', 'مجله ژنان | راهنما، الهام و انتخاب بهتر')

@section(
    'meta_description',
    'مجله ژنان؛ راهنماها، ایده‌ها و مطالب کاربردی درباره زیبایی، راحتی، استایل و انتخاب بهتر.'
)

@section('content')

    <div class="min-h-screen bg-[var(--background)]">

        <section class="mx-auto max-w-7xl px-4 py-7 sm:px-6 sm:py-10 lg:px-8 lg:py-12">

            {{-- =========================================================
                JOURNAL HERO
            ========================================================== --}}

            <section class="janan-journal-hero">

                <div class="janan-journal-hero__orb janan-journal-hero__orb--one"></div>
                <div class="janan-journal-hero__orb janan-journal-hero__orb--two"></div>

                <div class="janan-journal-hero__grid"></div>


                <div class="relative z-10 max-w-4xl">

                    <div class="janan-journal-hero__eyebrow">

                        <span></span>

                        JANAN JOURNAL

                        <span></span>

                    </div>


                    <h1 class="janan-journal-hero__title">
                        چیزهایی برای
                        <em>خودت.</em>
                    </h1>


                    <p class="janan-journal-hero__description">
                        یادداشت‌ها، راهنماها و ایده‌هایی درباره زیبایی،
                        راحتی، استایل و انتخاب‌هایی که حال هر روزت را بهتر می‌کنند.
                    </p>


                    <div class="janan-journal-hero__meta">

                        <div>
                            <strong>
                                {{ number_format($posts->total()) }}
                            </strong>

                            <span>
                                ARTICLES
                            </span>
                        </div>


                        <i></i>


                        <div>
                            <strong>
                                2026
                            </strong>

                            <span>
                                JANAN JOURNAL
                            </span>
                        </div>

                    </div>

                </div>

            </section>


            {{-- =========================================================
                SEARCH + CATEGORIES
            ========================================================== --}}

            <div class="mt-7 grid gap-3 lg:grid-cols-[minmax(0,1fr)_auto]">

                {{-- Search --}}
                <form
                    action="{{ route('blog.index') }}"
                    method="GET"
                    class="janan-journal-search"
                >

                    @if(request('category'))

                        <input
                            type="hidden"
                            name="category"
                            value="{{ request('category') }}"
                        >

                    @endif


                    <div class="relative min-w-0 flex-1">

                        <svg
                            class="pointer-events-none absolute right-4 top-1/2 h-4.5 w-4.5 -translate-y-1/2 text-[var(--text-muted)]"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.7"
                            aria-hidden="true"
                        >
                            <circle
                                cx="11"
                                cy="11"
                                r="7"
                            />

                            <path
                                stroke-linecap="round"
                                d="m20 20-4-4"
                            />
                        </svg>


                        <input
                            type="search"
                            name="search"
                            value="{{ $search ?? request('search') }}"
                            placeholder="جستجو در مجله ژنان..."
                            autocomplete="off"
                            class="janan-journal-search__input"
                        >

                    </div>


                    <button
                        type="submit"
                        class="janan-journal-search__button"
                    >
                        جستجو
                    </button>

                </form>


                {{-- Categories --}}
                <div class="janan-journal-categories">

                    <div class="janan-journal-categories__scroll">

                        <a
                            href="{{ route('blog.index') }}"
                            class="janan-journal-category {{ empty($category) ? 'is-active' : '' }}"
                        >
                            همه مطالب
                        </a>


                        @foreach($categories as $blogCategory)

                            <a
                                href="{{ route('blog.index', ['category' => $blogCategory->slug]) }}"
                                class="janan-journal-category {{ ($category ?? '') === $blogCategory->slug ? 'is-active' : '' }}"
                            >
                                {{ $blogCategory->name }}
                            </a>

                        @endforeach

                    </div>

                </div>

            </div>


            {{-- =========================================================
                RESULT HEADER
            ========================================================== --}}

            <div class="janan-journal-result-head">

                <div>

                    <div class="janan-journal-result-eyebrow">

                        <span></span>

                        LATEST STORIES

                    </div>


                    <h2>
                        تازه‌ترین نوشته‌ها
                    </h2>


                    <p>
                        کمی وقت برای خودت، کمی الهام برای انتخاب بعدی.
                    </p>

                </div>


                <div class="janan-journal-result-count">

                    <span></span>

                    {{ number_format($posts->total()) }}

                    مطلب

                </div>

            </div>


            {{-- =========================================================
                POSTS
            ========================================================== --}}

            @if($posts->isNotEmpty())

                <div class="janan-journal-posts">

                    @foreach($posts as $index => $post)

                        <article
                            class="janan-journal-card {{ $index === 0 ? 'janan-journal-card--featured' : '' }}"
                        >

                            {{-- Image --}}
                            <a
                                href="{{ route('blog.show', $post) }}"
                                class="janan-journal-card__media"
                            >

                                @if($post->featured_image)

                                    <img
                                        src="{{ asset('storage/' . ltrim($post->featured_image, '/')) }}"
                                        alt="{{ $post->title }}"
                                        class="janan-journal-card__image"
                                        loading="{{ $index < 2 ? 'eager' : 'lazy' }}"
                                        decoding="async"
                                    >

                                @else

                                    <div class="janan-journal-card__placeholder">

                                        <span>
                                            JANAN
                                        </span>

                                        <small>
                                            JOURNAL
                                        </small>

                                    </div>

                                @endif


                                <div class="janan-journal-card__overlay"></div>


                                <div class="janan-journal-card__top">

                                    @if($post->category)

                                        <span class="janan-journal-card__category">
                                            {{ $post->category->name }}
                                        </span>

                                    @endif


                                    <span class="janan-journal-card__number">
                                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                    </span>

                                </div>


                                @if($index === 0)

                                    <div class="janan-journal-card__label">
                                        JANAN FEATURED
                                    </div>

                                @endif

                            </a>


                            {{-- Content --}}
                            <div class="janan-journal-card__body">

                                <div class="janan-journal-card__meta">

                                    @if($post->published_at)

                                        <span>
                                            {{ $post->published_at->format('Y/m/d') }}
                                        </span>

                                    @endif


                                    @if($post->view_count > 0)

                                        <i></i>

                                        <span>
                                            {{ number_format($post->view_count) }}
                                            بازدید
                                        </span>

                                    @endif

                                </div>


                                <a
                                    href="{{ route('blog.show', $post) }}"
                                    class="janan-journal-card__title"
                                >
                                    {{ $post->title }}
                                </a>


                                @if($post->excerpt)

                                    <p class="janan-journal-card__excerpt">
                                        {{ $post->excerpt }}
                                    </p>

                                @endif


                                <a
                                    href="{{ route('blog.show', $post) }}"
                                    class="janan-journal-card__read"
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

                    @endforeach

                </div>


                {{-- =====================================================
                    PAGINATION
                ====================================================== --}}

                @if($posts->hasPages())

                    <div class="mt-12 flex justify-center">
                        {{ $posts->onEachSide(1)->links() }}
                    </div>

                @endif


            @else

                {{-- =====================================================
                    EMPTY
                ====================================================== --}}

                <div class="janan-journal-empty">

                    <div class="janan-journal-empty__orb"></div>


                    <div class="janan-journal-empty__icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.4"
                            aria-hidden="true"
                        >
                            <path d="M5 4h11a3 3 0 0 1 3 3v13H8a3 3 0 0 1-3-3V4Z"/>
                            <path d="M8 20V7a3 3 0 0 1 3-3"/>
                            <path d="M11 9h5"/>
                            <path d="M11 13h5"/>
                        </svg>

                    </div>


                    <span>
                        JANAN JOURNAL
                    </span>


                    <h2>
                        چیزی پیدا نکردیم.
                    </h2>


                    <p>
                        عبارت جستجو یا دسته‌بندی را تغییر بده
                        و دوباره در مجله ژنان جستجو کن.
                    </p>


                    <a
                        href="{{ route('blog.index') }}"
                        class="janan-journal-empty__button"
                    >
                        نمایش همه مطالب

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

            @endif

        </section>


        {{-- =========================================================
            BOTTOM EDITORIAL CTA
        ========================================================== --}}

        <section class="janan-journal-cta">

            <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">

                <div class="janan-journal-cta__box">

                    <div class="janan-journal-cta__content">

                        <span>
                            FROM JANAN
                        </span>

                        <h2>
                            انتخاب خوب،
                            از شناخت خودت شروع می‌شود.
                        </h2>

                        <p>
                            برای کشف محصولات جدید و مجموعه‌های ژنان،
                            به فروشگاه سر بزن.
                        </p>

                    </div>


                    <a
                        href="{{ route('shop.index') }}"
                        class="janan-journal-cta__button"
                    >
                        کشف فروشگاه

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

        </section>

    </div>

@endsection
