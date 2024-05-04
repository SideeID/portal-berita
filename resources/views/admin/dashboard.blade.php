<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-2 flex justify-between items-center bg-gray-200 p-5 rounded-md">
                <div>
                    <h1 class="text-xl text-semibold">Berita</h1>
                 </div>
                <div>
                    <a href="{{ route('admin.berita.create') }}" class="px-5 py-2 bg-blue-500 rounded-md text-white text-lg shadow-md">Tambah</a>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="table-responsive">
                            <table class="min-w-full divide-y divide-gray-200 ">
                                <thead class="bg-gray-50 ">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Judul
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Isi Konten
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Gambar
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($data as $item)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $item->judul }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ Str::limit($item->isi, 30) }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <img src="{{ asset('images/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-20 h-20 object-cover">
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('admin.berita.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a> |
                                                <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
