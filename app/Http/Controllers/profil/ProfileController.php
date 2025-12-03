<?php

namespace App\Http\Controllers\profil;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        $profile = Profile::firstOrCreate(
            ['user_id' => $user->id],
            [
                'nama_lengkap' => null,
                'alamat' => null,
                'no_hp' => null,
                'jenis_kelamin' => null,
                'tempat_tanggal_lahir' => null,
                'foto_profile' => null,
                'foto_ktp' => null,
            ]
        );

        return view('profil.index', compact('profile'));
    }

    public function update(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        $validated = $request->validate([
            'nama_lengkap' => ['nullable', 'string', 'max:255'],
            'alamat' => ['nullable', 'string'],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'jenis_kelamin' => ['nullable', 'string', 'max:10'],
            'tempat_tanggal_lahir' => ['nullable', 'string', 'max:255'],

            'foto_profile' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'foto_ktp' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
        ]);

        $profile = Profile::firstOrCreate(['user_id' => $user->id]);

        // upload (lokal storage/public)
        if ($request->hasFile('foto_profile')) {
            $path = $request->file('foto_profile')->store("profiles/{$user->id}", 'public');
            $validated['foto_profile'] = $path;
        }

        if ($request->hasFile('foto_ktp')) {
            $path = $request->file('foto_ktp')->store("ktp/{$user->id}", 'public');
            $validated['foto_ktp'] = $path;
        }

        $profile->fill($validated);
        $profile->save();

        return back()->with('success', 'Profil berhasil disimpan.');
    }
}
