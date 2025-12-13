<?php

namespace App\Http\Controllers\Penyewa;

use App\Models\Pelaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class PelaporanController extends Controller
{
    /**
     * GET /pelaporan
     * Menampilkan riwayat pelaporan milik user.
     */
    public function index()
    {
        $userId = Auth::id();

        $pelaporan = Pelaporan::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('penyewa.pelaporan', compact('pelaporan'));
    }

    /**
     * POST /pelaporan
     * Penyewa membuat laporan keluhan.
     */
    public function store(Request $request)
    {
        $request->validate([
            'keluhan'           => 'required|string|max:255',
            'deskripsi_keluhan' => 'required|string',
            'no_kamar'          => 'required|string|max:10',
            'foto_bukti'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $data = [
            'user_id'           => Auth::id(),
            'keluhan'           => $request->keluhan,
            'deskripsi_keluhan' => $request->deskripsi_keluhan,
            'no_kamar'          => $request->no_kamar,
            'tanggal_keluhan'   => now()->toDateString(),
            'waktu_keluhan'     => now()->toTimeString(),
            'status_admin'      => 'pending',
            'status_ob'         => 'pending',
        ];

        if ($request->hasFile('foto_bukti')) {
            $path = $request->file('foto_bukti')->store('bukti', 's3');
            $data['foto_bukti'] = $path;
        }

        Pelaporan::create($data);

        return redirect()->back()->with('success', 'Laporan berhasil dikirim! Menunggu verifikasi Admin.');
    }

    /**
     * GET /ob/pelaporan
     * OB melihat laporan yang SUDAH diverifikasi Admin.
     */
    public function indexOb()
    {
        $pelaporan = Pelaporan::where('status_admin', 'verified')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('ob.pelaporan.index', compact('pelaporan'));
    }

    /**
     * PATCH /ob/pelaporan/{id}
     * OB update status pengerjaan & upload bukti perbaikan.
     */
    public function updateStatusOB(Request $request, $id)
    {
        $request->validate([
            'status_ob' => 'required|in:proses,selesai',
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

        return redirect()->back()->with('success', 'Laporan pekerjaan berhasil diupdate.');
    }
}
