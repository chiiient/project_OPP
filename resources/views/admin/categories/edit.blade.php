<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kategori</title>
</head>
<body>
    <h1>Edit Kategori Pizza</h1>
    <p><a href="{{ route('categories.index') }}">← Kembali ke Daftar Kategori</a></p>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div>
            <label>Nama Kategori *</label><br>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" required />
            @error('name')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <br>
        <div>
            <a href="{{ route('categories.index') }}"><button type="button">Batal</button></a>
            <button type="submit">Perbarui Kategori</button>
        </div>
    </form>
</body>
</html>