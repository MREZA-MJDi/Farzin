@props([
'images' => [],
'name' => '',
])

@php
    $normalizedImages = collect($images)
        ->map(function ($image) use ($name) {
            if (is_array($image)) {
                return [
                    'src' => $image['src'] ?? '',
                    'alt' => $image['alt'] ?? $name,
                ];
            }

            return [
                'src' => $image,
                'alt' => $name,
            ];
        })
        ->filter(fn ($image) => filled($image['src']))
        ->values();

    $hasImages = $normalizedImages->isNotEmpty();
    $mainImage = $normalizedImages->first();
@endphp

<div
    {{ $attributes->merge([
        'class' => 'product-gallery',
    ]) }}
    data-product-gallery
>

    {{-- Main image --}}
    <div class="product-gallery__main">

        @if($hasImages)

            <img
                src="{{ $mainImage['src'] }}"
                alt="{{ $mainImage['alt'] }}"
                width="900"
                height="900"
                data-gallery-main
            >

        @else

            <div
                class="product-gallery__empty"
                aria-label="تصویری برای این محصول موجود نیست"
            >
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.6"
                    aria-hidden="true"
                >
                    <rect
                        x="4"
                        y="4"
                        width="16"
                        height="16"
                        rx="2"
                    />
                    <circle
                        cx="9"
                        cy="9"
                        r="1.5"
                    />
                    <path d="M4 16L9 11L13 15L16 12L20 16" />
                </svg>

                <span>
                    تصویر موجود نیست
                </span>
            </div>

        @endif

    </div>


    {{-- Thumbnails --}}
    @if($normalizedImages->count() > 1)

        <div
            class="product-gallery__thumbs"
            role="list"
            aria-label="تصاویر محصول"
        >

            @foreach($normalizedImages as $index => $image)

                <button
                    type="button"
                    class="product-gallery__thumb {{ $index === 0 ? 'is-active' : '' }}"
                    data-gallery-thumb
                    data-image="{{ $image['src'] }}"
                    aria-label="نمایش تصویر {{ $index + 1 }}"
                    aria-pressed="{{ $index === 0 ? 'true' : 'false' }}"
                >

                    <img
                        src="{{ $image['src'] }}"
                        alt="{{ $image['alt'] }}"
                        width="96"
                        height="96"
                        loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                    >

                </button>

            @endforeach

        </div>

    @endif

</div>
