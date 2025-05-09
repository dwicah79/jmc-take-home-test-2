@props(['type' => 'text', 'placeholder' => '', 'name'])

<input type="{{ $type }}" name="{{ $name }}"
    class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
    placeholder="{{ $placeholder }}" {{ $attributes }}>
