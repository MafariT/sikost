<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class PembayaranController extends Controller
{

    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }
    /**
     * GET /pembayaran
     * Actor: Penyewa
     * Desc: Menampilkan riwayat pembayaran milik user yang login.
     */
    public function index()
    {
        $userId = Auth::id();

        // Ambil pembayaran dimana booking-nya milik user ini
        $pembayaran = Pembayaran::whereHas('booking', function($query) use ($userId) {
            $query->where('user_id', $userId);
        })->orderBy('created_at', 'desc')->get();

        return view('pembayaran.index', compact('pembayaran'));
    }

    /**
     * POST /pembayaran
     * Actor: Penyewa
     * Desc: Membuat data pembayaran baru (Upload bukti atau Checkout).
     */
   public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:booking,id_booking',
            'total_pembayaran' => 'required|numeric',
            'jenis_pembayaran' => 'required|string', 
        ]);

        $pembayaran = new Pembayaran();
        $pembayaran->booking_id = $request->booking_id;
        $pembayaran->total_pembayaran = $request->total_pembayaran;
        $pembayaran->jenis_pembayaran = $request->jenis_pembayaran;
        $pembayaran->status = 'pending'; 
        $pembayaran->metode_pembayaran = 'Midtrans Gateway';
        $pembayaran->save();

        $orderId = 'PAY-' . $pembayaran->id_pembayaran . '-' . time();
        
        $pembayaran->midtrans_code = $orderId;
        $pembayaran->save();

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $pembayaran->total_pembayaran,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->profile->nama_lengkap ?? 'User',
                'email' => auth()->user()->email,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            
            return view('pembayaran.pay', [
                'snapToken' => $snapToken,
                'pembayaran' => $pembayaran
            ]);

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }

    public function notificationHandler(Request $request)
    {
        \Log::info('Midtrans Webhook Hit:', $request->all());

        $orderId = $request->input('order_id');
        $transactionStatus = $request->input('transaction_status');
        $fraudStatus = $request->input('fraud_status');
        $paymentType = $request->input('payment_type');

        if (empty($orderId)) {
            return response(['message' => 'Invalid Payload: No Order ID'], 400);
        }

        $pembayaran = Pembayaran::where('midtrans_code', $orderId)->first();

        if (!$pembayaran) {
            return response(['message' => 'Order not found'], 404);
        }

        if ($transactionStatus == 'capture') {
            if ($paymentType == 'credit_card') {
                if ($fraudStatus == 'challenge') {
                    $pembayaran->status = 'pending';
                } else {
                    $pembayaran->status = 'verified';
                }
            }
        } else if ($transactionStatus == 'settlement') {
            $pembayaran->status = 'verified';
        } else if ($transactionStatus == 'pending') {
            $pembayaran->status = 'pending';
        } else if ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
            $pembayaran->status = 'failed';
        }

        $pembayaran->metode_pembayaran = $paymentType;
        
        $pembayaran->save();
        
        return response(['message' => 'Payment status updated']);
    }

    /**
     * GET /admin/pembayaran
     * Actor: Admin
     * Desc: Monitoring seluruh pembayaran masuk.
     */
    public function adminIndex()
    {
        $pembayaran = Pembayaran::with(['booking.user', 'booking.kamar'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pembayaran.index', compact('pembayaran'));
    }

    /**
     * GET /pemilik/pembayaran
     * Actor: Pemilik
     * Desc: Laporan keuangan (Bisa sama dengan view admin atau beda view).
     */
    public function pemilikIndex()
    {
        $pembayaran = Pembayaran::with(['booking.kamar'])
            ->where('status', 'verified')
            ->orderBy('created_at', 'desc')
            ->get();

        $totalPendapatan = $pembayaran->sum('total_pembayaran');

        return view('pemilik.pembayaran.laporan', compact('pembayaran', 'totalPendapatan'));
    }
}