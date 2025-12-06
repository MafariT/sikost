<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Booking Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Pesan Sukses jika ada -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if($bookings->isEmpty())
                        <div class="text-center py-10">
                            <p class="text-gray-500 text-lg">Anda belum pernah melakukan booking.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200">
                                <thead>
                                    <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-left">No</th>
                                        <th class="py-3 px-6 text-left">Kamar</th>
                                        <th class="py-3 px-6 text-center">Check-In</th>
                                        <th class="py-3 px-6 text-center">Check-Out</th>
                                        <th class="py-3 px-6 text-right">Total Harga</th>
                                        <th class="py-3 px-6 text-center">Status</th>
                                        <th class="py-3 px-6 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light">
                                    @foreach($bookings as $index => $booking)
                                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                                        <td class="py-3 px-6 text-left whitespace-nowrap">{{ $index + 1 }}</td>
                                        <td class="py-3 px-6 text-left">
                                            <span class="font-medium">{{ $booking->kamar->no_kamar ?? '-' }}</span>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            {{ $booking->tanggal_check_in->format('d M Y') }}
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            {{ $booking->tanggal_check_out->format('d M Y') }}
                                        </td>
                                        <td class="py-3 px-6 text-right font-bold text-green-600">
                                            Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            @if($booking->status_booking == 'pending')
                                                <span class="bg-yellow-200 text-yellow-700 py-1 px-3 rounded-full text-xs">Menunggu Bayar</span>
                                            @elseif($booking->status_booking == 'success')
                                                <span class="bg-green-200 text-green-700 py-1 px-3 rounded-full text-xs">Sukses</span>
                                            @else
                                                <span class="bg-red-200 text-red-700 py-1 px-3 rounded-full text-xs">{{ ucfirst($booking->status_booking) }}</span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900 font-bold">Detail</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>