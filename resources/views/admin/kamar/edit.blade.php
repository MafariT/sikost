@extends('admin.layout.mainLayoutAdmin')

@section('title', 'Edit Kamar')

@section('konten')

<div class="page-header">
    <h1>Edit Kamar</h1>
    <p>Ubah data kamar</p>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.kamar.update', $kamar->id_kamar) }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">Nomor Kamar</label>
                    <input type="text" name="no_kamar"
                           class="form-control"
                           value="{{ old('no_kamar', $kamar->no_kamar) }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Harga per Tahun</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" name="harga"
                               class="form-control"
                               value="{{ old('harga', $kamar->harga) }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="tersedia" {{ $kamar->status == 'tersedia' ? 'selected' : '' }}>
                            Tersedia
                        </option>
                        <option value="tidak tersedia" {{ $kamar->status == 'tidak tersedia' ? 'selected' : '' }}>
                            Tidak Tersedia
                        </option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Foto Kamar</label>
                    <input type="file" name="foto_kamar" class="form-control">
                    <small class="text-muted">Kosongkan jika tidak diganti</small>
                </div>

                <div class="col-12">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi_kamar" class="form-control"
                              rows="3">{{ old('deskripsi_kamar', $kamar->deskripsi_kamar) }}</textarea>
                </div>

                <div class="col-12 text-end">
                    <a href="{{ route('admin.kamar.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                    <button class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Update
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

@endsection
