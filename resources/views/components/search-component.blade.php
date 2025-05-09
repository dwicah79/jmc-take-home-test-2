<form method="GET" action="{{ url()->current() }}" class="relative w-full max-w-xs">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari data.."
        class="pl-4 pr-10 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 w-full">
    <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-3">
        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z"></path>
        </svg>
    </button>
</form>
