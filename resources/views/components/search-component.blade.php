<form method="GET" action="{{ url()->current() }}" class="relative w-full max-w-xs">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari data.."
        class="pl-4 pr-10 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 w-full">
</form>
