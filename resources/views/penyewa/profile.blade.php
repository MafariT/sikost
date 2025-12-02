@extends('layouts.layoutPenyewa')

@section('title', 'Profil Saya - SiKos')

@section('konten')

<style>
    /* Memberikan jarak atas/bawah dan warna background abu-abu muda agar konten menonjol */
    .profile-section {
        padding: 60px 0;
        background-color: #f8f9fa;
        min-height: 80vh; /* Memastikan footer tidak naik ke tengah jika konten sedikit */
    }

    /* Styling kartu utama: sudut melengkung dan bayangan halus */
    .profile-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        overflow: hidden; /* Mencegah background header keluar dari border-radius */
        height: 100%; 
    }

    /* Header warna gradasi di belakang foto profil */
    .profile-header-bg {
        height: 120px;
        background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
    }

    /* Wrapper foto profil dengan margin negatif agar foto 'naik' setengah ke atas header */
    .profile-avatar-wrapper {
        margin-top: -60px; /* Teknik CSS untuk overlap */
        text-align: center;
    }

    /* Styling foto bulat dengan border putih tebal */
    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 5px solid #fff;
        object-fit: cover; /* Mencegah foto gepeng */
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    /* Kustomisasi Menu Navigasi Samping */
    .nav-pills-custom .nav-link {
        color: #6c757d;
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        margin-bottom: 10px;
        padding: 12px 20px;
        font-weight: 500;
        transition: all 0.3s;
        text-align: left;
    }

    /* Efek saat mouse diarahkan ke menu */
    .nav-pills-custom .nav-link:hover {
        background-color: #f8f9fa;
        color: #0d6efd;
    }

    /* Tampilan menu saat sedang aktif/diklik */
    .nav-pills-custom .nav-link.active {
        background-color: #0d6efd;
        color: #fff;
        border-color: #0d6efd;
        box-shadow: 0 4px 10px rgba(13, 110, 253, 0.3);
    }

    /* Ikon di dalam menu */
    .nav-pills-custom .nav-link i {
        width: 25px;
        text-align: center;
        margin-right: 8px;
    }
</style>

<section class="profile-section ">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="profile-card bg-white">
                    <div class="profile-header-bg"></div>
                    
                    <div class="card-body pt-0 pb-4">
                        <div class="profile-avatar-wrapper">
                            <img src="https://i.pravatar.cc/150?img=12" alt="Profile Picture" class="profile-avatar">
                        </div>
                        
                        <div class="text-center mt-3 mb-4">
                            <h4 class="mb-0 fw-bold">Rizky Ramadhan</h4>
                            <p class="text-muted mb-2">Mahasiswa - Universitas Indonesia</p>
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">
                                <i class="fas fa-check-circle me-1"></i> Akun Terverifikasi
                            </span>
                        </div>
                        
                        <div class="nav flex-column nav-pills nav-pills-custom px-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <button class="nav-link active" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab">
                                <i class="fas fa-user-edit"></i> Edit Profil
                            </button>
                            
                            <button class="nav-link" id="v-pills-password-tab" data-bs-toggle="pill" data-bs-target="#v-pills-password" type="button" role="tab">
                                <i class="fas fa-lock"></i> Ubah Password
                            </button>
                            
                            <button class="nav-link text-danger mt-3 border-danger bg-white" type="button">
                                <i class="fas fa-sign-out-alt"></i> Keluar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="tab-content" id="v-pills-tabContent">
                    
                    <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel">
                        <div class="profile-card bg-white p-4 p-lg-5">
                            <h3 class="fw-bold mb-4">Informasi Pribadi</h3>
                            
                            <form>
                                <div class="row g-3"> <div class="col-md-6">
                                        <label class="form-label text-muted small fw-bold">Nama Depan</label>
                                        <input type="text" class="form-control form-control-lg" value="Rizky">
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-bold">Nama Belakang</label>
                                        <input type="text" class="form-control form-control-lg" value="Ramadhan">
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-bold">Email</label>
                                        <input type="email" class="form-control form-control-lg" value="rizky@example.com" disabled>
                                        <small class="text-muted fst-italic">*Email tidak dapat diubah</small>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-bold">Nomor WhatsApp</label>
                                        <input type="text" class="form-control form-control-lg" value="081234567890">
                                    </div>
                                    
                                    <div class="col-12">
                                        <label class="form-label text-muted small fw-bold">Kampus / Pekerjaan</label>
                                        <input type="text" class="form-control form-control-lg" value="Universitas Indonesia">
                                    </div>
                                    
                                    <div class="col-12">
                                        <label class="form-label text-muted small fw-bold">Alamat Asal</label>
                                        <textarea class="form-control form-control-lg" rows="3">Jl. Mawar No. 12, Bandung, Jawa Barat</textarea>
                                    </div>
                                </div>
                                
                                <div class="mt-5 text-end">
                                    <button type="button" class="btn btn-secondary px-4 py-2 rounded-pill me-2">Batal</button>
                                    <button type="button" class="btn btn-primary px-4 py-2 rounded-pill fw-bold">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-password" role="tabpanel">
                        <div class="profile-card bg-white p-4 p-lg-5">
                            <h3 class="fw-bold mb-4">Keamanan Akun</h3>
                            
                            <div class="alert alert-info border-0 rounded-3 mb-4 d-flex align-items-center">
                                <i class="fas fa-shield-alt fa-lg me-3"></i>
                                <div>
                                    <strong>Tips Keamanan:</strong><br>
                                    Gunakan kombinasi huruf besar, huruf kecil, dan angka minimal 8 karakter.
                                </div>
                            </div>
                            
                            <form>
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold">Password Saat Ini</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control form-control-lg" id="currentPassword">
                                        <button class="btn btn-outline-secondary" type="button"><i class="far fa-eye"></i></button>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold">Password Baru</label>
                                    <input type="password" class="form-control form-control-lg">
                                </div>
                                
                                <div class="mb-5">
                                    <label class="form-label text-muted small fw-bold">Konfirmasi Password Baru</label>
                                    <input type="password" class="form-control form-control-lg">
                                </div>
                                
                                <div class="text-end">
                                    <button type="button" class="btn btn-primary px-4 py-2 rounded-pill fw-bold">
                                        Update Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection