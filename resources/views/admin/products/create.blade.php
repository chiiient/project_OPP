<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Menu Produk</title>
</head>
<body>
    <h1>Tambah Menu Pizza Baru</h1>
    <p><a href="{{ route('products.index') }}">← Kembali ke Daftar Produk</a></p>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div>
            <label>Nama Menu Pizza *</label><br>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama pizza" required />
            @error('name') <div style="color: red;">{{ $message }}</div> @enderror
        </div>
        <br>

        <div>
            <label>Kategori Menu *</label><br>
            <select name="category_id" required>
                <option value="">— Pilih kategori —</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <div style="color: red;">{{ $message }}</div> @enderror
        </div>
        <br>

        <div>
            <label>Harga (Rupiah) *</label><br>
            <input type="number" name="price" value="{{ old('price') }}" placeholder="0" min="0" required />
            @error('price') <div style="color: red;">{{ $message }}</div> @enderror
        </div>
        <br>

        <div>
            <label>Foto Menu Pizza</label><br>
            <input type="file" name="image" accept="image/*" />
            @error('image') <div style="color: red;">{{ $message }}</div> @enderror
        </div>
        <br>

        <div>
            <label>Status Ketersediaan *</label><br>
            <select name="is_available" required>
                <option value="1" {{ old('is_available', '1') == '1' ? 'selected' : '' }}>Tersedia / Siap Masak</option>
                <option value="0" {{ old('is_available') == '0' ? 'selected' : '' }}>Habis / Kosong</option>
            </select>
            @error('is_available') <div style="color: red;">{{ $message }}</div> @enderror
        </div>
        <br>

        <div>
            <a href="{{ route('products.index') }}"><button type="button">Reset / Batal</button></a>
            <button type="submit">Simpan Data Menu</button>
        </div>
    </form>
</body>
</html>