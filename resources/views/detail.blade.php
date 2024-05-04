<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Detail</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite('resources/css/app.css')
</head>

<body class="antialiased">
    <nav class="sm:fixed sm:top-0 sm:right-0 p-6 text-right bg-gray-100 dark:bg-gray-900 w-full">
        @if (Route::has('login'))
            <div>
                @auth
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ url('/admin/dashboard') }}"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard
                            Admin</a>
                    @elseif (Auth::user()->role === 'user')
                        <a href="{{ url('/dashboard') }}"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @endif
                @else
                    <a href="{{ route('login') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                        in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </nav>

    {{-- detail berita --}}
    <div class="max-w-3xl mx-auto px-4 py-8">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Gambar Berita -->
        <img src="{{ asset('images/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
             class="w-full h-64 object-contain object-center">

        <div class="p-6">
            <!-- Judul Berita -->
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ $berita->judul }}</h2>

            <!-- Isi Konten Berita -->
            <p class="text-gray-700 leading-relaxed mb-4">{{ $berita->isi }}</p>

            <!-- Tanggal -->
            <p class="text-gray-500 text-sm">{{ $berita->created_at->format('d M Y') }}</p>
        </div>
    </div>
</div>

</body>

</html>
