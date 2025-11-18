@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full rounded-xl border border-primary-200 bg-primary-50/80 px-4 py-3 text-sm font-semibold text-primary-800 shadow-sm'
            : 'block w-full rounded-xl border border-transparent px-4 py-3 text-sm font-semibold text-slate-600 hover:border-slate-200 hover:bg-white';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
