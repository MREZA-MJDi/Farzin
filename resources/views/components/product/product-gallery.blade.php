@props([
'images' => [],
'name' => '',
])

<div
    class="product-gallery"
    data-product-gallery
>

    <div class="product-gallery__main">

        @if(count($images))

            <img
                src="{{ $images[0]['src'] ?? $images[0] }}"
                alt="{{ $images[0]['alt'] ?? $name }}"
                data-gallery-main
            >

        @endif

    </div>


    @if(count($images) > 1)

        <div
            class="product-gallery__thumbs"
            role="list"
        >

            @foreach($images as $index => $image)

                @php
                    $src = is_array($image)
                        ? ($image['src'] ?? '')
                        : $image;

                    $alt = is_array($image)
                        ? ($image['alt'] ?? $name)
                        : $name;
                @endphp

                <button
                    type="button"
                    class="product-gallery__thumb {{ $index === 0 ? 'is-active' : '' }}"
                    data-gallery-thumb
                    data-image="{{ $src }}"
                    aria-label="نمایش تصویر {{ $index + 1 }}"
                    aria-pressed="{{ $index === 0 ? 'true' : 'false' }}"
                >
                    <img
                        src="{{ $src }}"
                        alt="{{ $alt }}"
                        loading="lazy"
                    >
                </button>

            @endforeach

        </div>

    @endif

</div>
