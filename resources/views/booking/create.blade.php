<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Booking Kamar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Bagian Kiri: Detail Kamar -->
                        <div>
                            @if($kamar->foto_kamar)
                                <img src="{{ asset('storage/' . $kamar->foto_kamar) }}" alt="Foto Kamar" class="w-full h-64 object-cover rounded-lg mb-4">
                            @else
                                <div class="w-full h-64 bg-gray-200 rounded-lg mb-4 flex items-center justify-center text-gray-500">
                                    Tidak ada foto
                                </div>
                            @endif
                            
                            <h3 class="text-2xl font-bold mb-2">{{ $kamar->nama_kamar ?? 'Kamar No. ' . $kamar->no_kamar }}</h3>
                            <p class="text-lg text-indigo-600 font-bold mb-4">Rp {{ number_format($kamar->harga, 0, ',', '.') }} / Malam</p>
                            <p class="text-gray-600">{{ $kamar->deskripsi_kamar }}</p>
                        </div>

                        <!-- Bagian Kanan: Form Input -->
                        <div>
                            <form action="{{ route('booking.store') }}" method="POST">
                                @csrf
                                <!-- Input Hidden ID Kamar -->
                                <input type="hidden" name="kamar_id" value="{{ $kamar->id_kamar }}">

                                <!-- Tanggal Check-In -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-bold mb-2">Tanggal Check-In</label>
                                    <input type="date" name="tanggal_check_in" id="check_in" 
                                           class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                </div>

                                <!-- Tanggal Check-Out -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-bold mb-2">Tanggal Check-Out</label>
                                    <input type="date" name="tanggal_check_out" id="check_out" 
                                           class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                </div>

                                <!-- Tipe Pembayaran -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-bold mb-2">Metode Pembayaran</label>
                                    <select name="tipe_pembayaran" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="transfer_bank">Transfer Bank</option>
                                        <option value="ewallet">E-Wallet (OVO/Gopay)</option>
                                        <option value="bayar_ditempat">Bayar di Tempat (Cash)</option>
                                    </select>
                                </div>

                                <!-- Estimasi Total (Opsional, pakai JS sederhana) -->
                                <div class="p-4 bg-gray-100 rounded-lg mb-6">
                                    <p class="text-sm text-gray-600">Total Estimasi:</p>
                                    <p class="text-2xl font-bold text-gray-800" id="total_harga">Rp 0</p>
                                </div>

                                <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 px-4 rounded-md hover:bg-indigo-700 transition duration-150">
                                    Konfirmasi Booking
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Script Sederhana Hitung Harga -->
    <script>
        const hargaPerMalam = {{ $kamar->harga }};
        const checkInInput = document.getElementById('check_in');
        const checkOutInput = document.getElementById('check_out');
        const totalDisplay = document.getElementById('total_harga');

        function hitungTotal() {
            const checkIn = new Date(checkInInput.value);
            const checkOut = new Date(checkOutInput.value);

            if (checkIn && checkOut && checkOut > checkIn) {
                const diffTime = Math.abs(checkOut - checkIn);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
                const total = diffDays * hargaPerMalam;
                
                totalDisplay.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
            } else {
                totalDisplay.innerText = 'Rp 0';
            }
        }

        checkInInput.addEventListener('change', hitungTotal);
        checkOutInput.addEventListener('change', hitungTotal);
    </script>
</x-app-layout>