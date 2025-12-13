<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Detail Keluhan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
:root{
    --primary:#334EAC;
    --secondary:#7096D1;
    --soft:#BAD6EB;
    --light:#EDF1F6;
    --dark:#081F5C;
    --text:#020617;
}

/* ================= BASE ================= */
body{
    margin:0;
    font-family:"Segoe UI",sans-serif;
    background:
        radial-gradient(circle at 15% 10%, var(--soft), transparent 35%),
        radial-gradient(circle at 85% 85%, var(--secondary), transparent 40%),
        linear-gradient(135deg, #f6f8fc, var(--light));
    min-height:100vh;
}

/* ================= SIDEBAR (DESKTOP) ================= */
.sidebar{
    width:260px;
    height:100vh;
    position:fixed;
    background:linear-gradient(180deg,var(--dark),#050e2d);
    padding:60px 30px;
    color:#fff;
    box-shadow:8px 0 30px rgba(0,0,0,.35);
}

.sidebar-title{
    font-size:38px;
    font-weight:900;
}
.sidebar-title::after{
    content:"";
    width:70px;
    height:5px;
    background:var(--secondary);
    display:block;
    margin-top:18px;
    border-radius:999px;
}

.sidebar-sub{
    font-size:14px;
    color:rgba(255,255,255,.7);
    margin-top:6px;
}

.sidebar-info{
    margin-top:28px;
    background:rgba(255,255,255,0.08);
    border-radius:18px;
    padding:18px;
    font-size:14px;
}

.sidebar-footer{
    position:absolute;
    bottom:30px;
    left:30px;
    right:30px;
}

.btn-logout{
    width:100%;
    background:rgba(255,255,255,0.08);
    border:1px solid rgba(255,255,255,0.25);
    color:#fff;
    padding:14px;
    border-radius:18px;
    font-weight:700;
}

/* ================= CONTENT ================= */
.content{
    margin-left:260px;
    padding:70px 90px;
    max-width:1600px;
}

/* ================= HEADER ================= */
.page-header{
    display:flex;
    justify-content:space-between;
    align-items:flex-end;
    margin-bottom:40px;
}

.page-title{
    font-size:42px;
    font-weight:900;
    color:var(--dark);
}

.page-sub{
    font-size:15px;
    color:#64748b;
}

/* ================= CARD ================= */
.detail-card{
    background:linear-gradient(180deg,#ffffff,var(--light));
    border-radius:30px;
    padding:40px;
    box-shadow:0 18px 40px rgba(0,0,0,.12);
}

.info-label{
    font-size:14px;
    color:#6b7280;
    margin-bottom:4px;
}
.info-value{
    font-size:20px;
    font-weight:800;
    color:var(--text);
}

/* ================= IMAGE ================= */
.img-preview{
    width:100%;
    max-height:420px;
    object-fit:cover;
    border-radius:26px;
    box-shadow:0 18px 35px rgba(0,0,0,.18);
    cursor:pointer;
}

.empty-image{
    height:260px;
    border-radius:26px;
    background:repeating-linear-gradient(
        45deg,
        #e5e7eb,
        #e5e7eb 12px,
        #f3f4f6 12px,
        #f3f4f6 24px
    );
    display:flex;
    align-items:center;
    justify-content:center;
    color:#6b7280;
    font-weight:600;
}

/* ================= FORM ================= */
.form-select,.form-control{
    border-radius:16px;
    font-size:16px;
}
.btn-save{
    background:linear-gradient(135deg,var(--primary),var(--secondary));
    border:none;
    border-radius:18px;
    padding:14px 36px;
    font-size:18px;
    font-weight:800;
    color:white;
}

/* ===================================================
   RESPONSIVE — SELARAS DENGAN LAPORAN.BLADE
=================================================== */

/* TABLET & MOBILE */
@media(max-width:992px){

    .sidebar{
        width:100%;
        height:auto;
        position:relative;
        padding:24px 20px 18px;
        border-bottom:1px solid rgba(255,255,255,0.12);
        box-shadow:0 6px 18px rgba(0,0,0,.25);
    }

    .sidebar-info{
        display:none;
    }

    .sidebar-footer{
        position:relative;
        margin-top:16px;
    }

    .content{
        margin-left:0;
        padding:32px 18px 24px;
    }

    .page-header{
        flex-direction:column;
        align-items:flex-start;
        gap:10px;
        margin-top:12px;
        margin-bottom:28px;
    }

    .page-title{
        font-size:26px;
        line-height:1.2;
    }
}

/* MOBILE KECIL */
@media(max-width:576px){

    .content{
        padding:28px 16px 22px;
    }

    .detail-card{
        padding:24px;
        border-radius:22px;
    }

    .info-value{
        font-size:17px;
    }
}

/* EXTRA SMALL */
@media(max-width:360px){

    .page-title{
        font-size:22px;
    }

    .info-value{
        font-size:16px;
    }
}

/* ===== MOBILE SIDEBAR FIX (FINAL & STABLE) ===== */
@media (max-width: 992px) {

    .sidebar {
        display: grid;
        grid-template-rows: auto 1fr auto;
        width: 100%;
        height: auto;
        position: relative;
        padding: 20px;
        gap: 6px;
        border-bottom: 1px solid rgba(255,255,255,0.15);
        box-shadow: 0 6px 18px rgba(0,0,0,.25);
    }

    .sidebar-info {
        display: none;
    }

    .sidebar-footer {
        position: static;
        padding-top: 10px;
    }

    .btn-logout {
        width: 100%;
        text-align: center;
    }
}


</style>
</head>

<body>

<!-- SIDEBAR -->
<aside class="sidebar">
    <div style="font-size:38px; font-weight:900; margin-bottom: 20px;">🛠 Petugas</div>

    <div style="background:rgba(255,255,255,0.1); padding:15px; border-radius:15px; font-size:14px; margin-bottom: 40px;">
        <strong>Petugas</strong><br> {{ Auth::user()->email }}
    </div>

    <form method="POST" action="{{ route('logout') }}" style="margin-top: auto;">
        @csrf
        <button type="submit" class="btn-logout">🚪 Logout</button>
    </form>
</aside>

<!-- CONTENT -->
<section class="content">

    <!-- ALERTS -->
    @if(session('success'))
        <div class="alert alert-success border-0 rounded-4 mb-4 shadow-sm">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="page-header">
        <div>
            <div class="page-title">Detail Keluhan</div>
            <div style="color:#64748b;">Informasi lengkap pekerjaan</div>
        </div>
        <a href="{{ route('petugas.pelaporan.index') }}" class="btn btn-secondary rounded-pill px-4 fw-bold">
            ⬅ Kembali
        </a>
    </div>

    <div class="detail-card">
        <!-- INFO -->
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="info-label">Judul Keluhan</div>
                <div class="info-value">{{ $pelaporan->keluhan }}</div>
            </div>

            <div class="col-md-6">
                <div class="info-label">No Kamar</div>
                <div class="info-value">{{ $pelaporan->no_kamar }}</div>
            </div>

            <div class="col-md-6">
                <div class="info-label">Waktu Laporan</div>
                <div class="info-value">
                    {{ \Carbon\Carbon::parse($pelaporan->tanggal_keluhan ?? $pelaporan->created_at)->timezone('Asia/Jakarta')->format('d-m-Y') }}, {{ $pelaporan->waktu_keluhan ? \Carbon\Carbon::parse($pelaporan->waktu_keluhan)->timezone('Asia/Jakarta')->format('H:i') : \Carbon\Carbon::parse($p->created_at)->timezone('Asia/Jakarta')->format('H:i') }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-label">Status Pekerjaan</div>
                <span class="badge
                    @if($pelaporan->status_ob == 'pending') bg-secondary
                    @elseif($pelaporan->status_ob == 'proses') bg-warning text-dark
                    @else bg-success @endif
                    px-3 py-2 fs-6">
                    {{ ucfirst($pelaporan->status_ob) }}
                </span>
            </div>

            <div class="col-12">
                <div class="info-label">Deskripsi Masalah</div>
                <div class="info-value p-3 bg-light rounded-3" style="font-size: 16px; font-weight: normal;">
                    {{ $pelaporan->deskripsi_keluhan }}
                </div>
            </div>
        </div>

        <!-- FOTO -->
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="info-label mb-2">Foto Bukti (Dari Penyewa)</div>
                @if($pelaporan->foto_bukti)
                    <img src="{{ Storage::disk('s3')->url($pelaporan->foto_bukti) }}" class="img-preview" onclick="window.open(this.src)">
                @else
                    <div class="p-5 bg-light rounded text-center text-muted">Tidak ada foto bukti</div>
                @endif
            </div>

            <div class="col-md-6">
                <div class="info-label mb-2">Foto Hasil Perbaikan (Wajib jika selesai)</div>
                @if($pelaporan->foto_after_perbaikan)
                    <img src="{{ Storage::disk('s3')->url($pelaporan->foto_after_perbaikan) }}" class="img-preview mb-2" onclick="window.open(this.src)">
                    <div class="text-success small fw-bold"><i class="fas fa-check"></i> Foto tersimpan</div>
                @else
                    <div class="p-5 bg-light rounded text-center text-muted mb-2">Belum ada foto perbaikan</div>
                @endif
            </div>
        </div>

        <hr class="my-4">

        <!-- FORM UPDATE -->
        <form action="{{ route('petugas.pelaporan.update', $pelaporan->id_pelaporan) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="row align-items-end g-3">
                <div class="col-md-4">
                    <label class="info-label">Update Status</label>
                    <select name="status_ob" class="form-select form-select-lg">
                        <option value="pending" {{ $pelaporan->status_ob == 'pending' ? 'selected' : '' }}>Pending (Belum Dikerjakan)</option>
                        <option value="proses" {{ $pelaporan->status_ob == 'proses' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                        <option value="selesai" {{ $pelaporan->status_ob == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <div class="col-md-5">
                    <label class="info-label">Upload Bukti Perbaikan</label>
                    <input type="file" name="foto_after_perbaikan" class="form-control form-control-lg">
                </div>

                <div class="col-md-3">
                    <button type="submit" class="btn-save w-100">Simpan</button>
                </div>
            </div>
        </form>

    </div>
</section>

</body>
</html>
