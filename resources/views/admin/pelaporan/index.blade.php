@extends('admin.layout.mainLayoutAdmin')

@section('title', 'Pelaporan Admin')

@section('konten')
<link rel="stylesheet" href="{{ asset('css/pelaporanAdmin.css') }}">

<div class="page-header">
    <h1>Pelaporan dan Keluhan Kos Anda</h1>
    <p>Selamat datang di panel Pelaporan SiKost</p>
</div>

@if(session('success'))
    <div class="alert alert-success" style="padding: 15px; background: #d4edda; color: #155724; border-radius: 8px; margin-bottom: 20px;">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
@endif

<div class="table-container">
    <div class="table-header">
        <h3>Daftar Pelaporan</h3>
        <div class="filter-group">
            <select class="filter-select" id="filterStatus" onchange="window.location.href = '?status=' + this.value">
                <option value="" {{ request('status') == '' ? 'selected' : '' }}>Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Terverifikasi</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
            </select>
            <button class="btn-refresh" onclick="window.location.href='{{ route('admin.pelaporan') }}'">
                <i class="fas fa-sync-alt"></i> Refresh
            </button>
        </div>
    </div>

    <div class="table-responsive">
        <table class="pelaporan-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pelapor</th>
                    <th>Keluhan</th>
                    <th>Foto</th>
                    <th>Status Admin</th>
                    <th>Status Petugas</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pelaporan as $p)
                <tr>
                    <td data-label="No">
                        {{ ($pelaporan->currentPage() - 1) * $pelaporan->perPage() + $loop->iteration }}
                    </td>

                    <td data-label="Nama Pelapor">
                        <strong>{{ $p->user->profile->nama_lengkap ?? $p->user->name }}</strong><br>
                        <small style="color: var(--china);">Kamar {{ $p->no_kamar }}</small>
                    </td>

                    <td data-label="Keluhan">
                        <div class="keluhan-cell">
                            <div class="keluhan-text">
                                <strong>{{ $p->keluhan }}</strong><br>
                                {{ Str::limit($p->deskripsi_keluhan, 60) }}
                            </div>
                        </div>
                    </td>

                    <td data-label="Foto">
                        @if($p->foto_bukti)
                            <img src="{{ Storage::disk('s3')->url($p->foto_bukti) }}"
                                 alt="Foto"
                                 class="foto-thumbnail"
                                 onclick="openImageModal(this.src)">
                        @else
                            <span class="text-muted small">No Image</span>
                        @endif
                    </td>

                    <td data-label="Status Admin">
                        @if($p->status_admin == 'verified')
                            <span class="status-badge status-verified">Terverifikasi</span>
                        @elseif($p->status_admin == 'rejected')
                            <span class="status-badge status-rejected">Ditolak</span>
                        @else
                            <span class="status-badge status-pending">Menunggu</span>
                        @endif
                    </td>

                    <td data-label="Status Petugas">
                        @if($p->status_ob == 'selesai')
                            <span class="status-badge status-done">Selesai</span>
                        @elseif($p->status_ob == 'proses')
                            <span class="status-badge status-progress">Proses</span>
                        @elseif($p->status_ob == 'batal')
                            <span class="status-badge status-rejected">Batal</span>
                        @else
                            <span class="status-badge status-pending">Pending</span>
                        @endif
                    </td>

                    <td data-label="Tanggal">
                        <div>{{ \Carbon\Carbon::parse($p->tanggal_keluhan ?? $p->created_at)->timezone('Asia/Jakarta')->format('d-m-Y') }}</div>
                        <small style="color: var(--china);">{{ $p->waktu_keluhan ? \Carbon\Carbon::parse($p->waktu_keluhan)->timezone('Asia/Jakarta')->format('H:i') : \Carbon\Carbon::parse($p->created_at)->timezone('Asia/Jakarta')->format('H:i') }}</small>
                    </td>

                    <td data-label="Aksi">
                        <div class="action-buttons">
                            @if($p->status_admin == 'pending')
                                <button class="btn-action btn-verify" onclick="submitStatus('{{ $p->id_pelaporan }}', 'verified')">
                                    <i class="fas fa-check"></i>
                                </button>
                            @endif

                            <button class="btn-action btn-detail"
                                onclick="openDetailModal({
                                    id: '{{ $p->id_pelaporan }}',
                                    nama: '{{ $p->user->profile->nama_lengkap ?? $p->user->name }}',
                                    kamar: '{{ $p->no_kamar }}',
                                    judul: '{{ addslashes($p->keluhan) }}',
                                    deskripsi: '{{ addslashes($p->deskripsi_keluhan) }}',
                                    foto: '{{ $p->foto_bukti ? Storage::disk('s3')->url($p->foto_bukti) : '' }}',
                                    status_admin: '{{ $p->status_admin }}',
                                    status_ob: '{{ $p->status_ob }}',
                                    tanggal: '{{ \Carbon\Carbon::parse($p->tanggal_keluhan ?? $p->created_at)->timezone('Asia/Jakarta')->format('d-m-Y') }}, {{ $p->waktu_keluhan ? \Carbon\Carbon::parse($p->waktu_keluhan)->timezone('Asia/Jakarta')->format('H:i') : \Carbon\Carbon::parse($p->created_at)->timezone('Asia/Jakarta')->format('H:i') }}'
                                })">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-5">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada laporan masuk.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination-container">
        {{ $pelaporan->links() }}
    </div>
