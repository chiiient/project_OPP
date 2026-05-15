<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Menu Produk Admin</title>
</head>

<body>
    <h1>Manajemen Menu Pizza & Produk</h1>

    <p>
        <a href="{{ route('admin.dashboard') }}">← Kembali ke Dashboard</a> |
        <a href="{{ route('products.create') }}"><b>+ Tambah Menu Baru</b></a> |
        <a href="{{ route('categories.index') }}">Kelola Kategori →</a>
    </p>

    @if(session('success'))
        <p style="color: green;"><b>Sukses:</b> {{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nama Menu</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Status Ketersediaan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('images/' . $product->image) }}" width="70" alt="Foto Pizza"
                                style="object-fit: cover; height: 50px;">
                        @else
                            <span style="color: gray;">Tidak Ada Foto</span>
                        @endif
                    </td>
                    <td><b>{{ $product->name }}</b></td>
                    <td>{{ $product->category->name ?? 'Tanpa Kategori' }}</td>
                    <td>Rp {{ number_format($product->price) }}</td>
                    <td>
                        @if($product->is_available)
                            <span style="color: green;">Tersedia</span>
                        @else
                            <span style="color: red;">Habis</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}">Edit</a>
                        |
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;"
                            onsubmit="return confirm('Hapus menu ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada produk menu pizza. Silakan klik tambah data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>
    {{ $products->links() }}
</body>

</html>