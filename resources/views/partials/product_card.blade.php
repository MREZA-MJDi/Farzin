@php
    /*
    |--------------------------------------------------------------------------
    | Product image
    |--------------------------------------------------------------------------
    | Primary image has priority.
    | If no primary image exists, use the first gallery image.
    */

    $imageModel =
        $product->primaryImage
        ?? $product->images?->first();

    $image =
        $imageModel?->image;

    $imageUrl = $image
        ? asset('storage/' . ltrim($image, '/'))
        : null;


    /*
    |--------------------------------------------------------------------------
    | Pricing
    |--------------------------------------------------------------------------
    */

    $price = (int) ($product->price ?? 0);

    $oldPrice = $product->old_price !== null
        ? (int) $product->old_price
        : null;

    $discount = (int) ($product->discount ?? 0);

    $hasOldPrice =
        $oldPrice !== null &&
        $oldPrice > $price;


    /*
    |--------------------------------------------------------------------------
    | Availability
    |--------------------------------------------------------------------------
    */

    $stock = (int) ($product->stock ?? 0);

    $isAvailable =
        (bool) $product->is_active &&
        $stock > 0;

    $isLowStock =
        $isAvailable &&
        $stock <= 5;


    /*
    |--------------------------------------------------------------------------
    | Rating
    |--------------------------------------------------------------------------
    */

    $rating = (float) ($product->rating ?? 0);

    $reviewCount = (int) ($product->review_count ?? 0);


    /*
    |--------------------------------------------------------------------------
    | Gallery count
    |--------------------------------------------------------------------------
    */

    $imagesCount = isset($product->images_count)
        ? (int) $product->images_count
        : ($product->relationLoaded('images')
            ? $product->images->count()
            : 0);
@endphp


