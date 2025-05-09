@props(['type' => 'success', 'message' => ''])

@php
    $colors = [
        'success' => 'bg-green-100 border-green-400 text-green-700',
        'error' => 'bg-red-100 border-red-400 text-red-700',
        'warning' => 'bg-yellow-100 border-yellow-400 text-yellow-700',
        'info' => 'bg-blue-100 border-blue-400 text-blue-700',
    ];

    $icons = [
        'success' => 'fa-check-circle',
        'error' => 'fa-exclamation-circle',
        'warning' => 'fa-exclamation-triangle',
        'info' => 'fa-info-circle',
    ];
@endphp

@if ($message)
    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
        class="{{ $colors[$type] }} border px-4 py-3 rounded relative mb-4" role="alert">
        <div class="flex items-center  gap-5">
            <span class="mr-2">
                <i class="fas {{ $icons[$type] }}"></i>
            </span>
            <span class="block sm:inline">{{ $message }}</span>
        </div>
    </div>
@endif
