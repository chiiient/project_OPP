<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kategori</title>
</head>
<body>
    <h1>Tambah Kategori Baru</h1>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <label>Nama Kategori:</label><br>
        <input type="text" name="name" required><br><br>
        
        <button type="submit">Simpan</button>
    </form>

    <br>
    <a href="{{ route('categories.index') }}">Kembali</a>
</body>
</html>