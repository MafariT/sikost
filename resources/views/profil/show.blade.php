<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Detail Profil</title>
</head>
<body style="font-family: Arial; background:#f6f7fb; margin:0;">
  <div style="max-width:900px; margin:24px auto; background:#fff; padding:18px; border-radius:14px; border:1px solid #e5e7eb;">
    <a href="{{ route('admin.profiles.index') }}" style="text-decoration:none;">← Kembali</a>
    <h2 style="margin:10px 0 12px;">Detail Profil</h2>

    @if (session('success'))
      <div style="padding:10px; background:#e7ffe7; border:1px solid #b6f2b6; border-radius:10px; margin-bottom:12px;">
        {{ session('success') }}
      </div>
    @endif

    <div style="display:grid; grid-template-columns: 1fr 1fr; gap:12px;">
      <div style="padding:12px; border:1px solid #e5e7eb; border-radius:12px;">
        <div><b>Nama:</b> {{ $profile->nama_lengkap ?? '-' }}</div>
        <div><b>Email:</b> {{ $profile->user->email ?? '-' }}</div>
        <div><b>No HP:</b> {{ $profile->no_hp ?? '-' }}</div>
        <div><b>Jenis Kelamin:</b> {{ $profile->jenis_kelamin ?? '-' }}</div>
        <div><b>TTL:</b> {{ $profile->tempat_tanggal_lahir ?? '-' }}</div>
        <div><b>Alamat:</b> {{ $profile->alamat ?? '-' }}</div>
        <div style="margin-top:8px;">
          <b>Status Akun:</b>
          @if(($profile->user->is_active ?? true) === true)
            <span style="padding:4px 8px; border-radius:999px; background:#e7ffe7; border:1px solid #b6f2b6;">Active</span>
          @else
            <span style="padding:4px 8px; border-radius:999px; background:#ffe7e7; border:1px solid #f2b6b6;">Inactive</span>
          @endif
        </div>

        @if($profile->user)
        <form method="POST" action="{{ route('admin.users.toggle', $profile->user->id) }}" style="margin-top:12px;">
          @csrf
          <button type="submit" style="padding:10px 14px; border:0; border-radius:12px; background:#111827; color:#fff;">
            Toggle Active/Inactive
          </button>
        </form>
        @endif
      </div>

      <div style="display:grid; gap:12px;">
        <div style="padding:12px; border:1px solid #e5e7eb; border-radius:12px;">
          <b>Foto Profile</b><br>
          @if($profile->foto_profile)
            <img src="{{ asset('storage/'.$profile->foto_profile) }}" style="max-width:100%; border-radius:12px; border:1px solid #e5e7eb; margin-top:8px;">
          @else
            <div style="color:#6b7280; margin-top:8px;">Tidak ada.</div>
          @endif
        </div>

        <div style="padding:12px; border:1px solid #e5e7eb; border-radius:12px;">
          <b>Foto KTP</b><br>
          @if($profile->foto_ktp)
            <img src="{{ asset('storage/'.$profile->foto_ktp) }}" style="max-width:100%; border-radius:12px; border:1px solid #e5e7eb; margin-top:8px;">
          @else
            <div style="color:#6b7280; margin-top:8px;">Tidak ada.</div>
          @endif
        </div>
      </div>
    </div>
  </div>
</body>
</html>
