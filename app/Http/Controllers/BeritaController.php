<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $data = Berita::latest()->paginate(5);
        $title = 'Hapus Data!';
        $text = "Apakah anda yakin ingin menghapus data ini?";
        confirmDelete($title, $text);
        return view('admin.dashboard', compact('data'));
    }

    public function show(Berita $berita)
    {
        return view('detail', compact('berita'));
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
            'gambar' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images'), $imageName);

            $validation['gambar'] = $imageName;
        }

        $data = Berita::create($validation);
        if ($data) {
            session()->flash('success', 'Berita berhasil ditambahkan');
            return redirect()->route('admin.dashboard')->with('toast_success', 'Berita berhasil ditambahkan!');
        } else {
            session()->flash('error', 'Berita gagal ditambahkan');
            return redirect()->route('admin.berita.create')->with('toast_error', 'Berita gagal ditambahkan!');
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
            'gambar' => 'required|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images'), $imageName);

            // Delete previous photo if exists
            if ($berita->gambar) {
                $previousImage = public_path('images') . '/' . $berita->gambar;
                if (file_exists($previousImage)) {
                    unlink($previousImage);
                }
            }

            $validation['gambar'] = $imageName;
        }

        $data = $berita->update($validation);
        if ($data) {
            session()->flash('success', 'Berita berhasil diubah');
            return redirect()->route('admin.dashboard')->with('toast_success', 'Berita berhasil diubah!');
        } else {
            session()->flash('error', 'Berita gagal diubah');
            return redirect()->route('admin.berita.edit', $berita)->with('toast_error', 'Berita gagal diubah!');
        }
    }

    public function destroy(Berita $berita)
    {
        // Delete photo if exists
        if ($berita->gambar) {
            $imagePath = public_path('images') . '/' . $berita->gambar;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $data = $berita->delete();
        if ($data) {
            session()->flash('success', 'Berita berhasil dihapus');
            return redirect()->route('admin.dashboard')->with('toast_success', 'Berita berhasil dihapus!');
        } else {
            session()->flash('error', 'Berita gagal dihapus');
            return redirect()->route('admin.dashboard')->with('toast_error', 'Berita gagal dihapus!');
        }
    }
}
