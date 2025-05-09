@extends('layout.app')
@section('content')
    <x-breadcrumb :items="[['label' => 'Kategori Barang', 'url' => route('categories.index')]]" />

    <div class=" h-full w-full bg-white">
        <div class="md:p-10">
            <x-search-component buttonText="+ Tambah Barang">
                <input type="text" class="border rounded px-3 py-2 text-sm" placeholder="Cari data...">
            </x-search-component>
        </div>
        <x-data-table :headers="['No', 'Aksi', 'Kode Kategori', 'Nama Kategori']" :rows="$categories">
            @foreach ($categories as $category)
                <tr class="bg-white ">
                    <td class="px-4 py-2">{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}
                    </td>
                    <td class="px-4 py-2">
                        <button class="text-blue-600 hover:underline">Edit</button>
                        <button class="text-red-600 hover:underline">Hapus</button>
                    </td>
                    <td class="px-4 py-2 font-semibold">{{ $category->code_category }}</td>
                    <td class="px-4 py-2 font-semibold">{{ $category->name_category }}</td>
                </tr>
            @endforeach
        </x-data-table>
        <div class="mt-5 px-5">
            {{ $categories->links() }}
        </div>
    </div>
@endsection
