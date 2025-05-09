@props(['label'])

<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-primary w-full cursor-pointer']) }}>
    {{ $label }}
</button>
