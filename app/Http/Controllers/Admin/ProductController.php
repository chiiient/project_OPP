<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // 1. Tampilkan Semua Menu Pizza
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    // 2. Halaman Form Tambah Menu Pizza
    public function create()
    {
        $categories = Category::all(); // Untuk dropdown pilihan kategori
        return view('admin.products.create', compact('categories'));
    }

    // 3. Proses Simpan Menu Pizza Baru
    public function store(Request $request)
{
    $request->validate([
        'category_id'  => 'required|exists:categories,id',
        'name'         => 'required|string|max:255',
        'price'        => 'required|numeric|min:0',
        'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Maks 2MB
        'is_available' => 'required|boolean',
    ]);

    $data = $request->all();

    // JALUR LANGSUNG KE PUBLIC/IMAGES
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        // Bikin nama file unik pakai waktu, contoh: 171567382.png
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        // Pindahkan file langsung ke folder public/images
        $file->move(public_path('images'), $fileName);
        
        // Simpan nama filenya saja ke database
        $data['image'] = $fileName;
    }

    Product::create($data);

    return redirect()->route('products.index')->with('success', 'Menu Pizza baru berhasil ditambahkan!');
}

    // 4. Halaman Form Edit Menu Pizza
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // 5. Proses Update Menu Pizza
    public function update(Request $request, Product $product)
{
    $request->validate([
        'category_id'  => 'required|exists:categories,id',
        'name'         => 'required|string|max:255',
        'price'        => 'required|numeric|min:0',
        'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'is_available' => 'required|boolean',
    ]);

    $data = $request->all();

    // JALUR LANGSUNG KE PUBLIC/IMAGES UNTUK UPDATE
    if ($request->hasFile('image')) {
        // Hapus foto lama di folder public/images jika ada
        if ($product->image && file_exists(public_path('images/' . $product->image))) {
            unlink(public_path('images/' . $product->image));
        }

        $file = $request->file('image');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $fileName);
        
        $data['image'] = $fileName;
    }

    $product->update($data);

    return redirect()->route('products.index')->with('success', 'Menu Pizza berhasil diperbarui!');
}

    // 6. Proses Hapus Menu Pizza
    public function destroy(Product $product)
    {
        // Hapus gambar dari storage sebelum datanya dihapus dari database
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Menu Pizza berhasil dihapus!');
    }
}