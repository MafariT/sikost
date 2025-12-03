<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>
<body style="font-family: Arial; background:#f6f7fb; margin:0;">
    <div style="max-width:760px; margin:24px auto; background:#fff; padding:18px; border-radius:14px; border:1px solid #e5e7eb;">
        <h2 style="margin:0 0 6px;">Profil Saya</h2>
        <p style="margin:0 0 16px; color:#6b7280; font-size:14px;">Lengkapi data profil untuk kebutuhan booking/check-in.</p>

        @if (session('success'))
            <div style="padding:10px; background:#e7ffe7; border:1px solid #b6f2b6; border-radius:10px; margin-bottom:12px;">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div style="padding:10px; background:#ffe7e7; border:1px solid #f2b6b6; border-radius:10px; margin-bottom:12px;">
                <ul style="margin:0; padding-left:18px;">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('profil.update') }}" enctype="multipart/form-data" style="display:grid; gap:12px;">
            @csrf

            <label>
                Nama Lengkap
                <input name="nama_lengkap" value="{{ old('nama_lengkap', $profile->nama_lengkap) }}"
                       style="width:100%; padding:10px; margin-top:6px; border:1px solid #e5e7eb; border-radius:10px;">
            </label>

            <label>
                Alamat
                <textarea name="alamat" rows="3"
                          style="width:100%; padding:10px; margin-top:6px; border:1px solid #e5e7eb; border-radius:10px;">{{ old('alamat', $profile->alamat) }}</textarea>
            </label>

            <label>
                No HP
                <input name="no_hp" value="{{ old('no_hp', $profile->no_hp) }}"
                       style="width:100%; padding:10px; margin-top:6px; border:1px solid #e5e7eb; border-radius:10px;">
            </label>

            <label>
                Jenis Kelamin (pria/wanita)
                <input name="jenis_kelamin" value="{{ old('jenis_kelamin', $profile->jenis_kelamin) }}"
                       style="width:100%; padding:10px; margin-top:6px; border:1px solid #e5e7eb; border-radius:10px;">
            </label>

            <label>
                Tempat, Tanggal Lahir
                <input name="tempat_tanggal_lahir" value="{{ old('tempat_tanggal_lahir', $profile->tempat_tanggal_lahir) }}"
                       style="width:100%; padding:10px; margin-top:6px; border:1px solid #e5e7eb; border-radius:10px;">
            </label>

            <div style="display:grid; gap:8px;">
                <div>Foto Profile (opsional)</div>
                @if ($profile->foto_profile)
                    <img src="{{ asset('storage/' . $profile->foto_profile) }}" style="max-width:160px; border-radius:12px; border:1px solid #e5e7eb;">
                @endif
                <input type="file" name="foto_profile" accept="image/*">
            </div>

            <div style="display:grid; gap:8px;">
                <div>Foto KTP (opsional)</div>
                @if ($profile->foto_ktp)
                    <img src="{{ asset('storage/' . $profile->foto_ktp) }}" style="max-width:240px; border-radius:12px; border:1px solid #e5e7eb;">
                @endif
                <input type="file" name="foto_ktp" accept="image/*">
            </div>

            <button type="submit"
                    style="padding:10px 14px; border:0; border-radius:12px; background:#111827; color:#fff; cursor:pointer;">
                Simpan Profil
            </button>
        </form>
    </div>
</body>
</html>
