@extends('layouts.layout_utama')

@section('content')
<div class="container py-5">
    <h3 class="mb-4">Halaman Pelaporan Keluhan</h3>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="row">
        <!-- Form Membuat Laporan -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">Buat Laporan Baru</div>
                <div class="card-body">

                    <form action="{{ route('pelaporan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Keluhan</label>
                            <input type="text" name="keluhan" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nomor Kamar</label>
                            <input type="text" name="no_kamar" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi Keluhan</label>
                            <textarea name="deskripsi_keluhan" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto Bukti</label>
                            <input type="file" name="foto_bukti" class="form-control" accept="image/*" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Waktu Keluhan</label>
                            <input type="time" name="waktu_keluhan" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Keluhan</label>
                            <input type="date" name="tanggal_keluhan" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Kirim Laporan</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Riwayat Laporan -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">Riwayat Laporan Saya</div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kamar</th>
                                <th>Keluhan</th>
                                <th>Status Admin</th>
                                <th>Status OB</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($pelaporan as $p)
                            <tr>
                                <td>#{{ $p->id_pelaporan }}</td>
                                <td>{{ $p->no_kamar }}</td>
                                <td>{{ $p->keluhan }}</td>
                                <td>
                                    <span class="badge bg-{{ $p->status_admin == 'selesai' ? 'success' : 'warning' }}">
                                        {{ ucfirst($p->status_admin ?? 'pending') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $p->status_ob == 'selesai' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($p->status_ob ?? 'menunggu') }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($p->tanggal_keluhan)->format('d M Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada laporan.</td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
