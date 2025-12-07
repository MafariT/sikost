<?php

namespace App\Http\Controllers\Penyewa;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();

        if (!$profile) {
            return redirect()->route('profile.index');
        }

        $query = Booking::query()
            ->with(['kamar', 'pembayaran'])
            ->where('profile_id', $profile->id_profile);

        if ($request->has('status') && $request->status != 'all') {
            $statusMap = [
                'menunggu_pelunasan' => ['dp_50'],
                'lunas' => ['lunas'],
                'tidak_aktif' => ['cancel', 'selesai', 'menunggu_pembayaran']
            ];

            if (isset($statusMap[$request->status])) {
                $query->whereIn('status_booking', $statusMap[$request->status]);
            }
        }

        // Search Logic
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id_booking', 'like', "%{$search}%")
                  ->orWhereHas('kamar', function($k) use ($search) {
                      $k->where('no_kamar', 'ilike', "%{$search}%");
                  });
            });
        }

        $bookings = $query->orderBy('created_at', 'desc')->paginate(5);
        $bookings->appends($request->all());

        return view('penyewa.riwayat', compact('bookings'));
    }
}
