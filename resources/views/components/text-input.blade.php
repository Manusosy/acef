@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-acef-green focus:ring-acef-green rounded-md shadow-sm']) }}>
