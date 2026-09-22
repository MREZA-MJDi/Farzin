@props([
'items' => [],
'homeLabel' => 'خانه',
'homeHref' => null,
])

@php
    $homeHref ??= route('home');

    $items = is_iterable($items)
        ? collect($items)->values()
        : collect();
@endphp

@if($items->isNotEmpty())
    <nav
        {{ $attributes->merge([
            'class' => 'breadcrumb',
        ]) }}
        aria-label="مسیر صفحه"
    >
        <ol class="breadcrumb__list">

            {{-- Home --}}
            <li class="breadcrumb__item">
                <a
                    href="{{ $homeHref }}"
                    class="breadcrumb__link"
                >
                    {{ $homeLabel }}
                </a>
            </li>

            {{-- Items --}}
            @foreach($items as $index => $item)

                @php
                    $isArray = is_array($item);

                    $label = $isArray
                        ? ($item['label'] ?? '')
                        : $item;

                    $href = $isArray
                        ? ($item['href'] ?? null)
                        : null;

                    $isLast = $index === $items->count() - 1;
                @endphp

                <li
                    class="breadcrumb__separator"
                    aria-hidden="true"
                >
                    <span>/</span>
                </li>

                <li class="breadcrumb__item">
                    @if(filled($href) && ! $isLast)
                        <a
                            href="{{ $href }}"
                            class="breadcrumb__link"
                        >
                            {{ $label }}
                        </a>
                    @else
                        <span
                            class="breadcrumb__current"
                            aria-current="page"
                        >
                            {{ $label }}
                        </span>
                    @endif
                </li>

            @endforeach

        </ol>
    </nav>
@endif
