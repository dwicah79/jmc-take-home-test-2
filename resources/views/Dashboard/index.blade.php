@extends('layout.app')
@section('content')
    <div class="flex flex-col items-center justify-center h-screen w-full bg-white">
        <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
        <p class="text-gray-600">Selamat datang di halaman dashboard!</p>
        <img src="{{ asset('images/Warehousing-101.jpg') }}" alt="Dashboard Illustration" class="mt-4 w-1/2">
    </div>
@endsection
