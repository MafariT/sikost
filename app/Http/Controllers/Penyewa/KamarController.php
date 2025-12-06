<?php

namespace App\Http\Controllers\Penyewa;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
    {
        $query = Kamar::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('no_kamar', 'ilike', "%{$search}%")
                  ->orWhere('deskripsi_kamar', 'ilike', "%{$search}%");
            });
        }

        if ($request->filled('ketersediaan')) {
            if ($request->ketersediaan == 'available') {
                $query->where('status', 'tersedia');
            } elseif ($request->ketersediaan == 'unavailable') {
                $query->where('status', 'tidak tersedia');
            }
        }

        if ($request->filled('min_price')) {
            $query->where('harga', '>=', $request->min_price);
        }

        $kamar = $query->orderBy('status', 'desc')
                       ->orderBy('no_kamar', 'asc')
                       ->paginate(9);

        $kamar->appends($request->all());

        return view('penyewa.kamar', compact('kamar'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kamar = Kamar::findOrFail($id);
        return view('kamar.show', compact('kamar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
