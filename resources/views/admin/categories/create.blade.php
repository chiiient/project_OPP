<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kategori</title>
</head>
<body>
    <h1>Tambah Kategori Pizza</h1>
    <p><a href="{{ route('categories.index') }}">← Kembali ke Daftar Kategori</a></p>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        
        <div>
            <label>Nama Kategori *</label><br>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Meat Lovers / Drinks" required />
            @error('name')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <br>
        <div>
            <a href="{{ route('categories.index') }}"><button type="button">Batal</button></a>
            <button type="submit">Simpan Kategori</button>
        </div>
    </form>
</body>
</html>