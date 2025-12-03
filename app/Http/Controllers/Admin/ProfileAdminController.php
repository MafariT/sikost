<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileAdminController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $profiles = Profile::query()
            ->with('user:id,email,role,is_active')
            ->when($q !== '', function ($query) use ($q) {
                $query->where('nama_lengkap', 'ilike', "%{$q}%")
                    ->orWhere('no_hp', 'ilike', "%{$q}%")
                    ->orWhereHas('user', fn ($u) => $u->where('email', 'ilike', "%{$q}%"));
            })
            ->orderByDesc('updated_at')
            ->paginate(10)
            ->withQueryString();

        // ✅ arahkan ke resources/views/profil/admin.blade.php
        return view('profil.admin', compact('profiles', 'q'));
    }

    public function show($id_profile)
    {
        $profile = Profile::with('user:id,email,role,is_active')
            ->where('id_profile', $id_profile)
            ->firstOrFail();

        // ✅ arahkan ke resources/views/profil/show.blade.php
        return view('profil.show', compact('profile'));
    }

    public function toggleUser($userId)
    {
        $user = User::findOrFail($userId);

        if (auth()->id() === $user->id) {
            return back()->with('error', 'Tidak bisa menonaktifkan akun sendiri.');
        }

        $user->is_active = !$user->is_active;
        $user->save();

        return back()->with('success', $user->is_active ? 'Akun diaktifkan.' : 'Akun dinonaktifkan.');
    }
}
