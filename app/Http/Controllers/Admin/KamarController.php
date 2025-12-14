<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KamarController extends Controller
{
    /**
     * GET /admin/kamar
     * Melihat daftar semua kamar (termasuk yang 'non available', 'available').
     */
    public function index()
    {
        $kamar = Kamar::orderBy('created_at', 'desc')->get();
        return view('admin.kamar.index', compact('kamar'));
    }

    /**
     * GET /admin/kamar/{id}
     * Mengambil detail kamar tertentu (untuk view edit/detail).
     */
    public function edit($id)
    {
        $kamar = Kamar::findOrFail($id);
        return view('admin.kamar.edit', compact('kamar'));
    }

    /**
     * POST /admin/kamar
     * Menambah data kamar baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_kamar'         => 'required|string|unique:kamar,no_kamar',
            'foto_kamar'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'deskripsi_kamar'  => 'nullable|string',
            'harga'            => 'required|integer|min:0',
            'status'           => 'required|in:tersedia,tidak tersedia',
        ]);

        if ($request->hasFile('foto_kamar')) {
            $path = $request->file('foto_kamar')->store('kamar', 's3'); 
            $validated['foto_kamar'] = $path;
        }

        Kamar::create($validated);

        return redirect()->route('admin.kamar.index')->with('success', 'Kamar berhasil ditambahkan ke Cloud!');
    }

    /**
     * PUT /admin/kamar/{id}
     * Mengupdate data kamar.
     */
    public function update(Request $request, $id)
    {
        $kamar = Kamar::findOrFail($id);

        $validated = $request->validate([
            'no_kamar'         => "required|string|unique:kamar,no_kamar,$id,id_kamar",
            'foto_kamar'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'deskripsi_kamar'  => 'nullable|string',
            'harga'            => 'required|integer|min:0',
            'status'           => 'required|in:tersedia,tidak tersedia',
        ]);

        if ($request->hasFile('foto_kamar')) {
            if ($kamar->foto_kamar && Storage::disk('s3')->exists($kamar->foto_kamar)) {
                Storage::disk('s3')->delete($kamar->foto_kamar);
            }
            
            $validated['foto_kamar'] = $request->file('foto_kamar')->store('kamar', 's3');
        }

        $kamar->update($validated);

        return redirect()->route('admin.kamar.index')->with('success', 'Data kamar diperbarui!');
    }

    /**
     * DELETE /admin/kamar/{id}
     * Menghapus data kamar.
     */
    public function destroy($id)
    {
        $kamar = Kamar::findOrFail($id);

        if ($kamar->foto_kamar && Storage::disk('s3')->exists($kamar->foto_kamar)) {
            Storage::disk('s3')->delete($kamar->foto_kamar);
        }

        $kamar->delete();

        return redirect()->route('admin.kamar.index')->with('success', 'Kamar dihapus permanen.');
    }
}