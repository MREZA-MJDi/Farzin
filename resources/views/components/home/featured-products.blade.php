@props([
'products',
])

<section
    class="section home-section home-section--featured janan-featured"
    aria-labelledby="featured-title"
>

    <div class="container">

        <div class="section__inner">

            <div class="janan-featured__head">

                <x-ui.section-header
                    eyebrow="JANAN EDIT"
                    title="انتخاب‌های ویژه ژنان"
                    description="قطعه‌هایی که به‌خاطر طراحی، لطافت و حس متفاوتشان برای این مجموعه انتخاب شده‌اند."
                    title-id="featured-title"
                >
                    <x-slot:action>
                        <a
                            href="{{ route('shop.index') }}"
                            class="janan-featured__link"
                        >
                            مشاهده همه محصولات

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

            </div>


            <div class="section-content">

                <div class="janan-featured__intro">

                    <div class="janan-featured__count">

                        <span class="janan-featured__count-number">
                            {{ str_pad($products->count(), 2, '0', STR_PAD_LEFT) }}
                        </span>

                        <span class="janan-featured__count-label">
                            SELECTED PIECES
                        </span>

                    </div>


                    <p class="janan-featured__intro-text">
                        انتخاب‌هایی آرام و زنانه،
                        برای لحظه‌هایی که دوست داری بیشتر خودت باشی.
                    </p>

                </div>


                @if($products->isNotEmpty())

                    <div class="janan-featured__grid">

                        @foreach($products as $index => $product)

                            @php
                                $imageUrl = $product->primaryImage
                                    ? asset('storage/' . ltrim($product->primaryImage->image, '/'))
                                    : null;
                            @endphp

                            <article
                                class="janan-featured-card {{ $index === 0 ? 'janan-featured-card--large' : '' }}"
                            >

                                <a
                                    href="{{ route('products.show', $product) }}"
                                    class="janan-featured-card__media"
                                >

                                    <div class="janan-featured-card__background"></div>

                                    @if($imageUrl)

                                        <img
                                            src="{{ $imageUrl }}"
                                            alt="{{ $product->primaryImage?->alt ?: $product->name }}"
                                            class="janan-featured-card__image"
                                            loading="{{ $index < 2 ? 'eager' : 'lazy' }}"
                                            decoding="async"
                                        >

                                    @else

                                        <div class="janan-featured-card__placeholder">

                                            <svg
                                                width="42"
                                                height="42"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.2"
                                                aria-hidden="true"
                                            >
                                                <rect
                                                    x="3"
                                                    y="4"
                                                    width="18"
                                                    height="16"
                                                    rx="2"
                                                />
                                                <circle
                                                    cx="8.5"
                                                    cy="9"
                                                    r="1.4"
                                                />
                                                <path d="m21 15-5-5-4.5 4.5-2.5-2.5L3 18"/>
                                            </svg>

                                        </div>

                                    @endif


                                    <div class="janan-featured-card__top">

                                        @if($product->is_featured)

                                            <span class="janan-featured-card__badge">
                                                منتخب
                                            </span>

                                        @endif

                                        <span class="janan-featured-card__index">
                                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                        </span>

                                    </div>


                                    <div class="janan-featured-card__hover">

                                        <span>
                                            مشاهده محصول
                                        </span>

                                        <span class="janan-featured-card__arrow">
                                            →
                                        </span>

                                    </div>

                                </a>


                                <div class="janan-featured-card__body">

                                    <div class="janan-featured-card__meta">

                                        @if($product->brand)

                                            <span>
                                                {{ $product->brand }}
                                            </span>

                                        @else

                                            <span>
                                                JANAN
                                            </span>

                                        @endif

                                        <span class="janan-featured-card__dot"></span>

                                        <span>
                                            JANAN EDIT
                                        </span>

                                    </div>


                                    <a
                                        href="{{ route('products.show', $product) }}"
                                        class="janan-featured-card__title"
                                    >
                                        {{ $product->name }}
                                    </a>


                                    @if($product->short_description)

                                        <p class="janan-featured-card__description">
                                            {{ $product->short_description }}
                                        </p>

                                    @endif


                                    <div class="janan-featured-card__footer">

                                        <div class="janan-featured-card__pricing">

                                            @if($product->old_price)

                                                <span class="janan-featured-card__old-price">
                                                    {{ number_format($product->old_price) }}
                                                    تومان
                                                </span>

                                            @endif

                                            <span class="janan-featured-card__price">
                                                {{ number_format($product->price) }}
                                                <small>تومان</small>
                                            </span>

                                        </div>


                                        @if($product->discount)

                                            <span class="janan-featured-card__discount">
                                                {{ $product->discount }}%
                                            </span>

                                        @endif

                                    </div>

                                </div>

                            </article>

                        @endforeach

                    </div>

                @else

                    <div class="janan-featured__empty">

                        <div class="janan-featured__empty-icon">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.5"
                                aria-hidden="true"
                            >
                                <path d="M6 4h12l2 16H4L6 4Z"/>
                                <path d="M9 9h6"/>
                            </svg>

                        </div>


                        <div>

                            <span class="janan-featured__empty-eyebrow">
                                JANAN EDIT
                            </span>

                            <h2>
                                هنوز محصولی برای نمایش نداریم
                            </h2>

                            <p>
                                محصولات منتخب بعد از ثبت و فعال‌سازی،
                                اینجا نمایش داده می‌شوند.
                            </p>

                        </div>

                    </div>

                @endif

            </div>

        </div>

    </div>

</section>
