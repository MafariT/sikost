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
    <div class="sidebar-title">🛠 Petugas</div>
    <div class="sidebar-sub">Sistem Keluhan Kos</div>

    <div class="sidebar-info">
        <strong>Peran</strong>
        <div>Petugas Kos</div>

        <strong class="mt-3">Akses</strong>
        <div>Monitoring & Penanganan Keluhan</div>
    </div>

    <div class="sidebar-footer">
        <a href="#" class="btn btn-logout">🚪 Logout</a>
    </div>
</aside>

<!-- CONTENT -->
<section class="content">

    <div class="page-header">
        <div>
            <div class="page-title">Detail Keluhan</div>
            <div class="page-sub">Informasi lengkap laporan warga</div>
        </div>
        <a href="/petugas/keluhan" class="btn btn-secondary fw-bold rounded-pill px-4">
            ⬅ Kembali
        </a>
    </div>

    <div class="detail-card">

        <!-- INFO -->
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="info-label">Judul Keluhan</div>
                <div class="info-value">{{ $keluhan->judul_keluhan }}</div>
            </div>

            <div class="col-md-6">
                <div class="info-label">No Kamar</div>
                <div class="info-value">{{ $keluhan->no_kamar }}</div>
            </div>

            <div class="col-md-6">
                <div class="info-label">Tanggal & Waktu</div>
                <div class="info-value">
                    {{ $keluhan->tanggal_keluhan ?? '-' }} {{ $keluhan->waktu_keluhan ?? '' }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-label">Status</div>
                <span class="badge
                    @if($keluhan->status=='Pending') bg-danger
                    @elseif($keluhan->status=='Diproses') bg-warning text-dark
                    @else bg-success @endif
                    px-3 py-2 fs-6">
                    {{ $keluhan->status }}
                </span>
            </div>

            <div class="col-12">
                <div class="info-label">Deskripsi Keluhan</div>
                <div class="info-value">{{ $keluhan->deskripsi_keluhan }}</div>
            </div>
        </div>

        <!-- FOTO -->
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="info-label mb-2">Foto Bukti</div>
                @if($keluhan->foto_bukti)
                    <img src="{{ asset('storage/'.$keluhan->foto_bukti) }}" class="img-preview" onclick="window.open(this.src)">
                @else
                    <div class="empty-image">Tidak ada foto bukti</div>
                @endif
            </div>

            <div class="col-md-6">
                <div class="info-label mb-2">Foto Setelah Perbaikan</div>
                @if($keluhan->foto_after_perbaikan)
                    <img src="{{ asset('storage/'.$keluhan->foto_after_perbaikan) }}" class="img-preview" onclick="window.open(this.src)">
                @else
                    <div class="empty-image">Belum ada foto</div>
                @endif
            </div>
        </div>

        <hr class="my-4">

        <!-- FORM -->
        <form method="POST" enctype="multipart/form-data" class="d-flex flex-wrap gap-3">
            @csrf
            <select class="form-select w-auto">
                <option {{ $keluhan->status=='Pending' ? 'selected' : '' }}>Pending</option>
                <option {{ $keluhan->status=='Diproses' ? 'selected' : '' }}>Diproses</option>
                <option {{ $keluhan->status=='Selesai' ? 'selected' : '' }}>Selesai</option>
            </select>

            <input type="file" class="form-control w-auto">

            <button class="btn btn-save">Simpan Perubahan</button>
        </form>

    </div>

</section>

</body>
</html>
