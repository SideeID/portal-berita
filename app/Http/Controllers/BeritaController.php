<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $data = Berita::all();
        return view('admin.dashboard', compact('data'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'gambar' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Perhatikan penambahan file()
        ]);

        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images'), $imageName);

            $validation['gambar'] = $imageName;
        }

        $data = Berita::create($validation);
        if ($data) {
            session()->flash('success', 'Berita berhasil ditambahkan');
            return redirect()->route('admin.dashboard');
        } else {
            session()->flash('error', 'Berita gagal ditambahkan');
            return redirect()->route('admin.berita.create');
        }
    }

    public function edit(Berita $berita)
    {
        return view('admin.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $validation = $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'gambar' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images'), $imageName);

            $validation['gambar'] = $imageName;
        }

        $data = $berita->update($validation);
        if ($data) {
            session()->flash('success', 'Berita berhasil diubah');
            return redirect()->route('admin.dashboard');
        } else {
            session()->flash('error', 'Berita gagal diubah');
            return redirect()->route('admin.berita.edit', $berita);
        }
    }

    public function destroy(Berita $berita)
    {
        $data = $berita->delete();
        if ($data) {
            session()->flash('success', 'Berita berhasil dihapus');
            return redirect()->route('admin.dashboard');
        } else {
            session()->flash('error', 'Berita gagal dihapus');
            return redirect()->route('admin.dashboard');
        }
    }
}
