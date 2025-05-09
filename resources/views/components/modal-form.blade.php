<div x-data="{ open: false }" class="relative">
    <x-button @click="open = true" label="{{ $triggerText ?? '+ Tambah Data' }}"
        class="{{ $triggerClass ?? 'bg-cyan-600 text-white text-xs md:text-lg p-2 rounded hover:bg-cyan-700' }}">
        {{ $triggerText ?? '+ Tambah Data' }}
    </x-button>

    <div x-show="open" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 backdrop-blur-none" x-transition:enter-end="opacity-100 backdrop-blur-sm"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 backdrop-blur-sm"
        x-transition:leave-end="opacity-0 backdrop-blur-none"
        class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 flex items-center justify-center p-4"
        @click.self="open = false">
        <div x-show="open" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95" class="bg-white rounded-lg shadow-xl w-full max-w-md">
            <div class="border-b border-b-gray-200 px-6 py-4">
                <h3 class="text-lg font-semibold text-gray-900">{{ $title ?? 'Form' }}</h3>
            </div>
            <div class="p-6 space-y-4">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
