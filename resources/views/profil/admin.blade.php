<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Data Penyewa</title>
</head>
<body style="font-family: Arial; background:#f6f7fb; margin:0;">
  <div style="max-width:1000px; margin:24px auto; background:#fff; padding:18px; border-radius:14px; border:1px solid #e5e7eb;">
    <h2 style="margin:0 0 12px;">Admin • Data Profil Penyewa</h2>

    @if (session('success'))
      <div style="padding:10px; background:#e7ffe7; border:1px solid #b6f2b6; border-radius:10px; margin-bottom:12px;">
        {{ session('success') }}
      </div>
    @endif
    @if (session('error'))
      <div style="padding:10px; background:#ffe7e7; border:1px solid #f2b6b6; border-radius:10px; margin-bottom:12px;">
        {{ session('error') }}
      </div>
    @endif

    <form method="GET" action="{{ route('admin.profiles.index') }}" style="display:flex; gap:10px; margin-bottom:12px;">
      <input name="q" value="{{ $q }}" placeholder="Cari nama / no hp / email"
             style="flex:1; padding:10px; border:1px solid #e5e7eb; border-radius:10px;">
      <button style="padding:10px 14px; border:0; border-radius:10px; background:#111827; color:#fff;">Cari</button>
    </form>

    <table width="100%" cellpadding="10" style="border-collapse:collapse;">
      <thead>
        <tr style="background:#f3f4f6; text-align:left;">
          <th>Nama</th>
          <th>Email</th>
          <th>No HP</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($profiles as $p)
          <tr style="border-bottom:1px solid #e5e7eb;">
            <td>{{ $p->nama_lengkap ?? '-' }}</td>
            <td>{{ $p->user->email ?? '-' }}</td>
            <td>{{ $p->no_hp ?? '-' }}</td>
            <td>
              @if(($p->user->is_active ?? true) === true)
                <span style="padding:4px 8px; border-radius:999px; background:#e7ffe7; border:1px solid #b6f2b6;">Active</span>
              @else
                <span style="padding:4px 8px; border-radius:999px; background:#ffe7e7; border:1px solid #f2b6b6;">Inactive</span>
              @endif
            </td>
            <td style="display:flex; gap:8px;">
              <a href="{{ route('admin.profiles.show', $p->id_profile) }}"
                 style="text-decoration:none; padding:8px 10px; border-radius:10px; background:#eef2ff; border:1px solid #c7d2fe;">
                 Detail
              </a>

              @if($p->user)
              <form method="POST" action="{{ route('admin.users.toggle', $p->user->id) }}">
                @csrf
                <button type="submit"
                        style="padding:8px 10px; border:0; border-radius:10px; background:#111827; color:#fff;">
                  Toggle
                </button>
              </form>
              @endif
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" style="padding:12px; color:#6b7280;">Tidak ada data.</td>
          </tr>
        @endforelse
      </tbody>
    </table>

    <div style="margin-top:12px;">
      {{ $profiles->links() }}
    </div>
  </div>
</body>
</html>
