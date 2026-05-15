<!DOCTYPE html>
<html>
<head>
    <title>Edit Kategori</title>
</head>
<body>
    <h1>Edit Kategori</h1>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label>Nama Kategori:</label><br>
        <input type="text" name="name" value="{{ $category->name }}" required><br><br>
        
        <button type="submit">Update</button>
    </form>

    <br>
    <a href="{{ route('categories.index') }}">Kembali</a>
</body>
</html>