@props([
    'headers' => [],
    'rows' => [],
])

<div class="overflow-x-auto bg-gray-200">
    <table class="min-w-full text-sm text-gray-700 border-b border-b-gray-200 shadow-b shadow-gray-200">
        <thead class="bg-gray-100 text-xs uppercase text-gray-600">
            <tr>
                @foreach ($headers as $header)
                    <th class="px-4 py-2 text-left">{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>
