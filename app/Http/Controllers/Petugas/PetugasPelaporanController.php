<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelaporan;
use Illuminate\Support\Facades\Storage;

class PetugasPelaporanController extends Controller
{
    /**
     * GET /petugas/keluhan
     * Petugas hanya melihat laporan yang SUDAH diverifikasi Admin.
     */
    public function index()
    {
        $pelaporan = Pelaporan::where('status_admin', 'verified')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('petugas.index', compact('pelaporan'));
    }

    /**
     * GET /petugas/keluhan/{id}
     * Detail untuk Petugas
     */
    public function show($id)
    {
        $pelaporan = Pelaporan::where('id_pelaporan', $id)
            ->where('status_admin', 'verified')
            ->firstOrFail();

        return view('petugas.show', compact('pelaporan'));
    }

    /**
     * PATCH /petugas/keluhan/{id}
     * Update status & upload foto perbaikan
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_ob' => 'required|in:pending,proses,selesai',
            'foto_after_perbaikan' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $pelaporan = Pelaporan::findOrFail($id);
        $pelaporan->status_ob = $request->status_ob;

        if ($request->hasFile('foto_after_perbaikan')) {
            if ($pelaporan->foto_after_perbaikan && Storage::disk('s3')->exists($pelaporan->foto_after_perbaikan)) {
                Storage::disk('s3')->delete($pelaporan->foto_after_perbaikan);
            }

            $path = $request->file('foto_after_perbaikan')->store('perbaikan', 's3');
            $pelaporan->foto_after_perbaikan = $path;
        }

        $pelaporan->save();

        return redirect()->back()->with('success', 'Status pekerjaan berhasil diperbarui.');
    }
}
