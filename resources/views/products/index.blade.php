<!DOCTYPE html>
<html>

<head>
    <title>Daftar Menu</title>
</head>

<body>
    <h1>Daftar Menu Restoran</h1>

    <a href="{{ route('products.create') }}">Tambah Menu Baru</a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kategori</th>
                <th>Nama Menu</th>
                <th>Harga</th>
                <th>Status</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->name }}</td>
                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>{{ $product->is_available ? 'Tersedia' : 'Habis' }}</td>
                    <th>
                        <img src="{{ asset('images/products/' . $product->image) }}" width="100">
                    </th>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}">Edit</a>

                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Apakah kamu yakin ingin menghapus menu ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>