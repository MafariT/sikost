<?php

namespace App\Http\Controllers;

use App\Models\Pelaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelaporanController extends Controller
{
    /**
     * Menampilkan daftar pelaporan milik user yang sedang login.
     */
    public function index()
    {
        $userId = Auth::id(); // ambil user_id dari session login

        $pelaporan = Pelaporan::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('penyewa.pelaporan', compact('pelaporan'));
    }

    /**
     * Menyimpan data pelaporan baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'keluhan' => 'required|string',
            'lokasi' => 'required|string',
            'bukti_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['keluhan', 'lokasi']);
        $data['user_id'] = Auth::id();

        // Jika ada foto bukti
        if ($request->hasFile('bukti_foto')) {
            $data['bukti_foto'] = $request->file('bukti_foto')->store('pelaporan', 'public');
        }

        Pelaporan::create($data);

        return redirect()->back()->with('success', 'Pelaporan berhasil dikirim!');
    }

    /**
     * Menampilkan detail pelaporan tertentu
     */
    public function show($id)
    {
        $pelaporan = Pelaporan::where('id', $id)
            ->where('user_id', Auth::id()) // hanya bisa lihat laporan miliknya sendiri
            ->firstOrFail();

        return view('pelaporan.show', compact('pelaporan'));
    }

    /**
     * Update pelaporan
     */
    public function update(Request $request, $id)
    {
        $pelaporan = Pelaporan::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'keluhan' => 'required|string',
            'lokasi' => 'required|string',
            'bukti_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $pelaporan->keluhan = $request->keluhan;
        $pelaporan->lokasi = $request->lokasi;

        if ($request->hasFile('bukti_foto')) {
            $pelaporan->bukti_foto = $request->file('bukti_foto')->store('pelaporan', 'public');
        }

        $pelaporan->save();

        return redirect()->back()->with('success', 'Pelaporan berhasil diperbarui!');
    }

    /**
     * Hapus pelaporan
     */
    public function destroy($id)
    {
        $pelaporan = Pelaporan::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $pelaporan->delete();

        return redirect()->back()->with('success', 'Pelaporan berhasil dihapus!');
    }
}
