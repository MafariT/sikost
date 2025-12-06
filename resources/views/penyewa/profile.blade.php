@extends('layouts.layoutPenyewa')

@section('title', 'Profil Saya - SiKos')

@section('konten')

    <style>
        .profile-section {
            padding: 120px 0 60px 0;
            /* ⬅ SOLUSI AGAR TIDAK TERTUTUP NAVBAR */
            background-color: #f8f9fa;
            min-height: 80vh;
        }

        .profile-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            height: 100%;
        }

        .profile-header-bg {
            height: 120px;
            background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
        }

        .profile-avatar-wrapper {
            margin-top: -60px;
            text-align: center;
            position: relative;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 5px solid #fff;
            object-fit: cover;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

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

        .nav-pills-custom .nav-link:hover {
            background-color: #f8f9fa;
            color: white;
        }

        .nav-pills-custom .nav-link.active {
            background-color: #0d6efd;
            color: #fff !important;
            border-color: #0d6efd;
            box-shadow: 0 4px 10px rgba(13, 110, 253, 0.3);
        }

        .nav-pills-custom .nav-link i {
            width: 25px;
            text-align: center;
            margin-right: 8px;
        }

        /* STYLING UPLOAD FOTO */
        .upload-box {
            border: 2px dashed #0d6efd;
            border-radius: 12px;
            padding: 30px 20px;
            background: #f8faff;
            text-align: center;
            cursor: pointer;
            transition: .2s;
        }

        .upload-box:hover {
            background: #eff6ff;
        }

        /* Sembunyikan input file bawaan */
        .hidden-file-input {
            display: none;
        }

        .upload-icon {
            font-size: 50px;
            color: #0d6efd;
        }
    </style>

    <section class="profile-section">
        <div class="container">

            <!-- Feedback Messages -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <strong>  
                        @foreach($errors->all() as $err)
                            {{ $err }}
                        @endforeach
                    </strong> Silakan cek kembali inputan Anda
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">

                <!-- SIDEBAR KIRI -->
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="profile-card bg-white">
                        <div class="profile-header-bg"></div>

                        <div class="card-body pt-0 pb-4">
                            <div class="profile-avatar-wrapper">
                                <!-- LOGIC IMAGE SUPABASE -->
                                @if ($profile->foto_profile)
                                    <img src="{{ Storage::disk('s3')->url($profile->foto_profile) }}" alt="Profile Picture"
                                        class="profile-avatar">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff"
                                        alt="Default Avatar" class="profile-avatar">
                                @endif
                            </div>

                            <div class="text-center mt-3 mb-4">
                                <h4 class="mb-0 fw-bold">{{ $profile->nama_lengkap ?? Auth::user()->name }}</h4>
                                <p class="text-muted mb-2">{{ Auth::user()->email }}</p>

                                <!-- Status Badge -->
                                @if ($profile->foto_ktp)
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">
                                        <i class="fas fa-check-circle me-1"></i> Data Lengkap
                                    </span>
                                @else
                                    <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3 py-2">
                                        <i class="fas fa-exclamation-circle me-1"></i> Belum Upload KTP
                                    </span>
                                @endif
                            </div>

                            <div class="nav flex-column nav-pills nav-pills-custom px-3 gap-2" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <button class="nav-link active" id="v-pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-profile" type="button" role="tab">
                                    <i class="fas fa-user-edit"></i> Edit Profil
                                </button>

                                <button class="nav-link" id="v-pills-password-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-password" type="button" role="tab">
                                    <i class="fas fa-lock"></i> Ubah Password
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KONTEN KANAN -->
                <div class="col-lg-8">
                    <div class="tab-content" id="v-pills-tabContent">

                        <!-- TAB 1: EDIT PROFIL -->
                        <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel">
                            <div class="profile-card bg-white p-4 p-lg-5">
                                <h3 class="fw-bold mb-4">Informasi Pribadi</h3>

                                <!-- FORM START -->
                                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row g-3">

                                        <!-- Upload Foto Profil -->
                                        <div class="col-12 mb-3">
                                            <label class="form-label text-muted small fw-bold">Ganti Foto Profil</label>

                                            <!-- AREA UPLOAD CUSTOM -->
                                            <div class="upload-box"
                                                onclick="document.getElementById('foto_profile').click()">
                                                <div class="upload-icon"><i class="fa-solid fa-upload"></i></div>
                                                <h6 class="fw-bold mt-2">Upload Foto Profil</h6>
                                                <small class="text-muted">Format: JPG, PNG • Max 4MB</small>
                                            </div>

                                            <!-- INPUT FILE YANG DISEMBUNYIKAN -->
                                            <input id="foto_profile" type="file" name="foto_profile"
                                                class="hidden-file-input" accept="image/*">

                                            <!-- PREVIEW NANTI MUNCUL DI SINI (Opsional) -->
                                            <img id="preview" class="mt-3 rounded d-none" width="150">
                                        </div>


                                        <!-- NIK -->
                                        <div class="col-12">
                                            <label class="form-label text-muted small fw-bold">NIK (Nomor Induk
                                                Kependudukan)</label>
                                            <input type="text" name="nik"
                                                class="form-control form-control-lg @error('nik') is-invalid @enderror"
                                                value="{{ old('nik', $profile->nik) }}"
                                                placeholder="16 Digit NIK sesuai KTP" maxlength="16">
                                            @error('nik')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Nama Lengkap -->
                                        <div class="col-md-12">
                                            <label class="form-label text-muted small fw-bold">Nama Lengkap</label>
                                            <input type="text" name="nama_lengkap"
                                                class="form-control form-control-lg @error('nama_lengkap') is-invalid @enderror"
                                                value="{{ old('nama_lengkap', $profile->nama_lengkap ?? Auth::user()->name) }}">
                                            @error('nama_lengkap')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div class="col-md-6">
                                            <label class="form-label text-muted small fw-bold">Email</label>
                                            <input type="email" name="email" 
                                                class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                                value="{{ old('email', Auth::user()->email) }}">
                                            @error('email') 
                                                <div class="invalid-feedback">{{ $message }}</div> 
                                            @enderror
                                        </div>

                                        <!-- No HP -->
                                        <div class="col-md-6">
                                            <label class="form-label text-muted small fw-bold">Nomor WhatsApp</label>
                                            <input type="text" name="no_hp"
                                                class="form-control form-control-lg @error('no_hp') is-invalid @enderror"
                                                value="{{ old('no_hp', $profile->no_hp) }}" placeholder="08xxxxxxxx">
                                            @error('no_hp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Jenis Kelamin -->
                                        <div class="col-md-6">
                                            <label class="form-label text-muted small fw-bold">Jenis Kelamin</label>
                                            <select name="jenis_kelamin" class="form-select form-select-lg">
                                                <option value="" disabled selected>Pilih...</option>
                                                <option value="laki-laki"
                                                    {{ old('jenis_kelamin', $profile->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>
                                                    Laki-laki</option>
                                                <option value="perempuan"
                                                    {{ old('jenis_kelamin', $profile->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>
                                                    Perempuan</option>
                                            </select>
                                        </div>

                                        <!-- Tempat Tanggal Lahir -->
                                        <div class="col-md-6">
                                            <label class="form-label text-muted small fw-bold">Tempat, Tanggal
                                                Lahir</label>
                                            <input type="text" name="tempat_tanggal_lahir"
                                                class="form-control form-control-lg"
                                                value="{{ old('tempat_tanggal_lahir', $profile->tempat_tanggal_lahir) }}"
                                                placeholder="Jakarta, 1 Januari 2000">
                                        </div>

                                        <!-- Alamat -->
                                        <div class="col-12">
                                            <label class="form-label text-muted small fw-bold">Alamat Asal</label>
                                            <textarea name="alamat" class="form-control form-control-lg" rows="3">{{ old('alamat', $profile->alamat) }}</textarea>
                                        </div>

                                        <!-- UPLOAD KTP -->
                                        <div class="col-12 mt-4">
                                            <div class="p-3 border rounded bg-light">
                                                <label class="form-label fw-bold text-dark mb-1">Upload Foto KTP</label>
                                                <p class="text-muted small mb-3">Wajib diisi untuk verifikasi identitas
                                                    sebelum booking kamar.</p>

                                                <!-- CUSTOM BOX -->
                                                <div class="upload-box mb-3"
                                                    onclick="document.getElementById('foto_ktp').click()">
                                                    <div class="upload-icon"><i class="fa-solid fa-id-card"></i></div>
                                                    <h6 class="fw-bold mt-2">Upload Foto KTP</h6>
                                                    <small class="text-muted">Format: JPG, PNG • Max 4MB</small>
                                                </div>

                                                <!-- INPUT FILE (DISSEMBUNYIKAN) -->
                                                <input id="foto_ktp" type="file" name="foto_ktp"
                                                    class="hidden-file-input" accept="image/*">

                                                <!-- PREVIEW GAMBAR (Opsional) -->
                                                <img id="previewKTP" class="rounded d-none mb-3" width="200">

                                                <!-- TOMBOL LIHAT KTP -->
                                                @if ($profile->foto_ktp)
                                                    <a href="{{ Storage::disk('s3')->url($profile->foto_ktp) }}"
                                                        target="_blank" class="btn btn-sm btn-outline-info text-nowrap">
                                                        <i class="fas fa-eye"></i> Lihat KTP
                                                    </a>
                                                @endif

                                                @error('foto_ktp')
                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                    <div class="mt-5 text-end">
                                        <button type="submit"
                                            class="btn btn-primary px-3 py-3 rounded-pill fw-bold shadow-sm">
                                            <i class="fas fa-save me-2"></i> Simpan Perubahan
                                        </button>
                                    </div>
                                </form>
                                <!-- FORM END -->
                            </div>
                        </div>

                        <!-- TAB 2: PASSWORD -->
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

                                <!-- FORM UPDATE PASSWORD (Laravel's Default Route) -->
                                <form method="post" action="{{ route('password.update') }}">
                                    @csrf
                                    @method('put')

                                    <div class="mb-3">
                                        <label class="form-label text-muted small fw-bold">Password Saat Ini</label>
                                        <input type="password" name="current_password"
                                            class="form-control form-control-lg @error('current_password', 'updatePassword') is-invalid @enderror">
                                        @error('current_password', 'updatePassword')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label text-muted small fw-bold">Password Baru</label>
                                        <input type="password" name="password"
                                            class="form-control form-control-lg @error('password', 'updatePassword') is-invalid @enderror">
                                        @error('password', 'updatePassword')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-5">
                                        <label class="form-label text-muted small fw-bold">Konfirmasi Password Baru</label>
                                        <input type="password" name="password_confirmation"
                                            class="form-control form-control-lg">
                                    </div>

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill fw-bold">
                                            Update Password
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div> <!-- end tab-content -->
                </div> <!-- end col-lg-8 -->
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <script>
        // Optional preview image
        document.getElementById('foto_profile').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                document.getElementById('preview').src = URL.createObjectURL(file);
                document.getElementById('preview').classList.remove('d-none');
            }
        });

        document.getElementById('foto_ktp').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                document.getElementById('previewKTP').src = URL.createObjectURL(file);
                document.getElementById('previewKTP').classList.remove('d-none');
            }
        });
    </script>
@endsection
