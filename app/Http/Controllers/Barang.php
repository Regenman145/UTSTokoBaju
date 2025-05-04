<?php

namespace App\Http\Controllers;

use App\Models\Baju;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class Barang extends Controller
{
    function tampil()
    {
        $dataBaju = Baju::all();
        return view('baju.barang', compact('dataBaju'));
    }

    function tambah()
    {
        return view('baju.tambah');
    }

    function submit(Request $request)
    {
        $request->validate([
            // Tidak perlu validasi kode_barang karena auto-generate
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'merek_baju' => 'required|string|max:10',
            'ukuran' => 'required|string|max:10',
            'bahan_baju' => 'required|string|max:50',
            'harga_baju' => 'required|numeric|min:1000',
        ]);

        $baju = new Baju();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $namaFile);
            $baju->gambar = $namaFile;
        }

        $baju->merek_baju = $request->merek_baju;
        $baju->ukuran = $request->ukuran;
        $baju->bahan_baju = $request->bahan_baju;
        $baju->harga_baju = $request->harga_baju;
        $baju->save();

        return redirect()->route('baju.barang');
    }

    function edit($id)
    {
        $baju = Baju::findOrFail($id);
        return view('baju.edit', compact('baju'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'kode_barang' => 'required|string|max:20',
            'merek_baju' => 'required|string|max:100',
            'ukuran' => 'required|string|max:10',
            'bahan_baju' => 'required|string|max:100',
            'harga_baju' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $baju = Baju::findOrFail($id);

        // Update data biasa
        $baju->kode_barang = $request->kode_barang;
        $baju->merek_baju = $request->merek_baju;
        $baju->ukuran = $request->ukuran;
        $baju->bahan_baju = $request->bahan_baju;
        $baju->harga_baju = $request->harga_baju;

        // Update foto jika diupload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($baju->gambar && File::exists(public_path('uploads/' . $baju->gambar))) {
                File::delete(public_path('uploads/' . $baju->gambar));
            }

            // Simpan gambar baru
            $namaFile = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads'), $namaFile);
            $baju->gambar = $namaFile;
        }

        $baju->save();

        return redirect()->route('baju.barang')->with('success', 'Data berhasil diupdate!');
    }

    function hapus($id)
    {
        $pegawai = Baju::find($id);
        $pegawai->delete();

        return redirect()->route('baju.barang');
    }
}
