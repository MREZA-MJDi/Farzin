@php
    $isEdit = $product !== null;

    $existingImages = $isEdit
        ? $product->images
            ->sortBy([
                ['is_primary', 'desc'],
                ['sort_order', 'asc'],
                ['id', 'asc'],
            ])
            ->values()
        : collect();
@endphp

<div class="space-y-6">

    {{-- =========================================================
        BASIC INFORMATION
    ========================================================== --}}
    <section class="rounded-2xl border border-[var(--color-border)] bg-white p-5 shadow-sm sm:p-6">

        <div class="mb-6">

            <div class="flex items-start gap-3">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[var(--color-brand-50)] text-[var(--color-brand-700)]">
                    <svg
                        class="h-5 w-5"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.7"
                        aria-hidden="true"
                    >
                        <path d="M20 7 12 3 4 7l8 4 8-4Z"/>
                        <path d="m4 12 8 4 8-4"/>
                        <path d="m4 17 8 4 8-4"/>
                    </svg>
                </div>

                <div>
                    <h2 class="text-base font-black text-[var(--color-text-primary)] sm:text-lg">
                        اطلاعات اصلی
                    </h2>

                    <p class="mt-1 text-xs leading-6 text-[var(--color-text-secondary)]">
                        اطلاعات پایه و مشخصات اصلی محصول را وارد کنید.
                    </p>
                </div>

            </div>

        </div>


        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

            {{-- Name --}}
            <div class="md:col-span-2">

                <label
                    for="name"
                    class="mb-2 block text-xs font-black text-[var(--color-text-primary)] sm:text-sm"
                >
                    نام محصول
                    <span class="text-red-500">*</span>
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $product?->name) }}"
                    placeholder="مثلاً سینک ظرفشویی استیل..."
                    class="w-full rounded-xl border border-[var(--color-border)] bg-white px-4 py-3 text-sm text-[var(--color-text-primary)] outline-none transition placeholder:text-[var(--color-text-muted)] focus:border-[var(--color-brand-600)] focus:ring-4 focus:ring-[var(--color-brand-100)] @error('name') border-red-400 @enderror"
                >

                @error('name')
                <p class="mt-2 text-xs font-medium text-red-600">
                    {{ $message }}
                </p>
                @enderror

            </div>


            {{-- Slug --}}
            <div>

                <label
                    for="slug"
                    class="mb-2 block text-xs font-black text-[var(--color-text-primary)] sm:text-sm"
                >
                    Slug
                </label>

                <input
                    type="text"
                    id="slug"
                    name="slug"
                    value="{{ old('slug', $product?->slug) }}"
                    dir="ltr"
                    placeholder="product-slug"
                    class="w-full rounded-xl border border-[var(--color-border)] bg-white px-4 py-3 text-sm text-[var(--color-text-primary)] outline-none transition placeholder:text-[var(--color-text-muted)] focus:border-[var(--color-brand-600)] focus:bg-white focus:ring-4 focus:ring-[var(--color-brand-100)] @error('slug') border-red-400 @enderror"
                >

                <p class="mt-2 text-[11px] leading-5 text-[var(--color-text-muted)]">
                    در صورت خالی بودن، از نام محصول ساخته می‌شود.
                </p>

                @error('slug')
                <p class="mt-2 text-xs font-medium text-red-600">
                    {{ $message }}
                </p>
                @enderror

            </div>


            {{-- SKU --}}
            <div>

                <label
                    for="sku"
                    class="mb-2 block text-xs font-black text-[var(--color-text-primary)] sm:text-sm"
                >
                    SKU
                    <span class="text-red-500">*</span>
                </label>

                <input
                    type="text"
                    id="sku"
                    name="sku"
                    value="{{ old('sku', $product?->sku) }}"
                    dir="ltr"
                    placeholder="SKU-1001"
                    class="w-full rounded-xl border border-[var(--color-border)] bg-white px-4 py-3 text-sm text-[var(--color-text-primary)] outline-none transition placeholder:text-[var(--color-text-muted)] focus:border-[var(--color-brand-600)] focus:ring-4 focus:ring-[var(--color-brand-100)] @error('sku') border-red-400 @enderror"
                >

                @error('sku')
                <p class="mt-2 text-xs font-medium text-red-600">
                    {{ $message }}
                </p>
                @enderror

            </div>


            {{-- Brand --}}
            <div>

                <label
                    for="brand"
                    class="mb-2 block text-xs font-black text-[var(--color-text-primary)] sm:text-sm"
                >
                    برند
                </label>

                <input
                    type="text"
                    id="brand"
                    name="brand"
                    value="{{ old('brand', $product?->brand) }}"
                    placeholder="مثلاً Bosch"
                    class="w-full rounded-xl border border-[var(--color-border)] bg-white px-4 py-3 text-sm text-[var(--color-text-primary)] outline-none transition placeholder:text-[var(--color-text-muted)] focus:border-[var(--color-brand-600)] focus:ring-4 focus:ring-[var(--color-brand-100)] @error('brand') border-red-400 @enderror"
                >

                @error('brand')
                <p class="mt-2 text-xs font-medium text-red-600">
                    {{ $message }}
                </p>
                @enderror

            </div>


            {{-- Category --}}
            <div>

                <label
                    for="category_id"
                    class="mb-2 block text-xs font-black text-[var(--color-text-primary)] sm:text-sm"
                >
                    دسته‌بندی
                    <span class="text-red-500">*</span>
                </label>

                <select
                    id="category_id"
                    name="category_id"
                    class="w-full rounded-xl border border-[var(--color-border)] bg-white px-4 py-3 text-sm text-[var(--color-text-primary)] outline-none transition focus:border-[var(--color-brand-600)] focus:ring-4 focus:ring-[var(--color-brand-100)] @error('category_id') border-red-400 @enderror"
                >

                    <option value="">
                        انتخاب دسته‌بندی
                    </option>

                    @foreach($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            @selected(
                            (string) old('category_id', $product?->category_id)
                        ===
                        (string) $category->id
                        )
                        >
                        {{ $category->name }}
                        </option>

                    @endforeach

                </select>

                @error('category_id')
                <p class="mt-2 text-xs font-medium text-red-600">
                    {{ $message }}
                </p>
                @enderror

            </div>

        </div>

    </section>


    {{-- =========================================================
        DESCRIPTIONS
    ========================================================== --}}
    <section class="rounded-2xl border border-[var(--color-border)] bg-white p-5 shadow-sm sm:p-6">

        <div class="mb-6">

            <div class="flex items-start gap-3">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[var(--color-neutral-100)] text-[var(--color-text-secondary)]">
                    <svg
                        class="h-5 w-5"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.7"
                        aria-hidden="true"
                    >
                        <path d="M5 4h14v16H5z"/>
                        <path d="M8 8h8M8 12h8M8 16h5"/>
                    </svg>
                </div>

                <div>
                    <h2 class="text-base font-black text-[var(--color-text-primary)] sm:text-lg">
                        توضیحات
                    </h2>

                    <p class="mt-1 text-xs leading-6 text-[var(--color-text-secondary)]">
                        توضیح کوتاه و توضیحات کامل محصول.
                    </p>
                </div>

            </div>

        </div>


        <div class="space-y-5">

            {{-- Short Description --}}
            <div>

                <label
                    for="short_description"
                    class="mb-2 block text-xs font-black text-[var(--color-text-primary)] sm:text-sm"
                >
                    توضیح کوتاه
                </label>

                <textarea
                    id="short_description"
                    name="short_description"
                    rows="4"
                    placeholder="یک توضیح کوتاه و کاربردی برای نمایش در لیست محصولات..."
                    class="w-full resize-y rounded-xl border border-[var(--color-border)] bg-white px-4 py-3 text-sm leading-7 text-[var(--color-text-primary)] outline-none transition placeholder:text-[var(--color-text-muted)] focus:border-[var(--color-brand-600)] focus:ring-4 focus:ring-[var(--color-brand-100)] @error('short_description') border-red-400 @enderror"
                >{{ old('short_description', $product?->short_description) }}</textarea>

                @error('short_description')
                <p class="mt-2 text-xs font-medium text-red-600">
                    {{ $message }}
                </p>
                @enderror

            </div>


            {{-- Description --}}
            <div>

                <label
                    for="description"
                    class="mb-2 block text-xs font-black text-[var(--color-text-primary)] sm:text-sm"
                >
                    توضیحات کامل
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="10"
                    placeholder="توضیحات کامل محصول، ویژگی‌ها، کاربرد، جنس و سایر اطلاعات..."
                    class="w-full resize-y rounded-xl border border-[var(--color-border)] bg-white px-4 py-3 text-sm leading-7 text-[var(--color-text-primary)] outline-none transition placeholder:text-[var(--color-text-muted)] focus:border-[var(--color-brand-600)] focus:ring-4 focus:ring-[var(--color-brand-100)] @error('description') border-red-400 @enderror"
                >{{ old('description', $product?->description) }}</textarea>

                @error('description')
                <p class="mt-2 text-xs font-medium text-red-600">
                    {{ $message }}
                </p>
                @enderror

            </div>

        </div>

    </section>


    {{-- =========================================================
        PRICING & INVENTORY
    ========================================================== --}}
    <section class="rounded-2xl border border-[var(--color-border)] bg-white p-5 shadow-sm sm:p-6">

        <div class="mb-6">

            <div class="flex items-start gap-3">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-700">
                    <svg
                        class="h-5 w-5"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.7"
                        aria-hidden="true"
                    >
                        <path d="M6 4h12"/>
                        <path d="M8 4v4c0 2.2 1.8 4 4 4s4-1.8 4-4V4"/>
                        <path d="M6 20h12"/>
                        <path d="M8 20v-4c0-2.2 1.8-4 4-4s4 1.8 4 4v4"/>
                    </svg>
                </div>

                <div>
                    <h2 class="text-base font-black text-[var(--color-text-primary)] sm:text-lg">
                        قیمت و موجودی
                    </h2>

                    <p class="mt-1 text-xs leading-6 text-[var(--color-text-secondary)]">
                        قیمت‌ها به تومان هستند و جداکننده سه‌رقمی به‌صورت خودکار نمایش داده می‌شود.
                    </p>
                </div>

            </div>

        </div>


        <div
            id="productPricing"
            class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-4"
        >

            {{-- Price --}}
            <div>

                <label
                    for="price_display"
                    class="mb-2 block text-xs font-black text-[var(--color-text-primary)] sm:text-sm"
                >
                    قیمت فروش
                    <span class="text-red-500">*</span>
                </label>

                <div class="relative">

                    <input
                        type="text"
                        id="price_display"
                        inputmode="numeric"
                        autocomplete="off"
                        dir="ltr"
                        value="{{ old('price', $product?->price) !== null && old('price', $product?->price) !== '' ? number_format((int) old('price', $product?->price)) : '' }}"
                        placeholder="1,000,000"
                        class="w-full rounded-xl border border-[var(--color-border)] bg-white px-4 py-3 pl-16 text-left text-sm font-bold text-[var(--color-text-primary)] outline-none transition placeholder:text-[var(--color-text-muted)] focus:border-[var(--color-brand-600)] focus:ring-4 focus:ring-[var(--color-brand-100)] @error('price') border-red-400 @enderror"
                    >

                    <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-xs font-bold text-[var(--color-text-muted)]">
                        تومان
                    </span>

                </div>

                <input
                    type="hidden"
                    id="price"
                    name="price"
                    value="{{ old('price', $product?->price) }}"
                >

                @error('price')
                <p class="mt-2 text-xs font-medium text-red-600">
                    {{ $message }}
                </p>
                @enderror

            </div>


            {{-- Old Price --}}
            <div>

                <label
                    for="old_price_display"
                    class="mb-2 block text-xs font-black text-[var(--color-text-primary)] sm:text-sm"
                >
                    قیمت قبل
                </label>

                <div class="relative">

                    <input
                        type="text"
                        id="old_price_display"
                        inputmode="numeric"
                        autocomplete="off"
                        dir="ltr"
                        value="{{ old('old_price', $product?->old_price) !== null && old('old_price', $product?->old_price) !== '' ? number_format((int) old('old_price', $product?->old_price)) : '' }}"
                        placeholder="1,200,000"
                        class="w-full rounded-xl border border-[var(--color-border)] bg-white px-4 py-3 pl-16 text-left text-sm font-bold text-[var(--color-text-primary)] outline-none transition placeholder:text-[var(--color-text-muted)] focus:border-[var(--color-brand-600)] focus:ring-4 focus:ring-[var(--color-brand-100)] @error('old_price') border-red-400 @enderror"
                    >

                    <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-xs font-bold text-[var(--color-text-muted)]">
                        تومان
                    </span>

                </div>

                <input
                    type="hidden"
                    id="old_price"
                    name="old_price"
                    value="{{ old('old_price', $product?->old_price) }}"
                >

                <p
                    id="oldPriceHint"
                    class="mt-2 text-[11px] leading-5 text-[var(--color-text-muted)]"
                >
                    برای محاسبه خودکار تخفیف، قیمت قبل را وارد کنید.
                </p>

                @error('old_price')
                <p class="mt-2 text-xs font-medium text-red-600">
                    {{ $message }}
                </p>
                @enderror

            </div>


            {{-- Discount --}}
            <div>

                <label
                    for="discount"
                    class="mb-2 block text-xs font-black text-[var(--color-text-primary)] sm:text-sm"
                >
                    درصد تخفیف
                </label>

                <div class="relative">

                    <input
                        type="number"
                        id="discount"
                        name="discount"
                        min="0"
                        max="100"
                        step="1"
                        inputmode="numeric"
                        value="{{ old('discount', $product?->discount) }}"
                        class="w-full rounded-xl border border-[var(--color-border)] bg-white px-4 py-3 pl-12 text-left text-sm font-bold text-[var(--color-text-primary)] outline-none transition disabled:cursor-not-allowed disabled:bg-[var(--color-neutral-100)] disabled:opacity-70 focus:border-[var(--color-brand-600)] focus:ring-4 focus:ring-[var(--color-brand-100)] @error('discount') border-red-400 @enderror"
                    >

                    <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm font-bold text-[var(--color-text-muted)]">
                        %
                    </span>

                </div>

                <p
                    id="discountHint"
                    class="mt-2 text-[11px] leading-5 text-[var(--color-text-muted)]"
                >
                    با وجود قیمت قبل، تخفیف به‌صورت خودکار محاسبه می‌شود.
                </p>

                @error('discount')
                <p class="mt-2 text-xs font-medium text-red-600">
                    {{ $message }}
                </p>
                @enderror

            </div>


            {{-- Stock --}}
            <div>

                <label
                    for="stock"
                    class="mb-2 block text-xs font-black text-[var(--color-text-primary)] sm:text-sm"
                >
                    موجودی
                    <span class="text-red-500">*</span>
                </label>

                <input
                    type="number"
                    min="0"
                    step="1"
                    id="stock"
                    name="stock"
                    value="{{ old('stock', $product?->stock ?? 0) }}"
                    placeholder="0"
                    class="w-full rounded-xl border border-[var(--color-border)] bg-white px-4 py-3 text-sm text-[var(--color-text-primary)] outline-none transition placeholder:text-[var(--color-text-muted)] focus:border-[var(--color-brand-600)] focus:ring-4 focus:ring-[var(--color-brand-100)] @error('stock') border-red-400 @enderror"
                >

                @error('stock')
                <p class="mt-2 text-xs font-medium text-red-600">
                    {{ $message }}
                </p>
                @enderror

            </div>

        </div>

    </section>


    {{-- =========================================================
        PRODUCT GALLERY
    ========================================================== --}}
    <section class="rounded-2xl border border-[var(--color-border)] bg-white p-5 shadow-sm sm:p-6">

        <div class="mb-6">

            <div class="flex items-start gap-3">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[var(--color-accent-50)] text-[var(--color-accent-700)]">
                    <svg
                        class="h-5 w-5"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.7"
                        aria-hidden="true"
                    >
                        <rect x="3" y="4" width="18" height="16" rx="2"/>
                        <circle cx="8.5" cy="9" r="1.5"/>
                        <path d="m21 15-5-5-4 4-2-2-7 7"/>
                    </svg>
                </div>

                <div>
                    <h2 class="text-base font-black text-[var(--color-text-primary)] sm:text-lg">
                        گالری تصاویر
                    </h2>

                    <p class="mt-1 text-xs leading-6 text-[var(--color-text-secondary)]">
                        چند تصویر برای محصول انتخاب کنید. در حالت ایجاد، اولین تصویر به‌صورت خودکار تصویر اصلی می‌شود.
                    </p>
                </div>

            </div>

        </div>


        {{-- Upload area --}}
        <div
            id="imageUploadArea"
            class="group relative rounded-2xl border-2 border-dashed border-[var(--color-border-strong)] bg-[var(--color-neutral-50)] p-5 transition hover:border-[var(--color-brand-400)] hover:bg-[var(--color-brand-50)]/40 sm:p-6"
        >

            <input
                type="file"
                id="images"
                name="images[]"
                multiple
                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                class="sr-only"
            >

            <label
                for="images"
                class="flex cursor-pointer flex-col items-center justify-center text-center"
            >

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-[var(--color-brand-700)] shadow-sm ring-1 ring-[var(--color-border)] transition group-hover:scale-105">

                    <svg
                        class="h-6 w-6"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.7"
                        aria-hidden="true"
                    >
                        <path d="M12 16V4"/>
                        <path d="m7 9 5-5 5 5"/>
                        <path d="M4 20h16"/>
                    </svg>

                </div>

                <span class="mt-3 text-sm font-black text-[var(--color-text-primary)]">
                    انتخاب تصاویر محصول
                </span>

                <span class="mt-1.5 max-w-md text-[11px] leading-5 text-[var(--color-text-muted)]">
                    چند تصویر را همزمان انتخاب کنید یا تصاویر را اینجا بکشید.
                    JPG، JPEG، PNG و WEBP تا حداکثر ۵MB برای هر تصویر.
                </span>

                <span class="mt-3 inline-flex items-center rounded-lg bg-white px-3 py-1.5 text-[10px] font-black text-[var(--color-text-secondary)] shadow-sm ring-1 ring-[var(--color-border)]">
                    انتخاب فایل
                </span>

            </label>

        </div>


        @error('images')
        <p class="mt-2 text-xs font-medium text-red-600">
            {{ $message }}
        </p>
        @enderror

        @error('images.*')
        <p class="mt-2 text-xs font-medium text-red-600">
            {{ $message }}
        </p>
        @enderror


        {{-- New image previews --}}
        <div
            id="newImagesSection"
            class="mt-6 hidden"
        >

            <div class="mb-3 flex items-center justify-between gap-3">

                <div>
                    <h3 class="text-xs font-black text-[var(--color-text-primary)] sm:text-sm">
                        تصاویر جدید
                    </h3>

                    <p class="mt-1 text-[10px] text-[var(--color-text-muted)]">
                        با حذف هر مورد، فایل نیز از ارسال نهایی حذف می‌شود.
                    </p>
                </div>

                <span
                    id="newImagesCount"
                    class="rounded-full bg-[var(--color-brand-50)] px-2.5 py-1 text-[10px] font-black text-[var(--color-brand-700)]"
                >
                    ۰ تصویر
                </span>

            </div>


            <div
                id="newImagesPreview"
                class="grid grid-cols-2 gap-3 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5"
            ></div>

        </div>


        {{-- Existing images --}}
        @if($isEdit)

            <div class="mt-7 border-t border-[var(--color-border)] pt-6">

                <div class="mb-4 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">

                    <div>
                        <h3 class="text-xs font-black text-[var(--color-text-primary)] sm:text-sm">
                            تصاویر فعلی محصول
                        </h3>

                        <p class="mt-1 text-[10px] leading-5 text-[var(--color-text-muted)]">
                            می‌توانید تصویر اصلی را تغییر دهید یا تصاویر قبلی را حذف کنید.
                        </p>
                    </div>

                    <span
                        id="existingImagesCount"
                        class="self-start rounded-full bg-[var(--color-neutral-100)] px-2.5 py-1 text-[10px] font-black text-[var(--color-text-secondary)]"
                    >
                        {{ $existingImages->count() }} تصویر
                    </span>

                </div>


                <div
                    id="existingImagesGrid"
                    class="grid grid-cols-2 gap-3 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5"
                >

                    @forelse($existingImages as $image)

                        <article
                            id="productImageCard-{{ $image->id }}"
                            data-image-card="{{ $image->id }}"
                            class="group overflow-hidden rounded-2xl border border-[var(--color-border)] bg-[var(--color-neutral-50)] transition hover:border-[var(--color-brand-300)] hover:shadow-sm"
                        >

                            <div class="relative aspect-square overflow-hidden bg-white">

                                <img
                                    src="{{ asset('storage/' . ltrim($image->image, '/')) }}"
                                    alt="{{ $image->alt ?: $product->name }}"
                                    class="h-full w-full object-cover transition duration-300 group-hover:scale-[1.02]"
                                >


                                @if($image->is_primary)

                                    <span
                                        class="absolute right-2 top-2 rounded-full bg-[var(--color-brand-700)] px-2 py-1 text-[9px] font-black text-white shadow-sm"
                                    >
                                        تصویر اصلی
                                    </span>

                                @endif

                            </div>


                            <div class="space-y-2 p-3">

                                {{-- Set primary --}}
                                @if(!$image->is_primary)

                                    <button
                                        type="button"
                                        onclick="setPrimaryProductImage({{ $image->id }})"
                                        class="flex h-9 w-full items-center justify-center gap-1.5 rounded-lg border border-[var(--color-border)] bg-white px-2 text-[10px] font-black text-[var(--color-text-secondary)] transition hover:border-[var(--color-brand-300)] hover:bg-[var(--color-brand-50)] hover:text-[var(--color-brand-700)]"
                                    >

                                        <svg
                                            class="h-3.5 w-3.5"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.7"
                                            aria-hidden="true"
                                        >
                                            <path d="m12 3 2.7 5.5 6.1.9-4.4 4.3-5.4 2.9-5.4-2.9 1-6.1-4.4-4.3 6.1-.9L12 3Z"/>
                                        </svg>

                                        انتخاب به‌عنوان اصلی

                                    </button>

                                @else

                                    <div
                                        class="flex h-9 w-full items-center justify-center gap-1.5 rounded-lg bg-[var(--color-brand-50)] px-2 text-[10px] font-black text-[var(--color-brand-700)]"
                                    >

                                        <svg
                                            class="h-3.5 w-3.5"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.7"
                                            aria-hidden="true"
                                        >
                                            <path d="m12 3 2.7 5.5 6.1.9-4.4 4.3-5.4 2.9-5.4-2.9 1-6.1-4.4-4.3 6.1-.9L12 3Z"/>
                                        </svg>

                                        تصویر اصلی

                                    </div>

                                @endif


                                {{-- Delete --}}
                                <button
                                    type="button"
                                    onclick="deleteProductImage({{ $image->id }})"
                                    class="flex h-9 w-full items-center justify-center gap-1.5 rounded-lg border border-red-200 bg-red-50 px-2 text-[10px] font-black text-red-600 transition hover:bg-red-100"
                                >
                                    <svg
                                        class="h-3.5 w-3.5"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.7"
                                        aria-hidden="true"
                                    >
                                        <path d="M4 7h16"/>
                                        <path d="M10 11v6M14 11v6"/>
                                        <path d="M6 7l1 13h10l1-13"/>
                                        <path d="M9 7V4h6v3"/>
                                    </svg>

                                    حذف تصویر
                                </button>
                            </div>

                        </article>

                    @empty

                        <div class="col-span-full rounded-2xl border border-dashed border-[var(--color-border-strong)] px-5 py-10 text-center">

                            <div class="mx-auto flex h-11 w-11 items-center justify-center rounded-xl bg-[var(--color-neutral-100)] text-[var(--color-neutral-500)]">

                                <svg
                                    class="h-5 w-5"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                    aria-hidden="true"
                                >
                                    <rect x="3" y="4" width="18" height="16" rx="2"/>
                                    <circle cx="8.5" cy="9" r="1.5"/>
                                    <path d="m21 15-5-5-4 4-2-2-7 7"/>
                                </svg>

                            </div>

                            <p class="mt-3 text-xs font-black text-[var(--color-text-primary)]">
                                هنوز تصویری برای این محصول ثبت نشده است.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

        @endif

    </section>


    {{-- =========================================================
        SEO
    ========================================================== --}}
    <section class="rounded-2xl border border-[var(--color-border)] bg-white p-5 shadow-sm sm:p-6">

        <div class="mb-6">

            <div class="flex items-start gap-3">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-indigo-700">

                    <svg
                        class="h-5 w-5"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.7"
                        aria-hidden="true"
                    >
                        <circle cx="12" cy="12" r="8"/>
                        <path d="M4 12h16"/>
                        <path d="M12 4c2.2 2.2 3.3 4.9 3.3 8S14.2 17.8 12 20c-2.2-2.2-3.3-4.9-3.3-8S9.8 6.2 12 4Z"/>
                    </svg>

                </div>

                <div>

                    <h2 class="text-base font-black text-[var(--color-text-primary)] sm:text-lg">
                        SEO
                    </h2>

                    <p class="mt-1 text-xs leading-6 text-[var(--color-text-secondary)]">
                        اطلاعاتی که برای موتورهای جستجو استفاده می‌شوند.
                    </p>

                </div>

            </div>

        </div>


        <div class="space-y-5">

            {{-- Meta title --}}
            <div>

                <label
                    for="meta_title"
                    class="mb-2 block text-xs font-black text-[var(--color-text-primary)] sm:text-sm"
                >
                    Meta Title
                </label>

                <input
                    type="text"
                    id="meta_title"
                    name="meta_title"
                    value="{{ old('meta_title', $product?->meta_title) }}"
                    placeholder="عنوان مناسب برای نتایج جستجو..."
                    class="w-full rounded-xl border border-[var(--color-border)] bg-white px-4 py-3 text-sm text-[var(--color-text-primary)] outline-none transition placeholder:text-[var(--color-text-muted)] focus:border-[var(--color-brand-600)] focus:ring-4 focus:ring-[var(--color-brand-100)] @error('meta_title') border-red-400 @enderror"
                >

                @error('meta_title')
                <p class="mt-2 text-xs font-medium text-red-600">
                    {{ $message }}
                </p>
                @enderror

            </div>


            {{-- Meta description --}}
            <div>

                <label
                    for="meta_description"
                    class="mb-2 block text-xs font-black text-[var(--color-text-primary)] sm:text-sm"
                >
                    Meta Description
                </label>

                <textarea
                    id="meta_description"
                    name="meta_description"
                    rows="4"
                    placeholder="توضیح کوتاه و جذاب برای نمایش در نتایج جستجو..."
                    class="w-full resize-y rounded-xl border border-[var(--color-border)] bg-white px-4 py-3 text-sm leading-7 text-[var(--color-text-primary)] outline-none transition placeholder:text-[var(--color-text-muted)] focus:border-[var(--color-brand-600)] focus:ring-4 focus:ring-[var(--color-brand-100)] @error('meta_description') border-red-400 @enderror"
                >{{ old('meta_description', $product?->meta_description) }}</textarea>

                @error('meta_description')
                <p class="mt-2 text-xs font-medium text-red-600">
                    {{ $message }}
                </p>
                @enderror

            </div>


            {{-- Canonical --}}
            <div>

                <label
                    for="canonical_url"
                    class="mb-2 block text-xs font-black text-[var(--color-text-primary)] sm:text-sm"
                >
                    Canonical URL
                </label>

                <input
                    type="url"
                    id="canonical_url"
                    name="canonical_url"
                    value="{{ old('canonical_url', $product?->canonical_url) }}"
                    dir="ltr"
                    placeholder="https://example.com/products/..."
                    class="w-full rounded-xl border border-[var(--color-border)] bg-white px-4 py-3 text-sm text-[var(--color-text-primary)] outline-none transition placeholder:text-[var(--color-text-muted)] focus:border-[var(--color-brand-600)] focus:ring-4 focus:ring-[var(--color-brand-100)] @error('canonical_url') border-red-400 @enderror"
                >

                @error('canonical_url')
                <p class="mt-2 text-xs font-medium text-red-600">
                    {{ $message }}
                </p>
                @enderror

            </div>


            {{-- Noindex --}}
            <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-[var(--color-border)] bg-[var(--color-neutral-50)] p-4 transition hover:bg-[var(--color-neutral-100)]">

                <input
                    type="hidden"
                    name="noindex"
                    value="0"
                >

                <input
                    type="checkbox"
                    name="noindex"
                    value="1"
                    @checked(old('noindex', $product?->noindex ?? false))
                class="mt-0.5 h-4.5 w-4.5 rounded border-[var(--color-border)] text-[var(--color-brand-600)] focus:ring-[var(--color-brand-600)]"
                >

                <span>

                    <span class="block text-xs font-black text-[var(--color-text-primary)] sm:text-sm">
                        عدم ایندکس
                    </span>

                    <span class="mt-1 block text-[11px] leading-5 text-[var(--color-text-muted)]">
                        صفحه محصول در موتورهای جستجو ایندکس نشود.
                    </span>

                </span>

            </label>

            @error('noindex')
            <p class="text-xs font-medium text-red-600">
                {{ $message }}
            </p>
            @enderror

        </div>

    </section>


    {{-- =========================================================
        STATUS
    ========================================================== --}}
    <section class="rounded-2xl border border-[var(--color-border)] bg-white p-5 shadow-sm sm:p-6">

        <div class="mb-6">

            <div class="flex items-start gap-3">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[var(--color-neutral-100)] text-[var(--color-text-secondary)]">

                    <svg
                        class="h-5 w-5"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.7"
                        aria-hidden="true"
                    >
                        <path d="M4 12h16"/>
                        <path d="M12 4v16"/>
                    </svg>

                </div>

                <div>

                    <h2 class="text-base font-black text-[var(--color-text-primary)] sm:text-lg">
                        وضعیت نمایش
                    </h2>

                    <p class="mt-1 text-xs leading-6 text-[var(--color-text-secondary)]">
                        وضعیت انتشار و نمایش محصول در فروشگاه.
                    </p>

                </div>

            </div>

        </div>


        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

            {{-- Active --}}
            <label class="flex cursor-pointer items-center justify-between gap-4 rounded-xl border border-[var(--color-border)] bg-white p-4 transition hover:bg-[var(--color-neutral-50)]">

                <div>

                    <div class="text-xs font-black text-[var(--color-text-primary)] sm:text-sm">
                        محصول فعال باشد
                    </div>

                    <div class="mt-1 text-[11px] leading-5 text-[var(--color-text-muted)]">
                        محصول در فروشگاه قابل مشاهده باشد.
                    </div>

                </div>

                <div class="shrink-0">

                    <input
                        type="hidden"
                        name="is_active"
                        value="0"
                    >

                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        @checked(old('is_active', $product?->is_active ?? true))
                    class="h-5 w-5 rounded border-[var(--color-border)] text-[var(--color-brand-600)] focus:ring-[var(--color-brand-600)]"
                    >

                </div>

            </label>


            {{-- Featured --}}
            <label class="flex cursor-pointer items-center justify-between gap-4 rounded-xl border border-[var(--color-border)] bg-white p-4 transition hover:bg-[var(--color-neutral-50)]">

                <div>

                    <div class="text-xs font-black text-[var(--color-text-primary)] sm:text-sm">
                        محصول ویژه باشد
                    </div>

                    <div class="mt-1 text-[11px] leading-5 text-[var(--color-text-muted)]">
                        در بخش محصولات ویژه نمایش داده شود.
                    </div>

                </div>

                <div class="shrink-0">

                    <input
                        type="hidden"
                        name="is_featured"
                        value="0"
                    >

                    <input
                        type="checkbox"
                        name="is_featured"
                        value="1"
                        @checked(old('is_featured', $product?->is_featured ?? false))
                    class="h-5 w-5 rounded border-[var(--color-border)] text-[var(--color-brand-600)] focus:ring-[var(--color-brand-600)]"
                    >

                </div>

            </label>

        </div>

    </section>


    {{-- =========================================================
        FORM ACTIONS
    ========================================================== --}}
    <div class="flex flex-col-reverse gap-3 rounded-2xl border border-[var(--color-border)] bg-white p-4 shadow-sm sm:flex-row sm:justify-end sm:p-5">

        <a
            href="{{ route('admin.products.index') }}"
            class="inline-flex h-11 items-center justify-center rounded-xl border border-[var(--color-border)] bg-white px-6 text-xs font-black text-[var(--color-text-primary)] transition hover:bg-[var(--color-neutral-50)]"
        >
            انصراف
        </a>

        <button
            type="submit"
            class="inline-flex h-11 items-center justify-center gap-2 rounded-xl bg-[var(--color-brand-600)] px-7 text-xs font-black text-white shadow-sm transition hover:bg-[var(--color-brand-700)] focus:outline-none focus:ring-4 focus:ring-[var(--color-brand-100)]"
        >

            <svg
                class="h-4 w-4"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                aria-hidden="true"
            >
                <path d="M5 12h14"/>
                <path d="m13 6 6 6-6 6"/>
            </svg>

            {{ $submitLabel }}

        </button>

    </div>

</div>


{{-- =============================================================
    JAVASCRIPT
============================================================= --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

        /*
        |--------------------------------------------------------------------------
        | Pricing
        |--------------------------------------------------------------------------
        */

        const priceDisplay =
            document.getElementById('price_display');

        const priceHidden =
            document.getElementById('price');

        const oldPriceDisplay =
            document.getElementById('old_price_display');

        const oldPriceHidden =
            document.getElementById('old_price');

        const discountInput =
            document.getElementById('discount');

        const discountHint =
            document.getElementById('discountHint');

        const oldPriceHint =
            document.getElementById('oldPriceHint');


        function parseMoney(value) {

            if (!value) {
                return 0;
            }

            const normalized = String(value)
                .replace(/,/g, '')
                .replace(/\s/g, '')
                .replace(/[^\d]/g, '');

            return parseInt(normalized, 10) || 0;
        }


        function formatMoney(value) {

            const number = parseMoney(value);

            return number
                ? number.toLocaleString('en-US')
                : '';
        }


        if (
            priceDisplay &&
            priceHidden &&
            oldPriceDisplay &&
            oldPriceHidden &&
            discountInput &&
            discountHint &&
            oldPriceHint
        ) {

            function syncMoney(displayInput, hiddenInput) {

                const value =
                    parseMoney(displayInput.value);

                hiddenInput.value =
                    value || '';

                displayInput.value =
                    value
                        ? formatMoney(value)
                        : '';
            }


            function setManualDiscountMode(message = null) {

                discountInput.disabled = false;

                discountHint.textContent =
                    message ||
                    'قیمت قبل خالی است؛ درصد تخفیف را می‌توانید دستی وارد کنید.';

                discountHint.className =
                    'mt-2 text-[11px] leading-5 text-[var(--color-text-muted)]';
            }


            function setAutomaticDiscountMode() {

                discountInput.disabled = true;

                discountHint.textContent =
                    'درصد تخفیف بر اساس قیمت فروش و قیمت قبل محاسبه شده است.';

                discountHint.className =
                    'mt-2 text-[11px] leading-5 text-emerald-600';
            }


            function calculateDiscountFromPrices() {

                const price =
                    parseMoney(priceDisplay.value);

                const oldPrice =
                    parseMoney(oldPriceDisplay.value);


                if (!price || !oldPrice) {

                    setManualDiscountMode();

                    oldPriceHint.textContent =
                        'با وارد کردن درصد تخفیف، قیمت قبل خودکار محاسبه می‌شود.';

                    oldPriceHint.className =
                        'mt-2 text-[11px] leading-5 text-[var(--color-text-muted)]';

                    return;
                }


                if (oldPrice <= price) {

                    setManualDiscountMode(
                        'قیمت قبل باید بیشتر از قیمت فروش باشد.'
                    );

                    discountHint.className =
                        'mt-2 text-[11px] leading-5 text-red-600';

                    oldPriceHint.textContent =
                        'قیمت قبل باید بزرگ‌تر از قیمت فروش باشد.';

                    oldPriceHint.className =
                        'mt-2 text-[11px] leading-5 text-red-600';

                    return;
                }


                const discount =
                    Math.round(
                        ((oldPrice - price) / oldPrice) * 100
                    );


                discountInput.value =
                    discount;

                setAutomaticDiscountMode();

                oldPriceHint.textContent =
                    'با تغییر قیمت قبل، درصد تخفیف نیز خودکار تغییر می‌کند.';

                oldPriceHint.className =
                    'mt-2 text-[11px] leading-5 text-[var(--color-text-muted)]';
            }


            function calculateOldPriceFromDiscount() {

                const price =
                    parseMoney(priceDisplay.value);

                let discount =
                    parseInt(
                        discountInput.value,
                        10
                    );


                if (isNaN(discount)) {
                    discount = 0;
                }


                discount = Math.max(
                    0,
                    Math.min(99, discount)
                );


                discountInput.value =
                    discount || '';


                if (!price) {

                    oldPriceHidden.value = '';
                    oldPriceDisplay.value = '';

                    discountHint.textContent =
                        'ابتدا قیمت فروش را وارد کنید.';

                    discountHint.className =
                        'mt-2 text-[11px] leading-5 text-red-600';

                    return;
                }


                if (discount <= 0) {

                    oldPriceHidden.value = '';
                    oldPriceDisplay.value = '';

                    discountHint.textContent =
                        'درصد تخفیف را وارد کنید تا قیمت قبل محاسبه شود.';

                    discountHint.className =
                        'mt-2 text-[11px] leading-5 text-[var(--color-text-muted)]';

                    return;
                }


                const calculatedOldPrice =
                    Math.round(
                        price / (1 - (discount / 100))
                    );


                oldPriceDisplay.value =
                    formatMoney(calculatedOldPrice);

                oldPriceHidden.value =
                    calculatedOldPrice;


                oldPriceHint.textContent =
                    'قیمت قبل بر اساس درصد تخفیف محاسبه شده است.';

                oldPriceHint.className =
                    'mt-2 text-[11px] leading-5 text-emerald-600';

                discountHint.textContent =
                    'درصد تخفیف دستی ثبت شده و قیمت قبل بر اساس آن محاسبه شده است.';

                discountHint.className =
                    'mt-2 text-[11px] leading-5 text-emerald-600';
            }


            priceDisplay.addEventListener(
                'input',
                function () {

                    const value =
                        parseMoney(this.value);

                    priceHidden.value =
                        value || '';

                    this.value =
                        value
                            ? formatMoney(value)
                            : '';


                    if (
                        parseMoney(oldPriceDisplay.value) > 0
                    ) {

                        calculateDiscountFromPrices();

                    } else if (
                        parseInt(discountInput.value, 10) > 0
                    ) {

                        calculateOldPriceFromDiscount();

                    }

                }
            );


            oldPriceDisplay.addEventListener(
                'input',
                function () {

                    const value =
                        parseMoney(this.value);

                    oldPriceHidden.value =
                        value || '';

                    this.value =
                        value
                            ? formatMoney(value)
                            : '';


                    if (!value) {

                        setManualDiscountMode();

                        oldPriceHint.textContent =
                            'با وارد کردن درصد تخفیف، قیمت قبل خودکار محاسبه می‌شود.';

                        oldPriceHint.className =
                            'mt-2 text-[11px] leading-5 text-[var(--color-text-muted)]';

                        return;
                    }


                    calculateDiscountFromPrices();

                }
            );


            discountInput.addEventListener(
                'input',
                function () {

                    let discount =
                        parseInt(this.value, 10);

                    if (isNaN(discount)) {
                        discount = 0;
                    }

                    discount =
                        Math.max(
                            0,
                            Math.min(99, discount)
                        );

                    this.value =
                        discount || '';


                    if (
                        parseMoney(oldPriceDisplay.value) > 0
                    ) {

                        calculateDiscountFromPrices();

                        return;
                    }


                    calculateOldPriceFromDiscount();

                }
            );


            syncMoney(
                priceDisplay,
                priceHidden
            );

            syncMoney(
                oldPriceDisplay,
                oldPriceHidden
            );


            const initialOldPrice =
                parseMoney(oldPriceDisplay.value);

            const initialDiscount =
                parseInt(discountInput.value, 10) || 0;


            if (initialOldPrice > 0) {

                calculateDiscountFromPrices();

            } else if (initialDiscount > 0) {

                discountInput.disabled = false;

                oldPriceHint.textContent =
                    'قیمت قبل بر اساس تخفیف قابل محاسبه است.';

            } else {

                setManualDiscountMode();

            }

        }


        /*
        |--------------------------------------------------------------------------
        | Product Images - New uploads
        |--------------------------------------------------------------------------
        */

        const imageInput =
            document.getElementById('images');

        const uploadArea =
            document.getElementById('imageUploadArea');

        const previewContainer =
            document.getElementById('newImagesPreview');

        const previewSection =
            document.getElementById('newImagesSection');

        const previewCount =
            document.getElementById('newImagesCount');


        if (
            imageInput &&
            previewContainer &&
            previewSection &&
            previewCount
        ) {

            let selectedFiles = [];


            function syncInputFiles() {

                const dataTransfer =
                    new DataTransfer();

                selectedFiles.forEach(function (file) {
                    dataTransfer.items.add(file);
                });

                imageInput.files =
                    dataTransfer.files;
            }


            function renderImagePreviews() {

                previewContainer.innerHTML = '';


                if (!selectedFiles.length) {

                    previewSection.classList.add('hidden');

                    previewCount.textContent =
                        '۰ تصویر';

                    return;
                }


                previewSection.classList.remove('hidden');


                previewCount.textContent =
                    `${selectedFiles.length.toLocaleString('fa-IR')} تصویر`;


                selectedFiles.forEach(function (file, index) {

                    const card =
                        document.createElement('div');


                    card.className =
                        'overflow-hidden rounded-2xl border border-[var(--color-border)] bg-[var(--color-neutral-50)]';


                    const imageWrapper =
                        document.createElement('div');


                    imageWrapper.className =
                        'relative aspect-square overflow-hidden bg-white';


                    const image =
                        document.createElement('img');


                    image.className =
                        'h-full w-full object-cover';


                    const removeButton =
                        document.createElement('button');


                    removeButton.type =
                        'button';

                    removeButton.className =
                        'absolute left-2 top-2 flex h-8 w-8 items-center justify-center rounded-lg bg-black/75 text-white transition hover:bg-red-600';

                    removeButton.setAttribute(
                        'aria-label',
                        'حذف تصویر'
                    );


                    removeButton.innerHTML = `
                        <svg
                            class="h-4 w-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path d="M6 6l12 12"/>
                            <path d="M18 6 6 18"/>
                        </svg>
                    `;


                    const badge =
                        document.createElement('span');


                    badge.className =
                        'absolute right-2 top-2 rounded-full bg-[var(--color-brand-700)] px-2 py-1 text-[9px] font-black text-white shadow-sm';


                    badge.textContent =
                        index === 0
                            ? 'تصویر اول'
                            : `تصویر ${index + 1}`;


                    const info =
                        document.createElement('div');


                    info.className =
                        'space-y-1 p-3';


                    const fileName =
                        document.createElement('div');


                    fileName.className =
                        'truncate text-[10px] font-black text-[var(--color-text-primary)]';


                    fileName.textContent =
                        file.name;


                    const fileSize =
                        document.createElement('div');


                    fileSize.className =
                        'text-[9px] text-[var(--color-text-muted)]';


                    fileSize.textContent =
                        `${(file.size / 1024 / 1024).toFixed(2)} MB`;


                    info.appendChild(fileName);
                    info.appendChild(fileSize);


                    imageWrapper.appendChild(image);
                    imageWrapper.appendChild(removeButton);
                    imageWrapper.appendChild(badge);


                    card.appendChild(imageWrapper);
                    card.appendChild(info);


                    previewContainer.appendChild(card);


                    const reader =
                        new FileReader();


                    reader.onload = function (event) {

                        image.src =
                            event.target.result;

                    };


                    reader.readAsDataURL(file);


                    removeButton.addEventListener(
                        'click',
                        function () {

                            selectedFiles.splice(
                                index,
                                1
                            );

                            syncInputFiles();

                            renderImagePreviews();

                        }
                    );

                });

            }


            function addFiles(files) {

                const incoming =
                    Array.from(files || []);


                const validFiles =
                    incoming.filter(function (file) {

                        const validTypes = [
                            'image/jpeg',
                            'image/png',
                            'image/webp',
                        ];

                        const maxSize =
                            5 * 1024 * 1024;


                        return (
                            validTypes.includes(file.type) &&
                            file.size <= maxSize
                        );

                    });


                validFiles.forEach(function (file) {

                    const duplicate =
                        selectedFiles.some(function (existing) {

                            return (
                                existing.name === file.name &&
                                existing.size === file.size &&
                                existing.lastModified === file.lastModified
                            );

                        });


                    if (!duplicate) {
                        selectedFiles.push(file);
                    }

                });


                syncInputFiles();

                renderImagePreviews();

            }


            imageInput.addEventListener(
                'change',
                function () {

                    addFiles(this.files);

                }
            );


            /*
            |--------------------------------------------------------------------------
            | Drag & Drop
            |--------------------------------------------------------------------------
            */

            if (uploadArea) {

                ['dragenter', 'dragover'].forEach(
                    function (eventName) {

                        uploadArea.addEventListener(
                            eventName,
                            function (event) {

                                event.preventDefault();
                                event.stopPropagation();

                                uploadArea.classList.add(
                                    'border-[var(--color-brand-500)]',
                                    'bg-[var(--color-brand-50)]'
                                );

                            }
                        );

                    }
                );


                ['dragleave', 'drop'].forEach(
                    function (eventName) {

                        uploadArea.addEventListener(
                            eventName,
                            function (event) {

                                event.preventDefault();
                                event.stopPropagation();

                                uploadArea.classList.remove(
                                    'border-[var(--color-brand-500)]',
                                    'bg-[var(--color-brand-50)]'
                                );

                            }
                        );

                    }
                );


                uploadArea.addEventListener(
                    'drop',
                    function (event) {

                        addFiles(
                            event.dataTransfer.files
                        );

                    }
                );

            }

        }

    });



    function getCsrfToken() {

        const metaToken =
            document
                .querySelector('meta[name="csrf-token"]')
                ?.getAttribute('content');


        return metaToken || @json(csrf_token());

    }


    function submitImageAction(
        action,
        method
    ) {

        const form =
            document.createElement('form');


        form.method =
            'POST';


        form.action =
            action;


        form.style.display =
            'none';


        const csrfInput =
            document.createElement('input');


        csrfInput.type =
            'hidden';


        csrfInput.name =
            '_token';


        csrfInput.value =
            getCsrfToken();


        const methodInput =
            document.createElement('input');


        methodInput.type =
            'hidden';


        methodInput.name =
            '_method';


        methodInput.value =
            method;


        form.appendChild(
            csrfInput
        );


        form.appendChild(
            methodInput
        );


        document.body.appendChild(
            form
        );


        form.submit();

    }


        function deleteProductImage(imageId) {

        if (!imageId) {
        return;
    }

        if (!confirm('آیا از حذف این تصویر مطمئن هستید؟')) {
        return;
    }

        const form = document.createElement('form');

        form.method = 'POST';

        form.action = @json(
            route(
                'admin.product-images.destroy',
                '__IMAGE_ID__'
            )
        ).replace(
        '__IMAGE_ID__',
        String(imageId)
        );

        form.style.display = 'none';


        const token = document.createElement('input');

        token.type = 'hidden';
        token.name = '_token';
        token.value = @json(csrf_token());


        const method = document.createElement('input');

        method.type = 'hidden';
        method.name = '_method';
        method.value = 'DELETE';


        form.appendChild(token);
        form.appendChild(method);

        document.body.appendChild(form);

        form.submit();
    }

    function setPrimaryProductImage(imageId) {

        if (!imageId) {
            return;
        }


        const confirmed =
            window.confirm(
                'آیا این تصویر به‌عنوان تصویر اصلی انتخاب شود؟'
            );


        if (!confirmed) {
            return;
        }


        const action =
        @json(route('admin.product-images.primary', '__IMAGE_ID__'))
    .replace(
            '__IMAGE_ID__',
            String(imageId)
        );


        submitImageAction(
            action,
            'PATCH'
        );

    }
</script>

