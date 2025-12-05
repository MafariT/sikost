<?php

namespace App\Http\Controllers\Penyewa;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * GET /profile
     * Mengambil Data Profile dan Verifikasi Data Penyewa Sebelum Booking
     */
    public function index()
    {
        $user = Auth::user();

        $profile = Profile::firstOrCreate(
            ['user_id' => $user->id],
            [
                'nik' => null,
                'nama_lengkap' => $user->email,
                'alamat' => null,
                'no_hp' => null,
                'jenis_kelamin' => null,
                'tempat_tanggal_lahir' => null,
                'foto_profile' => null,
                'foto_ktp' => null,
            ]
        );

        return view('penyewa.profile', compact('profile'));
    }

    /**
     * PUT /profile
     * Upload dan Update data diri/profil pengguna.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $profile = Profile::firstOrCreate(['user_id' => $user->id]);

        $validated = $request->validate([
            'email'        => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],

            'nik'          => 'required|numeric|digits:16',
            'nama_lengkap' => 'required|string|max:255',
            'alamat'       => 'nullable|string',
            'no_hp'        => 'nullable|string|max:20',
            'jenis_kelamin' => 'nullable|in:laki-laki,perempuan',
            'tempat_tanggal_lahir' => 'nullable|string|max:255',
            
            'foto_profile' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'foto_ktp'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($validated['email'] !== $user->email) {
            $user->email = $validated['email'];
            $user->save();
        }


        if ($request->hasFile('foto_profile')) {
            if ($profile->foto_profile && Storage::disk('s3')->exists($profile->foto_profile)) {
                Storage::disk('s3')->delete($profile->foto_profile);
            }

            $path = $request->file('foto_profile')->storeAs(
                'avatars', 
                'user_' . $user->id . '_' . time() . '.' . $request->file('foto_profile')->extension(),
                's3'
            );
            
            $profile->foto_profile = $path;
        }

        if ($request->hasFile('foto_ktp')) {
            if ($profile->foto_ktp && Storage::disk('s3')->exists($profile->foto_ktp)) {
                Storage::disk('s3')->delete($profile->foto_ktp);
            }

            $pathKtp = $request->file('foto_ktp')->storeAs(
                'documents', 
                'ktp_' . $user->id . '_' . time() . '.' . $request->file('foto_ktp')->extension(),
                's3'
            );

            $profile->foto_ktp = $pathKtp;
        }

        $profile->nik = $validated['nik'];
        $profile->nama_lengkap = $validated['nama_lengkap'];
        $profile->alamat = $validated['alamat'];
        $profile->no_hp = $validated['no_hp'];
        $profile->jenis_kelamin = $validated['jenis_kelamin'];
        $profile->tempat_tanggal_lahir = $validated['tempat_tanggal_lahir'];
        
        $profile->save();

        return back()->with('success', 'Data profil berhasil diperbarui');
    }
}