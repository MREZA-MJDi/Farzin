@props([
'images' => [],
'name' => '',
])

@php
    $normalizedImages = collect($images)
    ->map(function ($image) use ($name) {

            if ($image instanceof \App\Models\ProductImage) {
                $src = $image->image
                    ? asset('storage/' . ltrim($image->image, '/'))
                    : null;

                return [
                    'src' => $src,
                    'alt' => $image->alt ?: $name,
                    'sort_order' => (int) $image->sort_order,
                    'is_primary' => (bool) $image->is_primary,
                ];
            }

            if (is_array($image)) {
                $src = $image['src']
                    ?? $image['image']
                    ?? null;

                if ($src) {
                    $src = (
                        str_starts_with($src, 'http://') ||
                        str_starts_with($src, 'https://') ||
                        str_starts_with($src, '/')
                    )
                        ? $src
                        : asset('storage/' . ltrim($src, '/'));
                }

                return [
                    'src' => $src,
                    'alt' => $image['alt'] ?? $name,
                    'sort_order' => (int) ($image['sort_order'] ?? 0),
                    'is_primary' => (bool) ($image['is_primary'] ?? false),
                ];
            }

            if (is_string($image) && filled($image)) {
                return [
                    'src' => (
                        str_starts_with($image, 'http://') ||
                        str_starts_with($image, 'https://') ||
                        str_starts_with($image, '/')
                    )
                        ? $image
                        : asset('storage/' . ltrim($image, '/')),
                    'alt' => $name,
                    'sort_order' => 0,
                    'is_primary' => false,
                ];
            }

            return null;
        })
        ->filter(fn ($image) => filled($image['src'] ?? null))
        ->sortBy([
            ['is_primary', 'desc'],
            ['sort_order', 'asc'],
        ])
        ->values();

    $hasImages = $normalizedImages->isNotEmpty();
    $mainImage = $normalizedImages->first();

@endphp

<div {{ $attributes->merge(['class' => 'product-gallery']) }}>


    @if($hasImages)

        <div class="product-gallery__main">
            <img
                src="{{ $mainImage['src'] }}"
                alt="{{ $mainImage['alt'] }}"
                width="900"
                height="900"
                loading="eager"
                decoding="async"
                class="h-full w-full object-contain"
            >
        </div>

        @if($normalizedImages->count() > 1)

            <div class="product-gallery__thumbs">

                @foreach($normalizedImages as $image)

                    <img
                        src="{{ $image['src'] }}"
                        alt="{{ $image['alt'] }}"
                        width="96"
                        height="96"
                        loading="lazy"
                        decoding="async"
                        class="h-20 w-20 object-contain"
                    >

                @endforeach

            </div>

        @endif

    @else

        <div class="product-gallery__empty">
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.6"
                aria-hidden="true"
            >
                <rect x="4" y="4" width="16" height="16" rx="2"/>
                <circle cx="9" cy="9" r="1.5"/>
                <path d="M4 16L9 11L13 15L16 12L20 16"/>
            </svg>

            <span>
            تصویر موجود نیست
        </span>
        </div>
    @endif


</div>
