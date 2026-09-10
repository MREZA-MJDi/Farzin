@props([
'categories' => [],
'brands' => [],
'availability' => [],
])

<aside
    class="filters"
    aria-label="فیلتر محصولات"
>

    <div class="filters__header">

        <h2 class="filters__title">
            فیلترها
        </h2>

        <a
            href="{{ url()->current() }}"
            class="btn btn--ghost btn--sm"
        >
            حذف فیلترها
        </a>

    </div>


    @if(count($categories))

        <section class="filters__group">

            <h3 class="filters__group-title">
                دسته‌بندی
            </h3>

            <div class="filters__options">

                @foreach($categories as $category)

                    <label class="choice">

                        <input
                            type="checkbox"
                            class="choice__input"
                            name="category[]"
                            value="{{ $category['value'] ?? $category }}"
                            form="shop-filters-form"
                        >

                        <span class="choice__control"></span>

                        <span class="choice__label">
                            {{ $category['label'] ?? $category }}
                        </span>

                    </label>

                @endforeach

            </div>

        </section>

    @endif


    @if(count($brands))

        <section class="filters__group">

            <h3 class="filters__group-title">
                برند
            </h3>

            <div class="filters__options">

                @foreach($brands as $brand)

                    <label class="choice">

                        <input
                            type="checkbox"
                            class="choice__input"
                            name="brand[]"
                            value="{{ $brand['value'] ?? $brand }}"
                            form="shop-filters-form"
                        >

                        <span class="choice__control"></span>

                        <span class="choice__label">
                            {{ $brand['label'] ?? $brand }}
                        </span>

                    </label>

                @endforeach

            </div>

        </section>

    @endif


    @if(count($availability))

        <section class="filters__group">

            <h3 class="filters__group-title">
                وضعیت موجودی
            </h3>

            <div class="filters__options">

                @foreach($availability as $item)

                    <label class="choice">

                        <input
                            type="checkbox"
                            class="choice__input"
                            name="availability[]"
                            value="{{ $item['value'] ?? $item }}"
                            form="shop-filters-form"
                        >

                        <span class="choice__control"></span>

                        <span class="choice__label">
                            {{ $item['label'] ?? $item }}
                        </span>

                    </label>

                @endforeach

            </div>

        </section>

    @endif

</aside>
