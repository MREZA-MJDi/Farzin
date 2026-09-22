@extends('layouts.app')

@section(
    'title',
    ($post->meta_title ?: $post->title) . ' | ژنان'
)

@section(
    'meta_description',
    $post->meta_description
        ?: ($post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 155))
)

@section('content')

    <article class="janan-article">

        {{-- =========================================================
            ARTICLE HEADER
        ========================================================== --}}

        <section class="janan-article__header">

            <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 sm:py-10 lg:px-8 lg:py-12">

                {{-- Breadcrumb --}}
                <nav
                    aria-label="مسیر صفحه"
                    class="flex flex-wrap items-center gap-2 text-[10px] text-[var(--text-muted)] sm:text-xs"
                >

                    <a
                        href="{{ route('home') }}"
                        class="transition hover:text-[var(--primary)]"
                    >
                        خانه
                    </a>

                    <svg
                        class="h-3.5 w-3.5 text-[var(--border-strong)]"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        aria-hidden="true"
                    >
                        <path d="m9 18 6-6-6-6"/>
                    </svg>

                    <a
                        href="{{ route('blog.index') }}"
                        class="transition hover:text-[var(--primary)]"
                    >
                        ژنان ژورنال
                    </a>

                    @if($post->category)

                        <svg
                            class="h-3.5 w-3.5 text-[var(--border-strong)]"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            aria-hidden="true"
                        >
                            <path d="m9 18 6-6-6-6"/>
                        </svg>

                        <a
                            href="{{ route('blog.index', ['category' => $post->category->slug]) }}"
                            class="transition hover:text-[var(--primary)]"
                        >
                            {{ $post->category->name }}
                        </a>

                    @endif

                </nav>


                {{-- Meta --}}
                <div class="janan-article__meta">

                    @if($post->category)

                        <a
                            href="{{ route('blog.index', ['category' => $post->category->slug]) }}"
                            class="janan-article__category"
                        >
                            {{ $post->category->name }}
                        </a>

                    @endif


                    @if($post->published_at)

                        <span>
                            {{ $post->published_at->format('Y/m/d') }}
                        </span>

                    @endif


                    @if($post->view_count > 0)

                        <i></i>

                        <span>
                            {{ number_format($post->view_count) }} بازدید
                        </span>

                    @endif

                </div>


                {{-- Title --}}
                <h1 class="janan-article__title">
                    {{ $post->title }}
                </h1>


                {{-- Excerpt --}}
                @if($post->excerpt)

                    <p class="janan-article__excerpt">
                        {{ $post->excerpt }}
                    </p>

                @endif


                {{-- Small editorial mark --}}
                <div class="janan-article__header-mark">
                    <span>JANAN JOURNAL</span>
                    <i></i>
                    <span>READ / EDIT / 2026</span>
                </div>

            </div>

        </section>


        {{-- =========================================================
            FEATURED IMAGE
        ========================================================== --}}

        @if($post->featured_image)

            <section class="mx-auto max-w-7xl px-4 pt-7 sm:px-6 sm:pt-10 lg:px-8">

                <div class="janan-article__featured-image">

                    <img
                        src="{{ asset('storage/' . ltrim($post->featured_image, '/')) }}"
                        alt="{{ $post->title }}"
                        loading="eager"
                        decoding="async"
                    >

                    <div class="janan-article__featured-overlay"></div>


                    <div class="janan-article__featured-label">
                        JANAN JOURNAL
                    </div>

                </div>

            </section>

        @endif


        {{-- =========================================================
            ARTICLE BODY
        ========================================================== --}}

        <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 sm:py-12 lg:px-8 lg:py-14">

            <div class="grid items-start gap-8 lg:grid-cols-[minmax(0,1fr)_270px] xl:gap-12">

                {{-- =================================================
                    CONTENT
                ================================================== --}}

                <div class="min-w-0">

                    <div class="janan-article__body">

                        <div class="prose-janan">
                            {!! $post->content !!}
                        </div>

                    </div>


                    {{-- Back --}}
                    <div class="mt-7">

                        <a
                            href="{{ route('blog.index') }}"
                            class="janan-article__back"
                        >

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

                            بازگشت به ژنان ژورنال

                        </a>

                    </div>

                </div>


                {{-- =================================================
                    SIDEBAR
                ================================================== --}}

                <aside class="lg:sticky lg:top-24 lg:self-start">

                    <div class="space-y-4">

                        {{-- Article Info --}}
                        <div class="janan-article__info-card">

                            <div class="janan-article__info-eyebrow">
                                ARTICLE
                            </div>


                            <div class="mt-5 space-y-4">

                                @if($post->category)

                                    <div class="janan-article__info-item">

                                        <span>
                                            دسته‌بندی
                                        </span>

                                        <a
                                            href="{{ route('blog.index', ['category' => $post->category->slug]) }}"
                                        >
                                            {{ $post->category->name }}
                                        </a>

                                    </div>

                                @endif


                                @if($post->published_at)

                                    <div class="janan-article__info-item">

                                        <span>
                                            تاریخ انتشار
                                        </span>

                                        <strong>
                                            {{ $post->published_at->format('Y/m/d') }}
                                        </strong>

                                    </div>

                                @endif


                                <div class="janan-article__info-item">

                                    <span>
                                        بازدید
                                    </span>

                                    <strong>
                                        {{ number_format($post->view_count) }}
                                    </strong>

                                </div>

                            </div>

                        </div>


                        {{-- Editorial CTA --}}
                        <div class="janan-article__cta">

                            <div class="janan-article__cta-orb"></div>

                            <div class="relative">

                                <span class="janan-article__cta-eyebrow">
                                    KEEP READING
                                </span>

                                <h3>
                                    چیزهای بیشتری
                                    برای کشف کردن هست.
                                </h3>

                                <p>
                                    نوشته‌های بیشتری از ژنان را ببین؛
                                    برای کمی الهام، کمی شناخت و انتخابی بهتر.
                                </p>

                                <a
                                    href="{{ route('blog.index') }}"
                                    class="janan-article__cta-button"
                                >
                                    رفتن به مجله

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

                        </div>

                    </div>

                </aside>

            </div>

        </section>


        {{-- =========================================================
            RELATED POSTS
        ========================================================== --}}

        @if($relatedPosts->isNotEmpty())

            <section class="janan-related">

                <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 sm:py-16 lg:px-8">

                    <div class="janan-related__head">

                        <div>

                            <div class="janan-related__eyebrow">
                                <span></span>
                                MORE FROM JANAN
                            </div>

                            <h2>
                                شاید این‌ها هم
                                دوست‌داشتنی باشند.
                            </h2>

                            <p>
                                چند مطلب دیگر برای ادامه‌ی مسیر.
                            </p>

                        </div>


                        <a
                            href="{{ route('blog.index') }}"
                            class="janan-related__all"
                        >
                            مشاهده همه

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


                    <div class="janan-related__grid">

                        @foreach($relatedPosts as $index => $relatedPost)

                            <article class="janan-related-card">

                                <a
                                    href="{{ route('blog.show', $relatedPost) }}"
                                    class="janan-related-card__media"
                                >

                                    @if($relatedPost->featured_image)

                                        <img
                                            src="{{ asset('storage/' . ltrim($relatedPost->featured_image, '/')) }}"
                                            alt="{{ $relatedPost->title }}"
                                            loading="lazy"
                                            decoding="async"
                                        >

                                    @else

                                        <div class="janan-related-card__placeholder">

                                            <span>
                                                JANAN
                                            </span>

                                            <small>
                                                JOURNAL
                                            </small>

                                        </div>

                                    @endif


                                    <div class="janan-related-card__overlay"></div>


                                    <span class="janan-related-card__number">
                                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                    </span>

                                </a>


                                <div class="janan-related-card__body">

                                    @if($relatedPost->published_at)

                                        <div class="janan-related-card__meta">
                                            {{ $relatedPost->published_at->format('Y/m/d') }}
                                        </div>

                                    @endif


                                    <a
                                        href="{{ route('blog.show', $relatedPost) }}"
                                        class="janan-related-card__title"
                                    >
                                        {{ $relatedPost->title }}
                                    </a>


                                    @if($relatedPost->excerpt)

                                        <p class="janan-related-card__excerpt">
                                            {{ $relatedPost->excerpt }}
                                        </p>

                                    @endif


                                    <a
                                        href="{{ route('blog.show', $relatedPost) }}"
                                        class="janan-related-card__read"
                                    >
                                        مطالعه مقاله

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

                            </article>

                        @endforeach

                    </div>

                </div>

            </section>

        @endif

    </article>

@endsection
