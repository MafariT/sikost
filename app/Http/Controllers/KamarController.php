<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    /**
     * GET /kamar
     * Melihat daftar kamar yang tersedia (Filter status='available').
     */
    public function index()
    {
        $kamar = Kamar::where('status', 'tersedia')->get();
        return view('kamar.index', compact('kamar'));
    }

    /**
     * GET /kamar/{id}
     * Mengambil detail kamar tertentu.
     */
    public function show($id)
    {
        $kamar = Kamar::findOrFail($id);
        return view('kamar.show', compact('kamar'));
    }
}