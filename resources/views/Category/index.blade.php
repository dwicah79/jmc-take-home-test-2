@extends('layout.app')
@section('content')
    <x-breadcrumb :items="[['label' => 'Kategori Barang', 'url' => route('categories.index')]]" />

    <div class="w-full bg-white rounded-lg shadow-lg">
        <div class="md:p-10">
            @if (session('success'))
                <x-alert type="success" message="{{ session('success') }}" />
            @endif
            @if (session('warning'))
                <x-alert type="warning" message="{{ session('warning') }}" />
            @endif
            @error('code_category')
                <x-alert type="warning" message="{{ $message }}" />
            @enderror
            @error('name_category')
                <x-alert type="warning" message="{{ $message }}" />
            @enderror

            <div class="flex justify-between items-center mb-4">
                <x-modal-form triggerClass="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                    triggerText="+ Tambah Data" title="Form Kategori">
                    <form method="POST" action="{{ route('categories.store') }}">
                        @csrf

                        <div class="mb-4">
                            <x-input name="code_category" label="Kode Kategori" required />
                        </div>

                        <div class="mb-4">
                            <x-input name="name_category" label="Nama Kategori" required />
                        </div>

                        <div class="px-6 py-4 flex justify-end space-x-3">
                            <button @click="open = false" type="button"
                                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Tutup
                            </button>
                            <button type="submit"
                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Simpan
                            </button>
                        </div>
                    </form>
                </x-modal-form>

                <x-search-component>
                    <input type="text" class="border rounded px-3 py-2 text-sm" placeholder="Cari data...">
                </x-search-component>
            </div>

            <x-data-table :headers="['No', 'Aksi', 'Kode Kategori', 'Nama Kategori']" :rows="$categories">
                @foreach ($categories as $category)
                    <tr class="bg-white">
                        <td class="px-4 py-2">
                            {{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}</td>
                        <td class="px-4 py-2">
                            <div class="inline-flex space-x-4">
                                <button class="text-blue-600 hover:underline"><i class="fa-solid fa-pencil"></i></button>
                                <form method="POST" action="{{ route('categories.destroy', $category->id) }}"
                                    class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        class="text-red-600 hover:underline delete-btn hover:cursor-pointer">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                        <td class="px-4 py-2 font-semibold">{{ $category->code_category }}</td>
                        <td class="px-4 py-2 font-semibold">{{ $category->name_category }}</td>
                    </tr>
                @endforeach
            </x-data-table>

            <div class="p-5">
                {{ $categories->links() }}
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                const form = this.closest('form');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
