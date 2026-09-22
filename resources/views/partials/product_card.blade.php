@php
    /*
    |--------------------------------------------------------------------------
    | Product image
    |--------------------------------------------------------------------------
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
        : (
            $product->relationLoaded('images')
                ? $product->images->count()
                : 0
        );
@endphp


<article class="group min-w-0">

    <div
        class="relative overflow-hidden rounded-[26px] border border-[var(--border)] bg-white transition-all duration-500 ease-out hover:-translate-y-1.5 hover:border-[var(--primary)]/25 hover:shadow-[0_22px_55px_rgba(72,91,105,0.10)]"
    >

        {{-- =========================================================
            IMAGE
        ========================================================== --}}

        <a
            href="{{ route('products.show', $product) }}"
            class="block"
            aria-label="مشاهده {{ $product->name }}"
        >

            <div
                class="relative overflow-hidden bg-[linear-gradient(145deg,rgba(126,199,232,0.10),rgba(245,214,223,0.28)_58%,rgba(255,255,255,0.96))]"
            >

                {{-- Soft decorative light --}}

                <div
                    class="pointer-events-none absolute -right-12 -top-12 z-0 h-32 w-32 rounded-full bg-[var(--primary)]/10 blur-3xl transition duration-700 group-hover:scale-125"
                ></div>

                <div
                    class="pointer-events-none absolute -bottom-14 -left-10 z-0 h-36 w-36 rounded-full bg-[var(--accent)]/10 blur-3xl transition duration-700 group-hover:scale-110"
                ></div>


                {{-- =================================================
                    Top badges
                ================================================== --}}

                <div
                    class="absolute inset-x-4 top-4 z-20 flex items-start justify-between gap-3"
                >

                    {{-- Left badge --}}

                    <div>

                        @if($discount > 0)

                            <span
                                class="inline-flex items-center rounded-full bg-[var(--accent)] px-3 py-1.5 text-[10px] font-black text-white shadow-[0_8px_20px_rgba(220,145,160,0.20)]"
                            >
                                {{ $discount }}٪ تخفیف
                            </span>

                        @elseif($product->is_featured)

                            <span
                                class="inline-flex items-center gap-1.5 rounded-full border border-white/80 bg-white/88 px-3 py-1.5 text-[10px] font-black text-[var(--primary)] shadow-sm backdrop-blur-md"
                            >

                                <svg
                                    class="h-3 w-3"
                                    viewBox="0 0 24 24"
                                    fill="currentColor"
                                    aria-hidden="true"
                                >
                                    <path d="m12 2 2.6 6.2L21 11l-6.4 2.8L12 20l-2.6-6.2L3 11l6.4-2.8L12 2Z"/>
                                </svg>

                                انتخاب ژنان

                            </span>

                        @endif

                    </div>


                    {{-- Stock badge --}}

                    @if(!$isAvailable)

                        <span
                            class="rounded-full border border-white/70 bg-slate-800/80 px-3 py-1.5 text-[10px] font-black text-white shadow-sm backdrop-blur-md"
                        >
                            ناموجود
                        </span>

                    @elseif($isLowStock)

                        <span
                            class="rounded-full border border-white/80 bg-white/88 px-3 py-1.5 text-[10px] font-black text-[var(--text-secondary)] shadow-sm backdrop-blur-md"
                        >
                            فقط {{ number_format($stock) }} عدد
                        </span>

                    @endif

                </div>


                {{-- =================================================
                    Product image
                ================================================== --}}

                <div
                    class="relative z-10 aspect-[4/5] overflow-hidden"
                >

                    @if($imageUrl)

                        <img
                            src="{{ $imageUrl }}"
                            alt="{{ $imageModel?->alt ?: $product->name }}"
                            class="h-full w-full object-contain p-5 transition duration-700 ease-[cubic-bezier(.22,1,.36,1)] group-hover:scale-[1.055] sm:p-6"
                            loading="lazy"
                            decoding="async"
                        >

                    @else

                        <div
                            class="flex h-full w-full items-center justify-center text-[var(--text-light)]"
                        >

                            <div
                                class="flex h-16 w-16 items-center justify-center rounded-full bg-white/70 shadow-sm"
                            >

                                <svg
                                    class="h-7 w-7"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.15"
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

                        </div>

                    @endif


                    {{-- Gallery count --}}

                    @if($imagesCount > 1)

                        <span
                            class="absolute bottom-4 right-4 z-20 inline-flex items-center gap-1.5 rounded-full border border-white/60 bg-slate-800/55 px-2.5 py-1.5 text-[9px] font-black text-white shadow-sm backdrop-blur-md"
                        >

                            <svg
                                class="h-3 w-3"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.7"
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
                                    r="1.3"
                                />

                                <path d="m21 15-5-5-4 4-2-2-7 7"/>

                            </svg>

                            {{ number_format($imagesCount) }}

                        </span>

                    @endif


                    {{-- Unavailable overlay --}}

                    @if(!$isAvailable)

                        <div
                            class="pointer-events-none absolute inset-0 z-10 flex items-center justify-center bg-white/18 backdrop-blur-[1px]"
                        >

                            <span
                                class="rounded-full border border-white/80 bg-white/92 px-4 py-2.5 text-xs font-black text-slate-700 shadow-lg backdrop-blur-md"
                            >
                                فعلاً موجود نیست
                            </span>

                        </div>

                    @endif


                    {{-- =================================================
                        Hover CTA
                    ================================================== --}}

                    <div
                        class="pointer-events-none absolute inset-x-4 bottom-4 z-30 translate-y-4 opacity-0 transition-all duration-400 ease-out group-hover:translate-y-0 group-hover:opacity-100"
                    >

                        <div
                            class="flex items-center justify-center gap-2 rounded-2xl border border-white/70 bg-white/92 px-4 py-3.5 text-xs font-black text-[var(--primary)] shadow-[0_12px_30px_rgba(72,91,105,0.12)] backdrop-blur-xl"
                        >

                            <span>
                                مشاهده جزئیات
                            </span>

                            <svg
                                class="h-4 w-4 transition duration-300 group-hover:-translate-x-0.5"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                aria-hidden="true"
                            >
                                <path d="m9 18 6-6-6-6"/>
                            </svg>

                        </div>

                    </div>

                </div>

            </div>

        </a>


        {{-- =========================================================
            CONTENT
        ========================================================== --}}

        <div class="px-4 pb-5 pt-4 sm:px-5 sm:pb-6">


            {{-- Category + Rating --}}

            <div
                class="flex items-center justify-between gap-3"
            >

                @if($product->category)

                    <a
                        href="{{ route('categories.show', $product->category) }}"
                        class="min-w-0 truncate text-[11px] font-bold text-[var(--primary)]/75 transition duration-200 hover:text-[var(--primary)]"
                    >
                        {{ $product->category->name }}
                    </a>

                @else

                    <span></span>

                @endif


                @if($reviewCount > 0)

                    <div
                        class="flex shrink-0 items-center gap-1.5"
                    >

                        <svg
                            class="h-3.5 w-3.5 text-[var(--accent)]"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            aria-hidden="true"
                        >
                            <path d="m12 2.8 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2-5.6-3-5.6 3 1.1-6.2L3 9.4l6.2-.9L12 2.8Z"/>
                        </svg>

                        <span
                            class="text-[10px] font-black text-[var(--text-secondary)]"
                        >
                            {{ number_format($rating, 1) }}
                        </span>

                        <span
                            class="text-[9px] text-[var(--text-light)]"
                        >
                            ({{ number_format($reviewCount) }})
                        </span>

                    </div>

                @endif

            </div>


            {{-- Product name --}}

            <a
                href="{{ route('products.show', $product) }}"
                class="block"
            >

                <h3
                    class="mt-2 min-h-[3.5rem] line-clamp-2 text-[15px] font-black leading-7 tracking-[-0.01em] text-[var(--text)] transition duration-200 group-hover:text-[var(--primary)] sm:text-base"
                >
                    {{ $product->name }}
                </h3>

            </a>


            {{-- SKU --}}

            @if($product->sku)

                <div class="mt-2">

                    <span
                        dir="ltr"
                        class="text-[9px] font-medium tracking-wide text-[var(--text-light)]"
                    >
                        {{ $product->sku }}
                    </span>

                </div>

            @endif


            {{-- =====================================================
                Price
            ====================================================== --}}

            <div
                class="mt-4 flex items-end justify-between gap-3 border-t border-[var(--border-light)] pt-4"
            >

                <div class="min-w-0">

                    @if($hasOldPrice)

                        <div
                            class="mb-1.5 flex items-center gap-2"
                        >

                            <span
                                class="text-[10px] text-[var(--text-light)] line-through"
                            >
                                {{ number_format($oldPrice) }}
                            </span>


                            @if($discount > 0)

                                <span
                                    class="rounded-full bg-[var(--accent-soft)] px-2 py-0.5 text-[9px] font-black text-[var(--accent)]"
                                >
                                    {{ $discount }}٪
                                </span>

                            @endif

                        </div>

                    @endif


                    <div class="flex items-baseline gap-1.5">

                        <span
                            class="text-[19px] font-black tracking-tight text-[var(--text)]"
                        >
                            {{ number_format($price) }}
                        </span>

                        <span
                            class="text-[9px] font-bold text-[var(--text-muted)]"
                        >
                            تومان
                        </span>

                    </div>

                </div>


                {{-- Availability --}}

                @if($isAvailable)

                    <span
                        class="inline-flex shrink-0 items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1.5 text-[9px] font-extrabold text-emerald-700"
                    >

                        <span
                            class="h-1.5 w-1.5 rounded-full bg-emerald-500"
                        ></span>

                        موجود

                    </span>

                @else

                    <span
                        class="inline-flex shrink-0 items-center rounded-full bg-[var(--surface-soft)] px-2.5 py-1.5 text-[9px] font-extrabold text-[var(--text-muted)]"
                    >
                        ناموجود
                    </span>

                @endif

            </div>

        </div>

    </div>

</article>
