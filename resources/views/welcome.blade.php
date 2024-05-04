<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Portal Berita </title>

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

    <div class="max-w-7xl mx-auto p-6 lg:p-8 mt-20">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 lg:gap-7">
        @foreach ($data as $item)
            <div class="bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none overflow-hidden">
                {{-- gambar --}}
                <div class="h-56 relative">
                    <img src="{{ asset('images/' . $item->gambar) }}" alt="{{ $item->judul }}"
                        class="w-full h-full object-cover">
                </div>

                <div class="p-6">
                    {{-- judul --}}
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ $item->judul }}
                    </h2>

                    {{-- isi --}}
                    <p class="mt-2 text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                        {{ Str::limit($item->isi, 150) }}
                    </p>

                    {{-- tanggal --}}
                    <p class="mt-2 text-gray-500 dark:text-gray-400 text-xs">
                        {{ $item->created_at->diffForHumans() }}
                        {{-- {{ $item->created_at->format('d M Y') }} --}}
                    </p>

                    {{-- baca selengkapnya --}}
                    <a href="{{ route('detail.berita', $item->id) }}"
                        class="mt-4 text-blue-600 dark:text-blue-400 hover:underline inline-block">Baca
                        Selengkapnya</a>
                </div>
            </div>
        @endforeach
    </div>
</div>

</body>

</html>