</div>

<!-- Modal Detail -->
<div class="modal-overlay" id="detailModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Detail Pelaporan</h3>
            <button class="modal-close" onclick="closeModal('detailModal')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-label">Nama Pelapor</div>
                    <div class="detail-value" id="modalNama">...</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Nomor Kamar</div>
                    <div class="detail-value" id="modalKamar">...</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Keluhan</div>
                    <div class="detail-value">
                        <strong id="modalJudul" class="d-block mb-1">...</strong>
                        <span id="modalDeskripsi">...</span>
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Foto Keluhan</div>
                    <img src="" alt="Foto Detail" class="detail-foto" id="modalFoto" style="display: none;">
                    <span id="modalNoFoto" class="text-muted small" style="display: none;">Tidak ada foto.</span>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Status Admin</div>
                    <div class="detail-value">
                        <span class="status-badge" id="modalStatusAdmin">...</span>
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Status Petugas</div>
                    <div class="detail-value">
                        <span class="status-badge" id="modalStatusOb">...</span>
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Tanggal Laporan</div>
                    <div class="detail-value" id="modalTanggal">...</div>
                </div>
            </div>

            <!-- Action Buttons inside Modal -->
            <div class="action-buttons" style="margin-top: 2rem; display: none;" id="modalActions">
                <button class="btn-action btn-verify" id="btnModalVerify">
                    <i class="fas fa-check"></i> Verifikasi Laporan
                </button>
                <button class="btn-action btn-reject" id="btnModalReject">
                    <i class="fas fa-times"></i> Tolak Laporan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Image -->
<div class="modal-overlay" id="imageModal">
    <div class="modal-content" style="max-width: 900px;">
        <div class="modal-header">
            <h3>Foto Keluhan</h3>
            <button class="modal-close" onclick="closeModal('imageModal')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <img id="modalImageFull" src="" alt="Foto Lengkap" style="width: 100%; border-radius: 10px;">
        </div>
    </div>
</div>

<!-- Hidden Form for Actions -->
<form id="actionForm" method="POST" style="display: none;">
    @csrf
    @method('PATCH')
    <input type="hidden" name="status_admin" id="formStatusInput">
</form>

<script>
    function openDetailModal(data) {
        document.getElementById('modalNama').innerText = data.nama;
        document.getElementById('modalKamar').innerText = data.kamar;
        document.getElementById('modalJudul').innerText = data.judul;
        document.getElementById('modalDeskripsi').innerText = data.deskripsi;
        document.getElementById('modalTanggal').innerText = data.tanggal;

        const imgEl = document.getElementById('modalFoto');
        const noImgEl = document.getElementById('modalNoFoto');
        if (data.foto) {
            imgEl.src = data.foto;
            imgEl.style.display = 'block';
            imgEl.onclick = function() { openImageModal(data.foto); };
            noImgEl.style.display = 'none';
        } else {
            imgEl.style.display = 'none';
            noImgEl.style.display = 'block';
        }

        const adminBadge = document.getElementById('modalStatusAdmin');
        adminBadge.className = 'status-badge status-' + (data.status_admin == 'verified' ? 'verified' : (data.status_admin == 'rejected' ? 'rejected' : 'pending'));
        adminBadge.innerText = data.status_admin.charAt(0).toUpperCase() + data.status_admin.slice(1);

        const obBadge = document.getElementById('modalStatusOb');
        obBadge.className = 'status-badge status-' + (data.status_ob == 'selesai' ? 'done' : (data.status_ob == 'proses' ? 'progress' : 'pending'));
        obBadge.innerText = data.status_ob.charAt(0).toUpperCase() + data.status_ob.slice(1);

        const actionDiv = document.getElementById('modalActions');
        if (data.status_admin === 'pending') {
            actionDiv.style.display = 'flex';
            document.getElementById('btnModalVerify').onclick = function() { submitStatus(data.id, 'verified'); };
            document.getElementById('btnModalReject').onclick = function() { submitStatus(data.id, 'rejected'); };
        } else {
            actionDiv.style.display = 'none';
        }

        document.getElementById('detailModal').classList.add('show');
    }

    // Open Image Modal
    function openImageModal(src) {
        document.getElementById('modalImageFull').src = src;
        document.getElementById('imageModal').classList.add('show');
    }

    // Close Modal
    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('show');
    }

    document.querySelectorAll('.modal-overlay').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('show');
            }
        });
    });

    function submitStatus(id, status) {
        let confirmMsg = (status === 'verified')
            ? 'Apakah Anda yakin ingin MEMVERIFIKASI laporan ini? Status akan diteruskan ke Petugas OB.'
            : 'Apakah Anda yakin ingin MENOLAK laporan ini?';

        if (confirm(confirmMsg)) {
            const form = document.getElementById('actionForm');
            const statusInput = document.getElementById('formStatusInput');

            form.action = "/admin/pelaporan/" + id + "/update";
            statusInput.value = status;

            form.submit();
        }
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal-overlay.show').forEach(modal => {
                modal.classList.remove('show');
            });
        }
    });
</script>
@endsection
