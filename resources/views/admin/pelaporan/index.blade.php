@extends('admin.layout.mainLayoutAdmin')

@section('title', 'Pelaporan Admin')

@section('konten')
<link rel="stylesheet" href="{{ asset('css/pelaporanAdmin.css') }}">

<div class="page-header">
    <h1>Pelaporan dan Keluhan Kos Anda</h1>
    <p>Selamat datang di panel Pelaporan SiKost</p>
</div>

<div class="table-container">
    <div class="table-header">
        <h3>Daftar Pelaporan</h3>
        <div class="filter-group">
            <select class="filter-select" id="filterStatus">
                <option value="">Semua Status</option>
                <option value="pending">Menunggu</option>
                <option value="verified">Terverifikasi</option>
                <option value="progress">Dalam Proses</option>
                <option value="done">Selesai</option>
                <option value="rejected">Ditolak</option>
            </select>
            <button class="btn-refresh" onclick="window.location.reload()">
                <i class="fas fa-sync-alt"></i>
                Refresh
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
                <!-- Sample Data Row 1 -->
                <tr>
                    <td data-label="No">1</td>
                    <td data-label="Nama Pelapor">
                        <strong>Budi Santoso</strong><br>
                        <small style="color: var(--china);">Kamar 101</small>
                    </td>
                    <td data-label="Keluhan">
                        <div class="keluhan-cell">
                            <div class="keluhan-text">
                                AC di kamar tidak dingin dan mengeluarkan bunyi berisik. Sudah 3 hari tidak berfungsi dengan baik.
                            </div>
                        </div>
                    </td>
                    <td data-label="Foto">
                        <img src="https://images.pexels.com/photos/8775545/pexels-photo-8775545.jpeg" alt="Foto Keluhan" class="foto-thumbnail" onclick="openImageModal(this.src)">
                    </td>
                    <td data-label="Status Admin">
                        <span class="status-badge status-pending">Menunggu</span>
                    </td>
                    <td data-label="Status Petugas">
                        <span class="status-badge status-pending">Belum Ditangani</span>
                    </td>
                    <td data-label="Tanggal">
                        <div>05 Des 2025</div>
                        <small style="color: var(--china);">14:30</small>
                    </td>
                    <td data-label="Aksi">
                        <div class="action-buttons">
                            <button class="btn-action btn-verify" onclick="verifyReport(1)">
                                <i class="fas fa-check"></i> Verifikasi
                            </button>
                            <button class="btn-action btn-detail" onclick="openDetailModal(1)">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- Sample Data Row 2 -->
                <tr>
                    <td data-label="No">2</td>
                    <td data-label="Nama Pelapor">
                        <strong>Siti Aminah</strong><br>
                        <small style="color: var(--china);">Kamar 205</small>
                    </td>
                    <td data-label="Keluhan">
                        <div class="keluhan-cell">
                            <div class="keluhan-text">
                                Keran air kamar mandi bocor dan lantai menjadi basah terus menerus.
                            </div>
                        </div>
                    </td>
                    <td data-label="Foto">
                        <img src="https://images.pexels.com/photos/8775545/pexels-photo-8775545.jpeg" alt="Foto Keluhan" class="foto-thumbnail" onclick="openImageModal(this.src)">
                    </td>
                    <td data-label="Status Admin">
                        <span class="status-badge status-verified">Terverifikasi</span>
                    </td>
                    <td data-label="Status Petugas">
                        <span class="status-badge status-progress">Dalam Proses</span>
                    </td>
                    <td data-label="Tanggal">
                        <div>04 Des 2025</div>
                        <small style="color: var(--china);">10:15</small>
                    </td>
                    <td data-label="Aksi">
                        <div class="action-buttons">
                            <button class="btn-action btn-detail" onclick="openDetailModal(2)">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- Sample Data Row 3 -->
                <tr>
                    <td data-label="No">3</td>
                    <td data-label="Nama Pelapor">
                        <strong>Ahmad Rizki</strong><br>
                        <small style="color: var(--china);">Kamar 303</small>
                    </td>
                    <td data-label="Keluhan">
                        <div class="keluhan-cell">
                            <div class="keluhan-text">
                                Lampu kamar sering mati sendiri, sepertinya ada masalah dengan instalasi listrik.
                            </div>
                        </div>
                    </td>
                    <td data-label="Foto">
                        <img src="https://images.pexels.com/photos/8775545/pexels-photo-8775545.jpeg" alt="Foto Keluhan" class="foto-thumbnail" onclick="openImageModal(this.src)">
                    </td>
                    <td data-label="Status Admin">
                        <span class="status-badge status-verified">Terverifikasi</span>
                    </td>
                    <td data-label="Status Petugas">
                        <span class="status-badge status-done">Selesai</span>
                    </td>
                    <td data-label="Tanggal">
                        <div>03 Des 2025</div>
                        <small style="color: var(--china);">16:45</small>
                    </td>
                    <td data-label="Aksi">
                        <div class="action-buttons">
                            <button class="btn-action btn-detail" onclick="openDetailModal(3)">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- Sample Data Row 4 -->
                <tr>
                    <td data-label="No">4</td>
                    <td data-label="Nama Pelapor">
                        <strong>Dewi Lestari</strong><br>
                        <small style="color: var(--china);">Kamar 108</small>
                    </td>
                    <td data-label="Keluhan">
                        <div class="keluhan-cell">
                            <div class="keluhan-text">
                                Pintu kamar susah dibuka dan terkadang macet.
                            </div>
                        </div>
                    </td>
                    <td data-label="Foto">
                        <img src="https://images.pexels.com/photos/8775545/pexels-photo-8775545.jpeg" alt="Foto Keluhan" class="foto-thumbnail" onclick="openImageModal(this.src)">
                    </td>
                    <td data-label="Status Admin">
                        <span class="status-badge status-rejected">Ditolak</span>
                    </td>
                    <td data-label="Status Petugas">
                        <span class="status-badge status-pending">-</span>
                    </td>
                    <td data-label="Tanggal">
                        <div>02 Des 2025</div>
                        <small style="color: var(--china);">09:20</small>
                    </td>
                    <td data-label="Aksi">
                        <div class="action-buttons">
                            <button class="btn-action btn-detail" onclick="openDetailModal(4)">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination-container">
        <div class="pagination-info">
            Menampilkan 1-4 dari 4 data
        </div>
        <ul class="pagination">
            <li class="page-item">
                <a href="#" class="page-link">
                    <i class="fas fa-chevron-left"></i>
                </a>
            </li>
            <li class="page-item active">
                <a href="#" class="page-link">1</a>
            </li>
            <li class="page-item">
                <a href="#" class="page-link">2</a>
            </li>
            <li class="page-item">
                <a href="#" class="page-link">3</a>
            </li>
            <li class="page-item">
                <a href="#" class="page-link">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </li>
        </ul>
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
                    <div class="detail-value">Budi Santoso</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Nomor Kamar</div>
                    <div class="detail-value">Kamar 101 - Lantai 1</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Keluhan</div>
                    <div class="detail-value">
                        AC di kamar tidak dingin dan mengeluarkan bunyi berisik. Sudah 3 hari tidak berfungsi dengan baik. Mohon segera diperbaiki karena cuaca sedang panas.
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Foto Keluhan</div>
                    <img src="https://images.pexels.com/photos/8775545/pexels-photo-8775545.jpeg" alt="Foto Detail" class="detail-foto">
                </div>
                <div class="detail-item">
                    <div class="detail-label">Status Admin</div>
                    <div class="detail-value">
                        <span class="status-badge status-pending">Menunggu Verifikasi</span>
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Status Petugas</div>
                    <div class="detail-value">
                        <span class="status-badge status-pending">Belum Ditangani</span>
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Tanggal Laporan</div>
                    <div class="detail-value">05 Desember 2025, 14:30 WIB</div>
                </div>
            </div>
            <div class="action-buttons" style="margin-top: 2rem;">
                <button class="btn-action btn-verify" onclick="verifyReport(1)">
                    <i class="fas fa-check"></i> Verifikasi Laporan
                </button>
                <button class="btn-action btn-reject" onclick="rejectReport(1)">
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
            <img id="modalImage" src="" alt="Foto Lengkap" style="width: 100%; border-radius: 10px;">
        </div>
    </div>
