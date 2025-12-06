<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    /**
     * GET /admin/booking
     * Menampilkan seluruh data booking
     */
    public function index()
    {
        $bookings = Booking::with(['profile.user', 'kamar'])
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('admin.booking.index', compact('bookings'));
    }
    
    /**
     * GET /admin/booking/{id}
     * Detail booking untuk admin
     */
    public function show($id)
    {
        $booking = Booking::with(['profile', 'kamar'])->findOrFail($id);
        return view('admin.booking.show', compact('booking'));
    }
}