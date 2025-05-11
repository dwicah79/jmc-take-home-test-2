@extends('layout.app')
@section('content')
    <x-breadcrumb :items="[['label' => 'Barang Masuk', 'url' => route('incoming-goods.index')]]" />

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

            <div class="flex justify-between items-center mb-4 p-2 md:p-0">
                <x-modal-form triggerClass="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                    triggerText="+ Tambah Data" title="Form Kategori" id="createModal">
                    <form method="POST" action="{{ route('incoming-goods.store') }}">
                        @csrf
                        <div class="mb-4">
                            <x-input name="code_category" label="Kode Kategori" required />
                        </div>
                        <div class="mb-4">
                            <x-input name="name_category" label="Nama Kategori" required />
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

            <x-data-table :headers="[
                'No',
                'Aksi',
                'Tanggal',
                'Asal Barang',
                'Penerima',
                'Unit',
                'Kode',
                'Nama Barang',
                'Harga',
                'Jumlah',
                'Total',
                'Status',
            ]" :rows="$incomingGoods">

                @forelse ($incomingGoods as $incoming)
                    @php
                        $goodsDetails = $incoming->goodsDetail;
                        $rowspan = count($goodsDetails);
                    @endphp

                    @foreach ($goodsDetails as $index => $detail)
                        <tr class="{{ $loop->parent->even ? 'bg-gray-100' : 'bg-white' }}">
                            @if ($index === 0)
                                <td rowspan="{{ $rowspan }}" class="px-4 py-2 text-center align-top">
                                    {{ ($incomingGoods->currentPage() - 1) * $incomingGoods->perPage() + $loop->parent->iteration }}
                                </td>
                                <td rowspan="{{ $rowspan }}" class="px-4 py-2 text-center align-top">
                                    <div class="inline-flex space-x-4">
                                        <button type="button"
                                            onclick="openEditModal('{{ $incoming->id }}', '{{ $incoming->code_category }}', '{{ $incoming->name_category }}')"
                                            class="text-blue-600 hover:underline hover:cursor-pointer">
                                            <i class="fa-solid fa-pencil"></i>
                                        </button>

                                        <form method="POST" action="{{ route('incoming-goods.destroy', $incoming->id) }}"
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
                                <td rowspan="{{ $rowspan }}" class="px-4 py-2 font-semibold align-top">
                                    {{ $incoming->date }}
                                </td>
                                <td rowspan="{{ $rowspan }}" class="px-4 py-2 font-semibold align-top">
                                    {{ $incoming->origin_of_goods }}
                                </td>
                                <td rowspan="{{ $rowspan }}" class="px-4 py-2 font-semibold align-top">
                                    {{ $incoming->operator->name }}
                                </td>
                                <td rowspan="{{ $rowspan }}" class="px-4 py-2 font-semibold align-top">
                                    {{ $incoming->unit }}
                                </td>
                            @endif

                            <td class="px-4 py-2 font-semibold">{{ $incoming->category->code_category }}</td>
                            <td class="px-4 py-2 font-semibold">{{ $detail->goods_name }}</td>
                            <td class="px-4 py-2 font-semibold text-right">
                                {{ number_format($detail->price, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-2 font-semibold text-center">{{ $detail->volume }}</td>
                            <td class="px-4 py-2 font-semibold text-right">
                                {{ number_format($detail->price * $detail->volume, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-2 font-semibold text-center">
                                @if ($detail->status == 0)
                                    <i class="fa-regular fa-circle-xmark"></i>
                                @else
                                    <i class="fa-solid fa-circle-check text-green-600"></i>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                @empty
                    <tr>
                        <td colspan="12">Tidak ada data</td>
                    </tr>
                @endforelse
            </x-data-table>
            <div class="p-5">
                {{ $incomingGoods->links() }}
            </div>
        </div>
    </div>

    <div id="editModal" class="fixed inset-0 bg-black/20 z-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4">
            <div class="px-6 py-4">
                <h3 class="text-lg font-medium text-gray-900">Form</h3>
            </div>
            <form id="editForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="p-6">
                    <div class="mb-6">
                        <label for="edit_code_category" class="block text-sm font-medium text-gray-700 mb-2">Kode
                            Kategori</label>
                        <input type="text" name="code_category" id="edit_code_category"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            required>
                    </div>
                    <div class="mb-6">
                        <label for="edit_name_category" class="block text-sm font-medium text-gray-700 mb-2">Nama
                            Kategori</label>
                        <input type="text" name="name_category" id="edit_name_category"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            required>
                    </div>
                </div>
                <div class="px-6 py-4 flex justify-end space-x-3">
                    <button type="button" onclick="closeEditModal()" class="px-5 py-2 rounded text-gray-700">
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

        function openEditModal(id, code, name) {
            document.getElementById('editForm').action = `/categories/${id}`;
            document.getElementById('edit_code_category').value = code;
            document.getElementById('edit_name_category').value = name;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });
    </script>
@endsection
