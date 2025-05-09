@extends('layout.app')
@section('content')
    <x-breadcrumb :items="[['label' => 'Barang Masuk', 'url' => route('incoming-goods.index')]]" />

    <div class="flex flex-col items-center justify-center h-screen w-full bg-white">
        <h1 class="text-2xl font-bold mb-4">Ini barang masuk</h1>
        <p class="text-gray-600">Selamat datang di halaman dashboard!</p>
    </div>
@endsection
