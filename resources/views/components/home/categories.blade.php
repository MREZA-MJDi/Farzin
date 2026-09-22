@props([
'categories',
])

<section
    class="section home-section home-section--categories janan-categories"
    aria-labelledby="categories-title"
>

    <div class="container">

        <div class="section__inner">

            {{-- =========================================================
                HEADER
            ========================================================== --}}

            <x-ui.section-header
                eyebrow="JANAN COLLECTIONS"
                title="هر حس، یک انتخاب."
                description="مجموعه‌های ژنان را کشف کن و چیزی را انتخاب کن که بیشتر از همه شبیه خود توست."
                title-id="categories-title"
            >
                <x-slot:action>
                    <a
                        href="{{ route('categories.index') }}"
                        class="janan-categories__all"
                    >
                        مشاهده همه دسته‌بندی‌ها

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

                @if($categories->isNotEmpty())

                    <div class="janan-categories__grid">

                        @foreach($categories as $index => $category)

                            @php
                                $imageUrl = $category->image
                                    ? asset('storage/' . ltrim($category->image, '/'))
                                    : null;
                            @endphp

                            <article
                                class="janan-category-card {{ $index === 0 ? 'janan-category-card--featured' : '' }}"
                            >

                                <a
                                    href="{{ route('categories.show', $category) }}"
                                    class="janan-category-card__media"
                                >

                                    {{-- Background --}}
                                    <div class="janan-category-card__bg"></div>


                                    {{-- Image --}}
                                    @if($imageUrl)

                                        <img
                                            src="{{ $imageUrl }}"
                                            alt="{{ $category->name }}"
                                            class="janan-category-card__image"
                                            loading="{{ $index < 2 ? 'eager' : 'lazy' }}"
                                            decoding="async"
                                        >

                                    @else

                                        <div class="janan-category-card__placeholder">

                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.2"
                                                aria-hidden="true"
                                            >
                                                <rect
                                                    x="4"
                                                    y="4"
                                                    width="16"
                                                    height="16"
                                                    rx="2"
                                                />
                                                <path d="M8 9h8"/>
                                                <path d="M8 13h5"/>
                                                <path d="M8 17h7"/>
                                            </svg>

                                        </div>

                                    @endif


                                    {{-- Overlay --}}
                                    <div class="janan-category-card__overlay"></div>


                                    {{-- Top --}}
                                    <div class="janan-category-card__top">

                                        <span class="janan-category-card__number">
                                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                        </span>

                                        <span class="janan-category-card__count">
                                            {{ number_format((int) $category->active_products_count) }}
                                            محصول
                                        </span>

                                    </div>


                                    {{-- Bottom --}}
                                    <div class="janan-category-card__content">

                                        <span class="janan-category-card__eyebrow">
                                            JANAN COLLECTION
                                        </span>


                                        <h3 class="janan-category-card__title">
                                            {{ $category->name }}
                                        </h3>


                                        @if($category->description)

                                            <p class="janan-category-card__description">
                                                {{ \Illuminate\Support\Str::limit($category->description, 85) }}
                                            </p>

                                        @endif


                                        <span class="janan-category-card__link">
                                            مشاهده مجموعه

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
                                        </span>

                                    </div>

                                </a>

                            </article>

                        @endforeach

                    </div>

                @else

                    <div class="janan-categories__empty">

                        <div class="janan-categories__empty-icon">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.4"
                                aria-hidden="true"
                            >
                                <rect
                                    x="4"
                                    y="5"
                                    width="16"
                                    height="14"
                                    rx="2"
                                />
                                <path d="M4 9h16"/>
                            </svg>

                        </div>


                        <div>

                            <span class="janan-categories__empty-eyebrow">
                                JANAN COLLECTIONS
                            </span>

                            <h2>
                                هنوز مجموعه‌ای برای نمایش نداریم
                            </h2>

                            <p>
                                دسته‌بندی‌های ژنان بعد از ثبت و فعال‌سازی،
                                اینجا نمایش داده می‌شوند.
                            </p>

                        </div>

                    </div>

                @endif

            </div>

        </div>

    </div>

</section>
