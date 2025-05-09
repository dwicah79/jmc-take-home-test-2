@props(['items' => []])

<nav class="text-sm text-gray-500 mb-4" aria-label="Breadcrumb">
    <ol class="list-none p-0 inline-flex space-x-2">
        <li class="flex items-center space-x-2 font-bold uppercase">
            <a href="{{ url('/') }}" class="text-gray-500 hover:text-gray-700">Home</a>
            <span>/</span>
        </li>
        @foreach ($items as $key => $item)
            <li class="flex items-center font-bold uppercase">
                @if ($loop->last)
                    <span class="text-gray-700 font-semibold">{{ $item['label'] }}</span>
                @else
                    <a href="{{ $item['url'] }}" class="text-gray-500 hover:text-gray-700">{{ $item['label'] }}</a>
                    <svg class="h-4 w-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L11.586 9 7.293 4.707a1 1 0 111.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
