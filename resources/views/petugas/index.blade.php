<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Keluhan Petugas</title>

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

/* =========================
   BASE
========================= */
body{
    margin:0;
    font-family:"Segoe UI",sans-serif;
    background:
        radial-gradient(circle at 15% 10%, var(--soft), transparent 35%),
        radial-gradient(circle at 85% 85%, var(--secondary), transparent 40%),
        linear-gradient(135deg, #f6f8fc, var(--light));
    min-height:100vh;
}

/* =========================
   SIDEBAR (DESKTOP DEFAULT)
========================= */
.sidebar{
    width:260px;
    height:100vh;
    position:fixed;
    top:0;
    left:0;
    background:linear-gradient(180deg,var(--dark),#050e2d);
    padding:60px 30px;
    color:#fff;
    box-shadow:8px 0 30px rgba(0,0,0,.35);
}

.sidebar-title{
    font-size:38px;
    font-weight:900;
    letter-spacing:1px;
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
    margin-top:8px;
}

/* INFO PANEL */
.sidebar-info{
    margin-top:28px;
    background:rgba(255,255,255,0.08);
    border:1px solid rgba(255,255,255,0.15);
    border-radius:18px;
    padding:18px;
    font-size:14px;
}
.sidebar-info strong{
    display:block;
    font-size:13px;
    margin-bottom:4px;
}
.sidebar-info span{
    color:rgba(255,255,255,0.75);
}

/* FOOTER */
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
    padding:14px 0;
    border-radius:18px;
    font-weight:700;
    font-size:16px;
}

/* =========================
   CONTENT
========================= */
.content{
    margin-left:260px;
    padding:70px 90px;
    max-width:1600px;
}

.page-title{
    font-size:42px;
    font-weight:900;
    color:var(--dark);
}
.page-sub{
    font-size:15px;
    color:#64748b;
    margin-bottom:40px;
}

/* =========================
   CARD
========================= */
.card-keluhan{
    background:linear-gradient(180deg,#ffffff,var(--light));
    border-radius:30px;
    padding:34px;
    min-height:320px;
    display:flex;
    flex-direction:column;
    box-shadow:0 18px 40px rgba(0,0,0,.12);
    transition:.3s;
}
.card-keluhan:hover{
    transform:translateY(-6px);
    box-shadow:0 24px 50px rgba(0,0,0,.18);
}

.card-title{
    font-size:22px;
    font-weight:800;
    color:var(--text);
}
.card-label{
    font-size:14px;
    color:#6b7280;
    margin-top:12px;
}
.card-value{
    font-size:20px;
    font-weight:700;
    color:#020617;
}

.btn-detail{
    background:linear-gradient(135deg,var(--primary),var(--secondary));
    border:none;
    border-radius:18px;
    padding:14px;
    font-size:18px;
    font-weight:800;
    color:white;
}

/* =========================
   RESPONSIVE SYSTEM
========================= */

/* TABLET & SMALL LAPTOP */
@media (max-width: 1200px){
    .content{
        padding:50px 40px;
    }
}

/* TABLET MODE */
@media (max-width: 992px){

    .sidebar{
        width:100%;
        height:auto;
        position:relative;
        padding:28px 24px;
    }

    .sidebar-title{
        font-size:28px;
    }

    .sidebar-title::after{
        width:48px;
        margin-top:10px;
    }

    .sidebar-info{
        display:none;
    }

    .sidebar-footer{
        position:relative;
        margin-top:18px;
        left:auto;
        right:auto;
        bottom:auto;
    }

    .btn-logout{
        padding:10px 0;
        font-size:14px;
        border-radius:14px;
    }

    .content{
        margin-left:0;
        padding:28px 22px;
    }

    .page-title{
        font-size:28px;
    }
}

/* MOBILE */
@media (max-width: 576px){

    .sidebar{
        padding:18px 16px;
    }

    .sidebar-title{
        font-size:24px;
    }

    .sidebar-title::after{
        width:40px;
        height:4px;
    }

    .content{
        padding:20px 14px;
    }

    .page-title{
        font-size:24px;
    }

    .card-keluhan{
        padding:22px;
        min-height:auto;
        border-radius:22px;
    }

    .card-title{
        font-size:18px;
    }

    .card-value{
        font-size:17px;
    }
}

/* SMALL MOBILE ≤360px */
@media (max-width: 360px){

    .sidebar{
        padding:14px 12px;
    }

    .sidebar-title{
        font-size:22px;
    }

    .page-title{
        font-size:22px;
    }

    .btn-logout{
        font-size:12px;
        padding:7px 0;
    }

    .card-title{
        font-size:16px;
    }

    .card-value{
        font-size:16px;
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
        <strong>Petugas</strong>
        <span>{{ Auth::user()->email }}</span>
        <strong class="mt-3">Status</strong>
        <span class="badge bg-success bg-opacity-25 text-white">Online</span>
    </div>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">🚪 Logout</button>
        </form>
    </div>
</aside>

<!-- CONTENT -->
<section class="content">
    <div class="page-title">Daftar Tugas</div>
    <div class="page-sub">
        Laporan kerusakan yang telah diverifikasi Admin dan perlu dikerjakan.
    </div>

    <div class="row g-4">
        @forelse($pelaporan as $p)
        <div class="col-xl-4 col-lg-6">
            <div class="card-keluhan">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="card-title">{{ Str::limit($p->keluhan, 20) }}</div>

                    <span class="badge
                        @if($p->status_ob == 'pending') bg-secondary
                        @elseif($p->status_ob == 'proses') bg-warning text-dark
                        @else bg-success @endif
                        px-3 py-2 rounded-pill">
                        {{ ucfirst($p->status_ob) }}
                    </span>
                </div>

                <div class="card-label">Lokasi / Kamar</div>
                <div class="card-value">Kamar {{ $p->no_kamar }}</div>

                <div class="card-label">Waktu Laporan</div>
                <div class="card-value">
                    {{ \Carbon\Carbon::parse($p->tanggal_keluhan ?? $p->created_at)->timezone('Asia/Jakarta')->format('d-m-Y') }} <span class="text-muted small">{{ $p->waktu_keluhan ? \Carbon\Carbon::parse($p->waktu_keluhan)->timezone('Asia/Jakarta')->format('H:i') : \Carbon\Carbon::parse($p->created_at)->timezone('Asia/Jakarta')->format('H:i') }}</span>
                </div>

                <div class="mt-auto pt-4">
                    <a href="{{ route('petugas.pelaporan.show', $p->id_pelaporan) }}" class="btn-detail">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <h4 class="text-muted">Tidak ada tugas baru.</h4>
        </div>
        @endforelse
    </div>
</section>

</body>
</html>
