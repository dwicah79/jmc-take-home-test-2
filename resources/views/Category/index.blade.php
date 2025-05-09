@extends('layout.app')
@section('content')
    <x-breadcrumb :items="[['label' => 'Kategori Barang', 'url' => route('categories.index')]]" />
    <div class="w-full bg-white rounded-lg shadow-lg">
        <div class="md:p-10">
            <div class="flex justify-between items-center mb-4">
                <x-modal-form triggerClass="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                    triggerText="+ Tambah Data" title="Form Kategori">
                    <form method="POST" action="{{ route('categories.store') }}">
                        @csrf
                        <x-input name="code_category" label="Kode Kategori" required />
                        <x-input name="name_category" label="Nama Kategori" required />
                    </form>
                </x-modal-form>
                <x-search-component>
                    <input type="text" class="border rounded px-3 py-2 text-sm" placeholder="Cari data...">
                </x-search-component>
            </div>
        </div>

        <x-data-table :headers="['No', 'Aksi', 'Kode Kategori', 'Nama Kategori']" :rows="$categories">
            @foreach ($categories as $category)
                <tr class="bg-white">
                    <td class="px-4 py-2">{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}
                    </td>
                    <td class="px-4 py-2">
                        <div class="inline-flex space-x-4">
                            <button class="text-blue-600 hover:underline"><i class="fa-solid fa-pencil"></i></button>
                            <button class="text-red-600 hover:underline"><i class="fa-solid fa-trash-can"></i></button>
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
@endsection
