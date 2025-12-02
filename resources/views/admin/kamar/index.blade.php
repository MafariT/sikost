<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Admin Kamar (Supabase)</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">

    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Manajemen Kamar (Cloud Storage)</h1>

        <!-- Feedback Messages -->
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Tambah Kamar -->
        <form action="{{ route('admin.kamar.store') }}" method="POST" enctype="multipart/form-data" class="mb-8 border-b pb-8">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <input type="text" name="no_kamar" placeholder="No. Kamar (mis: A-101)" class="border p-2 rounded" required>
                <input type="number" name="harga" placeholder="Harga per tahun" class="border p-2 rounded" required>
                <select name="status" class="border p-2 rounded">
                    <option value="tersedia">Tersedia</option>
                    <option value="tidak tersedia">Tidak Tersedia</option>
                </select>
                <input type="file" name="foto_kamar" class="border p-2 rounded">
            </div>
            <textarea name="deskripsi_kamar" placeholder="Deskripsi..." class="w-full border p-2 rounded mt-4"></textarea>
            <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan ke Cloud</button>
        </form>

        <!-- Tabel List Kamar -->
        <h2 class="text-xl font-bold mb-4">Daftar Kamar</h2>
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">Foto</th>
                    <th class="p-2 border">No Kamar</th>
                    <th class="p-2 border">Harga</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kamar as $item)
                <tr>
                    <td class="p-2 border">
                        @if($item->foto_kamar)
                            <img src="{{ Storage::disk('s3')->url($item->foto_kamar) }}" alt="Foto" class="w-16 h-16 object-cover rounded">
                        @else
                            <span class="text-gray-400">No Image</span>
                        @endif
                    </td>
                    <td class="p-2 border font-bold">{{ $item->no_kamar }}</td>
                    <td class="p-2 border">Rp {{ number_format($item->harga) }}</td>
                    <td class="p-2 border">
                        <span class="px-2 py-1 rounded text-xs {{ $item->status == 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td class="p-2 border">
                        <form action="{{ route('admin.kamar.destroy', $item->id_kamar) }}" method="POST" onsubmit="return confirm('Hapus?');">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>