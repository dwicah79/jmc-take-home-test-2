<div class="flex flex-wrap justify-between items-center mb-4 gap-2">
    <button
        {{ $attributes->merge(['class' => 'bg-cyan-600 text-white px-4 py-2 rounded hover:bg-cyan-700 hover:cursor-pointer']) }}>
        {{ $buttonText ?? '+ Tambah Data' }}
    </button>
    <div class="flex flex-wrap gap-2 items-center">
        {{ $slot }}
    </div>
</div>
