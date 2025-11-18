@props(['active'])

@php
$classes = ($active ?? false)
            ? 'pill-link bg-primary-50/80 text-primary-700 shadow-sm'
            : 'pill-link pill-link--ghost';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
