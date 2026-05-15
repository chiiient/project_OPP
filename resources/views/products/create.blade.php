<!DOCTYPE html>
<html>

<head>
    <title>Tambah Menu</title>
</head>

<body>
    <h1>Tambah Menu Baru</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Kategori:</label><br>
        <select name="category_id" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select><br><br>

        <label>Nama Menu:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Deskripsi (Opsional):</label><br>
        <textarea name="description"></textarea><br><br>

        <label>Harga (Rp):</label><br>
        <input type="number" name="price" required><br><br>

        <label>Pilih File Gambar:</label><br>
        <input type="file" name="image"><br><br>

        <button type="submit">Simpan Menu</button>
    </form>

    <br>
    <a href="{{ route('products.index') }}">Kembali</a>
</body>

</html>