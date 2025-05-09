@extends('layout.app')
@section('content')
    <x-breadcrumb :items="[['label' => 'Barang Masuk', 'url' => route('incoming-goods.index')]]" />

    <div class=" h-full w-full bg-white">
        <div class="md:p-10">
            <x-search-component buttonText="+ Tambah Barang">
                <select class="border rounded px-3 py-2 text-sm">
                    <option>Semua Kategori</option>
                </select>
                <select class="border rounded px-3 py-2 text-sm">
                    <option>Semua Sub Kategori</option>
                </select>
                <select class="border rounded px-3 py-2 text-sm">
                    <option>Semua Tahun</option>
                </select>
                <input type="text" class="border rounded px-3 py-2 text-sm" placeholder="Cari data...">
            </x-search-component>
        </div>
        <x-data-table>
            <x-slot name="thead">
                <tr>
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Action</th>
                    <th class="px-4 py-2">Tanggal</th>
                    <th class="px-4 py-2">Asal Barang</th>
                    <th class="px-4 py-2">Penerima</th>
                    <th class="px-4 py-2">Unit</th>
                    <th class="px-4 py-2">Kode</th>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Harga (Rp.)</th>
                    <th class="px-4 py-2">Jumlah</th>
                    <th class="px-4 py-2">Total (Rp.)</th>
                    <th class="px-4 py-2">Status</th>
                </tr>
            </x-slot>
        </x-data-table>
    </div>
@endsection