<article class="group min-w-0">

    <div
        class="relative overflow-hidden rounded-2xl border border-[var(--color-border)] bg-white shadow-[var(--shadow-xs)] transition duration-300 hover:-translate-y-1 hover:border-[var(--color-border-strong)] hover:shadow-[var(--shadow-md)]"
    >

        {{-- =========================================================
            IMAGE
        ========================================================== --}}

        <a
            href="{{ route('products.show', $product) }}"
            class="block"
            aria-label="مشاهده {{ $product->name }}"
        >

            <div class="relative overflow-hidden bg-[#f3f4f6]">

                {{-- Badges --}}
                <div
                    class="absolute inset-x-3 top-3 z-20 flex items-start justify-between gap-2"
                >

                    <div>

                        @if($discount > 0)

                            <span
                                class="inline-flex items-center gap-1 rounded-full bg-[var(--color-accent-600)] px-3 py-1.5 text-[10px] font-black text-white shadow-lg shadow-[var(--color-accent-600)]/20"
                            >
                                {{ $discount }}٪ تخفیف
                            </span>

                        @elseif($product->is_featured)

                            <span
                                class="inline-flex items-center gap-1 rounded-full bg-[var(--color-brand-900)] px-3 py-1.5 text-[10px] font-black text-white shadow-lg"
                            >

                                <svg
                                    class="h-3 w-3"
                                    viewBox="0 0 24 24"
                                    fill="currentColor"
                                >
                                    <path d="m12 2 2.7 6.3L21 11l-6.3 2.7L12 20l-2.7-6.3L3 11l6.3-2.7L12 2Z"/>
                                </svg>

                                منتخب فرزین

                            </span>

                        @endif

                    </div>


                    {{-- Stock --}}
                    @if(!$isAvailable)

                        <span
                            class="rounded-full bg-[var(--color-brand-950)]/90 px-3 py-1.5 text-[10px] font-black text-white shadow-sm backdrop-blur"
                        >
                            ناموجود
                        </span>

                    @elseif($isLowStock)

                        <span
                            class="rounded-full border border-white/70 bg-white/90 px-3 py-1.5 text-[10px] font-black text-[var(--color-text-secondary)] shadow-sm backdrop-blur"
                        >
                            فقط {{ number_format($stock) }} عدد
                        </span>

                    @endif

                </div>


                {{-- Product image --}}
                <div class="aspect-square overflow-hidden">

                    @if($imageUrl)

                        <img
                            src="{{ $imageUrl }}"
                            alt="{{ $imageModel?->alt ?: $product->name }}"
                            class="h-full w-full object-cover transition duration-700 ease-out group-hover:scale-[1.045]"
                            loading="lazy"
                            decoding="async"
                        >

                    @else

                        <div
                            class="flex h-full w-full items-center justify-center bg-gradient-to-br from-[#eef0f3] to-[#dfe3e8] text-[#9ca4af]"
                        >

                            <svg
                                class="h-14 w-14"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.15"
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


                    {{-- Gallery count --}}
                    @if($imagesCount > 1)

                        <span
                            class="absolute bottom-3 right-3 z-20 inline-flex items-center gap-1 rounded-full bg-black/70 px-2.5 py-1.5 text-[9px] font-black text-white backdrop-blur"
                        >

                            <svg
                                class="h-3 w-3"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.7"
                            >
                                <rect x="3" y="4" width="18" height="16" rx="2"/>
                                <circle cx="8.5" cy="9" r="1.3"/>
                                <path d="m21 15-5-5-4 4-2-2-7 7"/>
                            </svg>

                            {{ number_format($imagesCount) }}

                        </span>

                    @endif

                </div>


                {{-- Unavailable overlay --}}
                @if(!$isAvailable)

                    <div
                        class="pointer-events-none absolute inset-0 z-10 flex items-center justify-center bg-[var(--color-brand-950)]/10"
                    >

                        <span
                            class="rounded-full bg-white/95 px-4 py-2 text-xs font-black text-[var(--color-brand-950)] shadow-lg backdrop-blur"
                        >
                            فعلاً موجود نیست
                        </span>

                    </div>

                @endif


                {{-- Hover CTA --}}
                <div
                    class="pointer-events-none absolute inset-x-3 bottom-3 z-20 translate-y-3 opacity-0 transition duration-300 group-hover:translate-y-0 group-hover:opacity-100"
                >

                    <div
                        class="flex items-center justify-center gap-2 rounded-xl border border-white/70 bg-white/95 px-4 py-3 text-xs font-black text-[var(--color-brand-900)] shadow-xl backdrop-blur"
                    >

                        مشاهده جزئیات

                        <svg
                            class="h-4 w-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path d="m9 18 6-6-6-6"/>
                        </svg>

                    </div>

                </div>

            </div>

        </a>


        {{-- =========================================================
            CONTENT
        ========================================================== --}}

        <div class="p-4 sm:p-5">

            {{-- Category --}}
            @if($product->category)

                <a
                    href="{{ route('categories.show', $product->category) }}"
                    class="inline-flex max-w-full text-[11px] font-bold text-[var(--color-text-muted)] transition hover:text-[var(--color-accent-600)]"
                >
                    <span class="truncate">
                        {{ $product->category->name }}
                    </span>
                </a>

            @endif


            {{-- Product name --}}
            <a
                href="{{ route('products.show', $product) }}"
                class="block"
            >

                <h3
                    class="mt-2 min-h-[3rem] line-clamp-2 text-sm font-black leading-7 text-[var(--color-text-primary)] transition group-hover:text-[var(--color-brand-900)]"
                >
                    {{ $product->name }}
                </h3>

            </a>


            {{-- Meta --}}
            <div class="mt-3 flex items-center justify-between gap-3">

                @if($product->sku)

                    <span
                        dir="ltr"
                        class="truncate text-[10px] font-medium text-[var(--color-text-soft)]"
                    >
                        {{ $product->sku }}
                    </span>

                @else

                    <span></span>

                @endif


                @if($reviewCount > 0)

                    <div class="flex shrink-0 items-center gap-1.5">

                        <svg
                            class="h-3.5 w-3.5 text-amber-500"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                        >
                            <path d="m12 2.8 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2-5.6-3-5.6 3 1.1-6.2L3 9.4l6.2-.9L12 2.8Z"/>
                        </svg>

                        <span class="text-[11px] font-black text-[var(--color-text-secondary)]">
                            {{ number_format($rating, 1) }}
                        </span>

                    </div>

                @endif

            </div>


            {{-- Price --}}
            <div class="mt-4 flex items-end justify-between gap-3">

                <div class="min-w-0">

                    @if($hasOldPrice)

                        <div class="mb-1 flex items-center gap-2">

                            <span
                                class="text-[11px] text-[var(--color-text-soft)] line-through"
                            >
                                {{ number_format($oldPrice) }}
                            </span>

                            @if($discount > 0)

                                <span
                                    class="rounded-md bg-[var(--color-accent-50)] px-1.5 py-0.5 text-[9px] font-black text-[var(--color-accent-700)]"
                                >
                                    {{ $discount }}٪
                                </span>

                            @endif

                        </div>

                    @endif


                    <div class="flex items-baseline gap-1">

                        <span
                            class="text-lg font-black tracking-tight text-[var(--color-brand-950)]"
                        >
                            {{ number_format($price) }}
                        </span>

                        <span class="text-[10px] font-bold text-[var(--color-text-muted)]">
                            تومان
                        </span>

                    </div>

                </div>


                @if($isAvailable)

                    <span
                        class="inline-flex shrink-0 items-center gap-1.5 rounded-xl bg-emerald-50 px-2.5 py-2 text-[10px] font-extrabold text-emerald-700"
                    >
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        موجود
                    </span>

                @else

                    <span
                        class="inline-flex shrink-0 items-center rounded-xl bg-[var(--color-neutral-100)] px-2.5 py-2 text-[10px] font-extrabold text-[var(--color-text-muted)]"
                    >
                        ناموجود
                    </span>

                @endif

            </div>

        </div>

    </div>

</article>
