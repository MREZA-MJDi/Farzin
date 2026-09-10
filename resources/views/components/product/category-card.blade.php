@props([
'title',
'image',
'href' => '#',
'eyebrow' => null,
'description' => null,
])

<a
    href="{{ $href }}"
    class="category-card"
>

    {{-- Image --}}
    <div class="category-card__image">

        <img
            src="{{ $image }}"
            alt="{{ $title }}"
            loading="lazy"
            width="800"
            height="600"
        >

    </div>


    {{-- Overlay --}}
    <span
        class="category-card__overlay"
        aria-hidden="true"
    ></span>


    {{-- Content --}}
    <div class="category-card__content">

        @if($eyebrow)
            <span class="category-card__eyebrow">
                {{ $eyebrow }}
            </span>
        @endif


        <h3 class="category-card__title">
            {{ $title }}
        </h3>


        @if($description)
            <p class="category-card__description">
                {{ $description }}
            </p>
        @endif


        <span class="category-card__link">
            <span>مشاهده محصولات</span>

            <span
                class="category-card__link-arrow"
                aria-hidden="true"
            >
                ←
            </span>
        </span>

    </div>

</a>
