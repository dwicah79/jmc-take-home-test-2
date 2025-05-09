@props(['label'])

<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full bg-blue-700 hover:bg-blue-800 text-white py-2 rounded']) }}>
    {{ $label }}
</button>
