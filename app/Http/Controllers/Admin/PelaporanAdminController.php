<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelaporan;

class PelaporanAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pelaporan::with(['user.profile']);

        // Simple Filter Logic
        if ($request->has('status') && $request->status != '') {
            $query->where('status_admin', $request->status);
        }

        $pelaporan = $query->orderBy('created_at', 'desc')->paginate(10); 

        $pelaporan->appends($request->all());

        return view('admin.pelaporan.index', compact('pelaporan'));
    }

    /**
     * PATCH /admin/pelaporan/{id}
     * Admin memverifikasi laporan (Verified / Rejected).
     */
    public function updateStatusAdmin(Request $request, $id)
    {
        $request->validate([
            'status_admin' => 'required|in:verified,rejected,pending',
        ]);

        $pelaporan = Pelaporan::findOrFail($id);
        $pelaporan->status_admin = $request->status_admin;

        if ($request->status_admin == 'rejected') {
            $pelaporan->status_ob = 'batal';
        }

        $pelaporan->save();

        return redirect()->back()->with('success', 'Status laporan berhasil diperbarui.');
    }
}
