<!DOCTYPE html>
<html>
<head>
    <title>Edit Menu</title>
</head>
<body>
    <h1>Edit Menu</h1>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') <div>
        <label>Nama Menu:</label>
        <input type="text" name="name" value="{{ $product->name }}" required>
    </div>

    <div>
        <label>Harga:</label>
        <input type="number" name="price" value="{{ $product->price }}" required>
    </div>

    <div>
        <label>Kategori ID:</label>
        <input type="number" name="category_id" value="{{ $product->category_id }}" required>
    </div>

    <div>
        <label>Gambar Menu (Biarkan kosong jika tidak ingin mengubah gambar):</label>
        <br>
        @if($product->image)
            <img src="{{ asset('images/products/' . $product->image) }}" width="100" style="margin-bottom: 10px;">
        @endif
        <input type="file" name="image">
    </div>

    <button type="submit">Update Menu</button>
</form>

    <br>
    <a href="{{ route('products.index') }}">Kembali</a>
</body>
</html>