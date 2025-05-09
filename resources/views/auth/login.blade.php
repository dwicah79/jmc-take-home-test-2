<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Pengelolaan Barang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <div class="w-full md:w-1/2 flex items-center justify-center bg-white p-10">
            <div class="w-full max-w-md">
                <div class="mb-6 flex">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="h-10 mb-2">
                    <div class="flex flex-col">
                        <h1 class="text-xl font-bold text-gray-800">Aplikasi Pengelolaan Barang</h1>
                        <p class="text-sm text-gray-600">PT JMC Indonesia</p>
                    </div>
                </div>
                @if (session('success'))
                    <div class="mb-4 p-4 rounded bg-green-100 text-green-700 border border-green-300">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 p-4 rounded bg-red-100 text-red-700 border border-red-300">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('warning'))
                    <div class="mb-4 p-4 rounded bg-yellow-100 text-yellow-700 border border-yellow-300">
                        {{ session('warning') }}
                    </div>
                @endif


                <h2 class="text-lg font-semibold mb-4">LOGIN</h2>
                <p class="text-sm text-gray-600 mb-4">Selamat Datang, silakan masukkan username dan password anda!</p>

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf
                    <div class="mb-4">
                        <x-form-input name="username" placeholder="Username" />
                    </div>
                    <div class="mb-6">
                        <x-form-input name="password" type="password" placeholder="Password" />
                    </div>
                    <x-button label="MASUK" />
                </form>
            </div>
        </div>
        <div class="hidden md:block md:w-1/2">
            <img src="{{ asset('images/Warehousing-101.jpg') }}" alt="Login Illustration"
                class="object-cover h-full w-full">
        </div>
    </div>
</body>

</html>
