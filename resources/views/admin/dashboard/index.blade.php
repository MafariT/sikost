@extends('admin.layout.mainLayoutAdmin')

@section('title', 'Dashboard Admin')

@section('konten')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="page-header">
    <h1>Dashboard</h1>
    <p>Selamat datang di panel admin SiKos</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-value">{{ $totalKamar }}</div>
                <div class="stat-label">Total Kamar</div>
            </div>
            <div class="stat-icon blue">
                <i class="fas fa-bed"></i>
            </div>
        </div>
    </div>

    <div class="stat-card orange">
        <div class="stat-header">
            <div>
                <div class="stat-value">{{ $kamarTerisi }}</div>
                <div class="stat-label">Kamar Terisi</div>
            </div>
            <div class="stat-icon orange">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <div class="stat-card green">
        <div class="stat-header">
            <div>
                <div class="stat-value">{{ $kamarTersedia }}</div>
                <div class="stat-label">Kamar Tersedia</div>
            </div>
            <div class="stat-icon green">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>

    <div class="stat-card purple">
        <div class="stat-header">
            <div>
                <div class="stat-value">{{ $laporanBaru }}</div>
                <div class="stat-label">Laporan Baru</div>
            </div>
            <div class="stat-icon purple">
                <i class="fas fa-flag"></i>
            </div>
        </div>
    </div>
</div>

<!-- Chart Container -->
<div class="chart-container">
    <div class="chart-header">
        <h3>Statistik Booking Bulanan ({{ date('Y') }})</h3>
    </div>
    <div style="height: 300px; padding: 10px;">
        <canvas id="bookingChart"></canvas>
    </div>
</div>

<!-- Recent Activity -->
<div class="activity-list">
    <div class="chart-header">
        <h3>Aktivitas Terbaru</h3>
    </div>

    @forelse($activities as $activity)
        <div class="activity-item">
            <div class="activity-icon" style="background-color: {{ $activity['type'] == 'payment' ? '#d1e7dd' : '#cfe2ff' }}; color: {{ $activity['type'] == 'payment' ? '#198754' : '#0d6efd' }};">
                <i class="{{ $activity['icon'] }}"></i>
            </div>
            <div class="activity-details">
                <h5>{{ $activity['title'] }}</h5>
                <p>{{ $activity['desc'] }} - <small class="text-muted">{{ $activity['time']->diffForHumans() }}</small></p>
            </div>
        </div>
    @empty
        <div class="p-4 text-center text-muted">
            Belum ada aktivitas terbaru.
        </div>
    @endforelse
</div>

<script>
    const ctx = document.getElementById('bookingChart').getContext('2d');
    const bookingChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Jumlah Booking',
                data: @json($chartData),
                borderColor: '#4361ee',
                backgroundColor: 'rgba(67, 97, 238, 0.1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@endsection
