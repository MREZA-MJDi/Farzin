@props([
'size' => 'md',
'variant' => null,
'label' => null,
'type' => 'button',
])

@php
    $classes = [
        'icon-btn',
        $size !== 'md' ? "icon-btn--{$size}" : '',
        $variant ? "icon-btn--{$variant}" : '',
    ];
@endphp

<button
    type="{{ $type }}"
    {{ $attributes->merge(['class' => implode(' ', array_filter($classes))]) }}
    @if($label) aria-label="{{ $label }}" @endif
>
    {{ $slot }}
</button>
