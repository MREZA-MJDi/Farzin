@php
    $slides = collect($heroProducts ?? [])
        ->filter(fn ($product) => $product->primaryImage)
        ->values()
        ->take(5);
@endphp

<section
    class="janan-editorial-hero"
    id="jananSlider"
    tabindex="0"
    data-janan-slider
>

    {{-- BACKGROUND DECOR --}}
    <div class="janan-hero-bg" aria-hidden="true">
        <span class="janan-bg-orb janan-bg-orb--one"></span>
        <span class="janan-bg-orb janan-bg-orb--two"></span>
        <span class="janan-bg-orb janan-bg-orb--three"></span>
        <span class="janan-bg-grid"></span>
    </div>


    {{-- LEFT COPY --}}
    <div class="janan-hero-copy">

        <span class="janan-hero-eyebrow">
            NEW COLLECTION — 2026
        </span>

        <h1>
            Feel
            <br>
            <em>Beautiful.</em>
        </h1>

        <p>
            مجموعه‌ای ظریف برای راحتی،
            اعتمادبه‌نفس و زیبایی روزمره.
        </p>

        <a
            href="{{ route('shop.index') }}"
            class="janan-hero-btn"
        >
            مشاهده مجموعه

            <svg
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2.5"
                stroke-linecap="round"
                stroke-linejoin="round"
                aria-hidden="true"
            >
                <line x1="5" y1="12" x2="19" y2="12"/>
                <polyline points="12 5 19 12 12 19"/>
            </svg>
        </a>

    </div>


    {{-- RIGHT VISUAL --}}
    <div class="janan-hero-visual">

        <div class="janan-visual-glow"></div>


        @forelse($slides as $index => $product)

            <article
                class="janan-product-card"
                data-slide-card
                data-card-index="{{ $index }}"
            >

                <img
                    src="{{ asset('storage/' . ltrim($product->primaryImage->image, '/')) }}"
                    alt="{{ $product->name }}"
                    draggable="false"
                    loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                >

                @if($index === 0)
                    <div class="janan-card-shine"></div>
                @endif

            </article>

        @empty

            {{-- FALLBACK --}}
            @for($i = 1; $i <= 5; $i++)
                <article
                    class="janan-product-card"
                    data-slide-card
                    data-card-index="{{ $i - 1 }}"
                >
                    <img
                        src="{{ asset("images/product-{$i}.jpg") }}"
                        alt="JANAN"
                        draggable="false"
                        loading="{{ $i === 1 ? 'eager' : 'lazy' }}"
                    >
                </article>
            @endfor

        @endforelse


        {{-- MAIN INFO --}}
        <div class="janan-main-info">

            <span class="janan-main-label">
                JANAN COLLECTION
            </span>

            <h2 class="janan-main-title">
                Soft
                <br>
                Essentials
            </h2>

            <span class="janan-main-brand">
                JANAN
            </span>

        </div>


        {{-- SLIDE NUMBER --}}
        <div class="janan-slider-number">

            <span
                class="janan-current"
                data-slider-current
            >
                01
            </span>

            <i></i>

            <span
                class="janan-total"
                data-slider-total
            >
                {{ str_pad(max($slides->count(), 5), 2, '0', STR_PAD_LEFT) }}
            </span>

        </div>

    </div>


    {{-- BOTTOM LABEL --}}
    <div class="janan-hero-bottom">

        <span>
            CURATED FOR YOU
        </span>

        <span>
            SCROLL TO DISCOVER
        </span>

    </div>

</section>
