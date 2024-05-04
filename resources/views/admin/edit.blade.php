<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Berita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (session()->has('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="mb-4">
                            <label for="judul" class="block text-gray-700 text-sm font-bold mb-2">Judul</label>
                            <input type="text" name="judul" id="judul" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $berita->judul }}">

                            @error('judul')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="isi" class="block text-gray-700 text-sm font-bold mb-2">Isi konten</label>
                            <textarea name="isi" id="isi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" style="resize: vertical; height: 200px;">{{ $berita->isi }}</textarea>

                            @error('isi')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="gambar" class="block text-gray-700 text-sm font-bold mb-2">Gambar</label>
                            <input type="file" name="gambar" id="gambar" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

                            @error('gambar')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror

                            @if($berita->gambar)
                                <img src="{{ asset('images/' . $berita->gambar) }}" alt="Gambar Berita" class="mt-2">
                            @endif
                        </div>

                        <div class="flex items-center justify-between">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                Update
                            </button>

                            <a href="{{ route('admin.dashboard') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                                Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
