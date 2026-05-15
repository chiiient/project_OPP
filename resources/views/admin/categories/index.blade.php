<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kategori Admin</title>
</head>
<body>
    <h1>Manajemen Kategori Pizza</h1>
    
    <p>
        <a href="{{ route('admin.dashboard') }}">← Kembali ke Dashboard</a> | 
        <a href="{{ route('categories.create') }}"><b>+ Tambah Kategori Baru</b></a> |
        <a href="{{ route('products.index') }}">Lihat Semua Produk →</a>
    </p>

    @if(session('success'))
        <p style="color: green;"><b>Sukses:</b> {{ session('success') }}</p>
    @endif
    @if(session('error'))
        <p style="color: red;"><b>Error:</b> {{ session('error') }}</p>
    @endif

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kategori</th>
                <th>Jumlah Produk</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->products_count }} item</td>
                    <td>
                        <a href="{{ route('categories.edit', $category->id) }}">Edit</a>
                        |
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Belum ada data kategori. Silakan tambah data terlebih dahulu.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>