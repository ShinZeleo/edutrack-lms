<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center gap-2 px-6 py-3 bg-white border-2 border-neutral-300 rounded-lg font-semibold text-sm text-neutral-700 hover:bg-neutral-50 hover:border-neutral-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
