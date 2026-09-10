@props([
'type' => 'button',
'variant' => 'primary',
'size' => 'md',
'full' => false,
'loading' => false,
'disabled' => false,
'icon' => null,
'iconPosition' => 'start',
])

@php
    $classes = [
        'btn',
        "btn--{$variant}",
        "btn--{$size}",
        $full ? 'btn--full' : '',
        $loading ? 'btn--loading' : '',
    ];
@endphp

<button
    type="{{ $type }}"
    {{ $attributes->merge(['class' => implode(' ', array_filter($classes))]) }}
    @disabled($disabled || $loading)
    @if($loading) aria-busy="true" @endif
>
    @if($loading)
        <span
            class="btn__spinner"
            aria-hidden="true"
        ></span>
    @else

        @if($icon && $iconPosition === 'start')
            <span class="btn__icon">
                {!! $icon !!}
            </span>
        @endif

        <span>
            {{ $slot }}
        </span>

        @if($icon && $iconPosition === 'end')
            <span class="btn__icon">
                {!! $icon !!}
            </span>
        @endif

    @endif
</button>
