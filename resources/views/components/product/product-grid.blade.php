@props([
'columns' => 4,
])

<div
    {{ $attributes->merge([
        'class' => "product-grid product-grid--{$columns}"
    ]) }}
>
    {{ $slot }}
</div>
