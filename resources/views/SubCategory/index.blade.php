@extends('layout.app')
@section('content')
    <x-breadcrumb :items="[['label' => 'Sub Kategori Barang', 'url' => route('subcategories.index')]]" />

    <div class="w-full bg-white rounded-lg shadow-lg">
        <div class="md:p-10">
            @if (session('success'))
                <x-alert type="success" message="{{ session('success') }}" />
            @endif
            @if (session('warning'))
                <x-alert type="warning" message="{{ session('warning') }}" />
            @endif
            @error('sub_category_name')
                <x-alert type="warning" message="{{ $message }}" />
            @enderror
            @error('category_id')
                <x-alert type="warning" message="{{ $message }}" />
            @enderror
            @error('price_range')
                <x-alert type="warning" message="{{ $message }}" />
            @enderror

            <div class="flex justify-between items-center mb-4 p-2 md:p-0">
                <x-modal-form triggerClass="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                    triggerText="+ Tambah Data" title="Form Sub Kategori" id="createModal">
                    <form method="POST" action="{{ route('subcategories.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                            <div class="relative">
                                <select name="category_id" id="category_id"
                                    class="appearance-none block w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded-md leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('category_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name_category }}
                                        </option>
                                    @endforeach
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-600">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M7 7l3-3 3 3H7zm0 6l3 3 3-3H7z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <x-input name="sub_category_name" label="Nama Sub Kategori" required />
                        </div>
                        <div class="mb-4">
                            <label for="price_range" class="block text-sm font-semibold text-gray-700 mb-2">Batas
                                Harga</label>
                            <input type="text" name="price_range_display" id="price_range_display"
                                class="appearance-none block w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 rounded-md leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                required>
                            <input type="hidden" name="price_range" id="price_range">
                        </div>
                        <div class="px-6 py-4 flex justify-end space-x-3">
                            <button @click="open = false" type="button" class="btn-secondary">
                                Tutup
                            </button>
                            <button type="submit" class="btn-primary">
                                Simpan
                            </button>
                        </div>
                    </form>
                </x-modal-form>
                <div class="w-1/2 flex justify-end">
                    <x-search-component />
                </div>
            </div>

            <x-data-table :headers="['No', 'Aksi', 'Nama Kategori', 'Sub Kategori Barang', 'Batas Harga (Rp.)']" :rows="$subcategories">
                @forelse ($subcategories as $subscategory)
                    <tr class="bg-white">
                        <td class="px-4 py-2">
                            {{ ($subcategories->currentPage() - 1) * $subcategories->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-4 py-2">
                            <div class="inline-flex space-x-4">
                                <button type="button" onclick="openEditModal({{ $subscategory->toJson() }})"
                                    class="text-blue-600 hover:underline hover:cursor-pointer">
                                    <i class="fa-solid fa-pencil"></i>
                                </button>

                                <form method="POST" action="{{ route('subcategories.destroy', $subscategory->id) }}"
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
                        <td class="px-4 py-2 font-semibold">{{ $subscategory->category->name_category }}</td>
                        <td class="px-4 py-2 font-semibold">{{ $subscategory->sub_category_name }}</td>
                        <td class="px-4 py-2 font-semibold">{{ number_format($subscategory->price_range, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr class="bg-white">
                        <td colspan="4" class="px-4 py-2 text-center text-gray-500">Tidak ada data</td>
                    </tr>
                @endforelse
            </x-data-table>
            <div class="p-5">
                {{ $subcategories->links() }}
            </div>
        </div>
    </div>

    <div id="editModal" class="fixed inset-0 bg-black/20 z-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4">
            <div class="px-6 py-4">
                <h3 class="text-lg font-medium text-gray-900">Edit Sub Kategori</h3>
            </div>
            <form id="editForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="p-6">
                    <div class="mb-4">
                        <label for="edit_category_id"
                            class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                        <div class="relative">
                            <select name="category_id" id="edit_category_id"
                                class="appearance-none block w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded-md leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Kategori</option>
                                @foreach ($category as $item)
                                    <option value="{{ $item->id }}">{{ $item->name_category }}</option>
                                @endforeach
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-600">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                    <path d="M7 7l3-3 3 3H7zm0 6l3 3 3-3H7z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="edit_sub_category_name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Sub
                            Kategori</label>
                        <input type="text" name="sub_category_name" id="edit_sub_category_name"
                            class="appearance-none block w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 rounded-md leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="edit_price_range_display" class="block text-sm font-semibold text-gray-700 mb-2">Batas
                            Harga</label>
                        <input type="text" name="price_range_display" id="edit_price_range_display"
                            class="appearance-none block w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 rounded-md leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        <input type="hidden" name="price_range" id="edit_price_range">
                    </div>
                </div>
                <div class="px-6 py-4 flex justify-end space-x-3">
                    <button type="button" onclick="closeEditModal()" class="btn-secondary">
                        Tutup
                    </button>
                    <button type="submit" class="btn-primary">
                        Simpan
                    </button>
                </div>
            </form>
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

        function openEditModal(subCategory) {
            const modal = document.getElementById('editModal');
            const form = document.getElementById('editForm');
            form.action = `/subcategories/${subCategory.id}`;
            document.getElementById('edit_category_id').value = subCategory.category_id;
            document.getElementById('edit_sub_category_name').value = subCategory.sub_category_name;
            if (window.editCleave) {
                window.editCleave.destroy();
            }
            window.editCleave = new Cleave('#edit_price_range_display', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand',
                numeralDecimalScale: 0,
                onValueChanged: function(e) {
                    document.getElementById('edit_price_range').value = e.target.rawValue;
                }
            });
            window.editCleave.setRawValue(subCategory.price_range);

            modal.classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', function() {
            new Cleave('#price_range_display', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand',
                numeralDecimalScale: 0,
                onValueChanged: function(e) {
                    document.getElementById('price_range').value = e.target.rawValue;
                }
            });
            @if (old('price_range'))
                const cleave = new Cleave('#price_range_display', {
                    numeral: true,
                    numeralThousandsGroupStyle: 'thousand'
                });
                cleave.setRawValue({{ old('price_range') }});
            @endif
        });
    </script>
@endsection