</div>

<script>
    // Filter Status
    document.getElementById('filterStatus').addEventListener('change', function() {
        const status = this.value;
        // Implementasi filter - bisa menggunakan AJAX atau filter client-side
        console.log('Filter by status:', status);
    });

    // Open Detail Modal
    function openDetailModal(id) {
        document.getElementById('detailModal').classList.add('show');
        // Load data detail berdasarkan ID
        console.log('Opening detail for ID:', id);
    }

    // Open Image Modal
    function openImageModal(src) {
        document.getElementById('modalImage').src = src;
        document.getElementById('imageModal').classList.add('show');
    }

    // Close Modal
    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('show');
    }

    // Close modal when clicking outside
    document.querySelectorAll('.modal-overlay').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('show');
            }
        });
    });

    // Verify Report
    function verifyReport(id) {
        if (confirm('Apakah Anda yakin ingin memverifikasi laporan ini?')) {
            // Implementasi verifikasi - gunakan AJAX
            console.log('Verifying report ID:', id);
            alert('Laporan berhasil diverifikasi!');
            // Reload atau update UI
            window.location.reload();
        }
    }

    // Reject Report
    function rejectReport(id) {
        const reason = prompt('Alasan penolakan:');
        if (reason) {
            // Implementasi penolakan - gunakan AJAX
            console.log('Rejecting report ID:', id, 'Reason:', reason);
            alert('Laporan berhasil ditolak!');
            // Reload atau update UI
            window.location.reload();
        }
    }

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal-overlay.show').forEach(modal => {
                modal.classList.remove('show');
            });
        }
    });
</script>
@endsection