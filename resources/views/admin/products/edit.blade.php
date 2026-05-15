<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Menu Produk</title>
</head>
<body>
    <h1>Edit Menu Pizza: {{ $product->name }}</h1>
    <p><a href="{{ route('products.index') }}">← Kembali ke Daftar Produk</a></p>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div>
            <label>Nama Menu Pizza *</label><br>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" required />
            @error('name') <div style="color: red;">{{ $message }}</div> @enderror
        </div>
        <br>

        <div>
            <label>Kategori Menu *</label><br>
            <select name="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <div style="color: red;">{{ $message }}</div> @enderror
        </div>
        <br>

        <div>
            <label>Harga *</label><br>
            <input type="number" name="price" value="{{ old('price', $product->price) }}" min="0" required />
            @error('price') <div style="color: red;">{{ $message }}</div> @enderror
        </div>
        <br>

        <div>
            <label>Foto Menu Saat Ini:</label><br>
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" width="100" alt="Foto"><br>
            @endif
            <label>Ganti Foto Baru (Kosongkan jika tidak ingin diubah):</label><br>
            <input type="file" name="image" accept="image/*" />
            @error('image') <div style="color: red;">{{ $message }}</div> @enderror
        </div>
        <br>

        <div>
            <label>Status Ketersediaan *</label><br>
            <select name="is_available" required>
                <option value="1" {{ old('is_available', $product->is_available) == 1 ? 'selected' : '' }}>Tersedia</option>
                <option value="0" {{ old('is_available', $product->is_available) == 0 ? 'selected' : '' }}>Habis</option>
            </select>
            @error('is_available') <div style="color: red;">{{ $message }}</div> @enderror
        </div>
        <br>

        <div>
            <a href="{{ route('products.index') }}"><button type="button">Batal</button></a>
            <button type="submit">Perbarui Data Menu</button>
        </div>
    </form>
</body>
</html>