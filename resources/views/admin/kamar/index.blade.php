@extends('admin.layout.mainLayoutAdmin')

@section('title', 'Manajemen Kamar')

@section('konten')

{{-- PAGE HEADER --}}
<div class="page-header">
    <h1>Manajemen Kamar</h1>
    <p>Kelola data kamar kost secara terpusat</p>
</div>

{{-- ALERT --}}
@if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <strong>Gagal menyimpan data:</strong>
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- CARD: FORM TAMBAH KAMAR --}}
<div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">
            <i class="fas fa-plus-circle me-2 text-primary"></i>Tambah Kamar
        </h5>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.kamar.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">Nomor Kamar</label>
                    <input type="text" name="no_kamar" class="form-control" placeholder="A-101" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Harga per Tahun</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" name="harga" class="form-control" min="0" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="tersedia">Tersedia</option>
                        <option value="tidak tersedia">Tidak Tersedia</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Foto Kamar</label>
                    <input type="file" name="foto_kamar" class="form-control" accept="image/*">
                </div>

                <div class="col-12">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi_kamar" class="form-control" rows="3"
                        placeholder="AC, WiFi, KM dalam, dll"></textarea>
                </div>

                <div class="col-12 text-end">
                    <button class="btn btn-primary px-4">
                        <i class="fas fa-save me-1"></i>Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- CARD: TABEL DATA KAMAR --}}
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-door-open me-2 text-primary"></i>Daftar Kamar
        </h5>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Foto</th>
                        <th>Kamar</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kamar as $item)
                        <tr>
                            <td>
                                @if($item->foto_kamar)
                                    <img src="{{ Storage::disk('s3')->url($item->foto_kamar) }}"
                                         class="rounded"
                                         style="width:70px;height:55px;object-fit:cover">
                                @else
                                    <span class="text-muted small">No Image</span>
                                @endif
                            </td>

                            <td>
                                <strong>{{ $item->no_kamar }}</strong><br>
                                <small class="text-muted">
                                    {{ Str::limit($item->deskripsi_kamar, 40) }}
                                </small>
                            </td>

                            <td class="fw-bold text-primary">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </td>

                            <td>
                                @if($item->status === 'tersedia')
                                    <span class="badge bg-success">Tersedia</span>
                                @else
                                    <span class="badge bg-danger">Penuh</span>
                                @endif
                            </td>

                            <td class="text-end">
                                <a href="{{ route('admin.kamar.show', $item->id_kamar) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.kamar.destroy', $item->id_kamar) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Hapus kamar {{ $item->no_kamar }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Belum ada data kamar
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
