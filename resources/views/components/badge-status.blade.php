@props(['status'])

@php
    // Ubah status jadi huruf kecil semua agar switch case tidak error
    $statusCheck = strtolower($status);
    
    // Default value
    $color = 'secondary';
    $icon = 'fa-question-circle';
    $label = $status; // Default label sesuai input
    $textStyle = 'text-white';

    switch ($statusCheck) {
        // Status Utama Booking
        case 'menunggu_pelunasan':
            $color = 'warning';
            $icon = 'fa-clock';
            $label = 'Menunggu Pelunasan';
            $textStyle = 'text-dark';
            break;
            
        case 'lunas':
            $color = 'success';
            $icon = 'fa-check-circle';
            $label = 'Lunas';
            break;
            
        case 'tidak_aktif':
            $color = 'danger';
            $icon = 'fa-times-circle';
            $label = 'Tidak Aktif';
            break;

        // Status Histori Pembayaran
        case 'pending':
             $color = 'warning';
             $icon = 'fa-hourglass-half';
             $label = 'Pending';
             $textStyle = 'text-dark';
             break;
    }
@endphp

<span class="badge rounded-pill bg-{{ $color }} {{ $textStyle }} px-3 py-2 border border-{{ $color }} bg-opacity-75">
    <i class="fas {{ $icon }} me-1"></i> {{ $label }}
</span>