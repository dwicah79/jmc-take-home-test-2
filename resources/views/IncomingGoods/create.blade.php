@extends('layout.app')
@section('content')
    <x-breadcrumb :items="[['label' => 'Tambah Data', 'url' => '#']]" />

    <div class="bg-white rounded-lg shadow-md p-6 w-full overflow-hidden">
        <form id="incomingGoodsForm">
            <div class="mb-8">
                <h3 class="text-lg font-medium mb-4 border-b pb-2">INFORMASI UMUM</h3>
                <div class="flex flex-col md:flex-row md:flex-wrap gap-4">
                    <div class="w-full">
                        <div class="form-group w-full md:w-1/4">
                            <label for="operator_id" class="block text-sm font-semibold text-gray-700 mb-2">Operator</label>
                            <div class="relative">
                                <select name="operator_id" id="operator_id"
                                    class="appearance-none block w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded-md leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    @if (auth()->user()->hasRole('operator')) disabled @endif>
                                    <option value="">Pilih Operator</option>
                                    @foreach ($users as $item)
                                        <option value="{{ $item->id }}"
                                            @if (old('operator_id') == $item->id || (auth()->user()->hasRole('operator') && auth()->id() == $item->id)) selected @endif>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if (auth()->user()->hasRole('operator'))
                                    <input type="hidden" name="operator_id" value="{{ auth()->id() }}">
                                @endif
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-600">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M7 7l3-3 3 3H7zm0 6l3 3 3-3H7z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full">
                        <div class="form-group w-full md:w-1/4">
                            <label class="block text-gray-700 mb-2">Kategori</label>
                            <select class="w-full px-4 py-2 border rounded-lg">
                                <option value="Perlengkapan Kantor">Perlengkapan Kantor</option>
                            </select>
                        </div>
                    </div>

                    <div class="w-full flex flex-col md:flex-wrap md:flex-row gap-4">
                        <div class="form-group w-full md:w-1/4">
                            <label class="block text-gray-700 mb-2">Sub Kategori</label>
                            <select class="w-full px-4 py-2 border rounded-lg">
                                <option value="Alat Tulis">Alat Tulis</option>
                            </select>
                        </div>

                        <div class="form-group w-full md:w-1/4">
                            <label class="block text-gray-700 mb-2">Batas Harga</label>
                            <input type="text" class="w-full px-4 py-2 border rounded-lg" value="500,000">
                        </div>
                    </div>
                    <div class="w-full md:w-1/2">
                        <label class="block text-gray-700 mb-2">Asal Barang</label>
                        <input type="text" class="w-full px-4 py-2 border rounded-lg">
                    </div>
                    <div class="w-full flex flex-col md:flex-wrap md:flex-row gap-4">
                        <div class="form-group w-full md:w-1/4">
                            <label class="block text-gray-700 mb-2">Nomor Surat</label>
                            <input type="text" class="w-full px-4 py-2 border rounded-lg">
                        </div>

                        <div class="form-group w-full md:w-1/4">
                            <label class="block text-gray-700 mb-2">Lampiran</label>
                            <div class="border rounded-lg p-2">
                                <input type="file" id="attachment" class="hidden">
                                <label for="attachment" class="cursor-pointer">
                                    <div class="flex items-center">
                                        <span class="bg-gray-100 px-3  rounded-l border-r">Choose File</span>
                                        <span class="px-3 text-gray-500">No file chosen</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-8">
                    <div class="flex justify-between items-center mb-4 border-b pb-2">
                        <h3 class="text-lg font-medium">INFORMASI BARANG</h3>
                        <button type="button" id="addItemButton"
                            class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-sm">
                            + Tambah Barang
                        </button>
                    </div>

                    <div id="itemRows" class="space-y-4">
                        <div class="border rounded-lg p-4 bg-gray-50">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4">
                                <div class="form-group">
                                    <label class="block text-gray-700 mb-2 text-sm">Nama Barang</label>
                                    <input type="text" class="w-full px-3 py-2 border rounded">
                                </div>

                                <div class="form-group">
                                    <label class="block text-gray-700 mb-2 text-sm">Harga (Rp.)</label>
                                    <div class="flex items-center">
                                        <span class="mr-1">Rp.</span>
                                        <input type="text" class="w-full px-3 py-2 border rounded price-input">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="block text-gray-700 mb-2 text-sm">Jumlah</label>
                                    <input type="number" class="w-full px-3 py-2 border rounded quantity-input">
                                </div>

                                <div class="form-group">
                                    <label class="block text-gray-700 mb-2 text-sm">Satuan</label>
                                    <select class="w-full px-3 py-2 border rounded">
                                        <option value="Buah">Buah</option>
                                        <option value="Lusin">Lusin</option>
                                        <option value="Box">Box</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="block text-gray-700 mb-2 text-sm">Total</label>
                                    <div class="flex items-center">
                                        <span class="mr-1">Rp.</span>
                                        <input type="text" class="w-full px-3 py-2 border rounded total-input" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="block text-gray-700 mb-2 text-sm">Tgl. Expired</label>
                                    <input type="date" class="w-full px-3 py-2 border rounded">
                                </div>
                            </div>
                            <div class="mt-3 flex justify-end">
                                <button type="button" class="text-red-500 hover:text-red-700 remove-item">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="flex justify-start space-x-4">
                    <button type="button"
                        class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Kembali
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        Simpan
                    </button>
                </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function addNewItem() {
                const newItem = `
                            <div class="border rounded-lg p-4 bg-gray-50">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4">
                                    <!-- Nama Barang -->
                                    <div class="form-group">
                                        <label class="block text-gray-700 mb-2 text-sm">Nama Barang</label>
                                        <input type="text" class="w-full px-3 py-2 border rounded">
                                    </div>

                                    <!-- Harga -->
                                    <div class="form-group">
                                        <label class="block text-gray-700 mb-2 text-sm">Harga (Rp.)</label>
                                        <div class="flex items-center">
                                            <span class="mr-1">Rp.</span>
                                            <input type="text" class="w-full px-3 py-2 border rounded price-input">
                                        </div>
                                    </div>

                                    <!-- Jumlah -->
                                    <div class="form-group">
                                        <label class="block text-gray-700 mb-2 text-sm">Jumlah</label>
                                        <input type="number" class="w-full px-3 py-2 border rounded quantity-input">
                                    </div>

                                    <!-- Satuan -->
                                    <div class="form-group">
                                        <label class="block text-gray-700 mb-2 text-sm">Satuan</label>
                                        <select class="w-full px-3 py-2 border rounded">
                                            <option value="Buah">Buah</option>
                                            <option value="Lusin">Lusin</option>
                                            <option value="Box">Box</option>
                                        </select>
                                    </div>

                                    <!-- Total -->
                                    <div class="form-group">
                                        <label class="block text-gray-700 mb-2 text-sm">Total</label>
                                        <div class="flex items-center">
                                            <span class="mr-1">Rp.</span>
                                            <input type="text" class="w-full px-3 py-2 border rounded total-input" readonly>
                                        </div>
                                    </div>

                                    <!-- Tgl. Expired -->
                                    <div class="form-group">
                                        <label class="block text-gray-700 mb-2 text-sm">Tgl. Expired</label>
                                        <input type="date" class="w-full px-3 py-2 border rounded">
                                    </div>
                                </div>
                                <div class="mt-3 flex justify-end">
                                    <button type="button" class="text-red-500 hover:text-red-700 remove-item">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        `;
                document.getElementById('itemRows').insertAdjacentHTML('beforeend', newItem);
            }

            // Add new item when clicking the add button
            document.getElementById('addItemButton').addEventListener('click', addNewItem);

            // Remove item when clicking remove button
            document.getElementById('itemRows').addEventListener('click', function(e) {
                if (e.target.closest('.remove-item')) {
                    const items = document.querySelectorAll('#itemRows > div');
                    if (items.length > 1) {
                        e.target.closest('.border.rounded-lg').remove();
                    } else {
                        alert('Anda harus memiliki setidaknya satu item barang');
                    }
                }
            });

            // Calculate total when price or quantity changes
            document.getElementById('itemRows').addEventListener('input', function(e) {
                if (e.target.classList.contains('price-input') || e.target.classList.contains(
                        'quantity-input')) {
                    const card = e.target.closest('.border.rounded-lg');
                    const priceInput = card.querySelector('.price-input');
                    const quantityInput = card.querySelector('.quantity-input');
                    const totalInput = card.querySelector('.total-input');

                    const price = parseFloat(priceInput.value.replace(/[^0-9.-]+/g, '')) || 0;
                    const quantity = parseFloat(quantityInput.value) || 0;
                    const total = price * quantity;

                    totalInput.value = total.toLocaleString('id-ID');
                }
            });
        });
    </script>
@endsection
