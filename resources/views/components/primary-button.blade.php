<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-acef-green border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-acef-dark focus:bg-acef-dark active:bg-acef-dark focus:outline-none focus:ring-2 focus:ring-acef-green focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
