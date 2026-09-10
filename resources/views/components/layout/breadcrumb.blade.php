@props([
'items' => [],
])

@if(count($items))

    <nav
        class="breadcrumb"
        aria-label="مسیر صفحه"
    >

        <div class="container">

            <ol class="breadcrumb__list">

                <li class="breadcrumb__item">

                    <a
                        href="/"
                        class="breadcrumb__link"
                    >
                        خانه
                    </a>

                    @if(count($items))
                        <span
                            class="breadcrumb__separator"
                            aria-hidden="true"
                        >
                            /
                        </span>
                    @endif

                </li>


                @foreach($items as $index => $item)

                    @php
                        $isLast = $loop->last;

                        $label = is_array($item)
                            ? ($item['label'] ?? '')
                            : $item;

                        $url = is_array($item)
                            ? ($item['url'] ?? null)
                            : null;
                    @endphp

                    <li class="breadcrumb__item">

                        @if($url && !$isLast)

                            <a
                                href="{{ $url }}"
                                class="breadcrumb__link"
                            >
                                {{ $label }}
                            </a>

                        @else

                            <span class="breadcrumb__current">
                                {{ $label }}
                            </span>

                        @endif

                        @if(!$isLast)
                            <span
                                class="breadcrumb__separator"
                                aria-hidden="true"
                            >
                                /
                            </span>
                        @endif

                    </li>

                @endforeach

            </ol>

        </div>

    </nav>

@endif
