<?php

namespace App\Http\Controllers;

use App\Models\Product; // <-- PASTIKAN BARIS INI ADA
use App\Models\Category; // <-- DAN BARIS INI JUGA ADA
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Mengambil semua produk beserta data kategorinya (relasi)
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all(); // Ambil semua kategori
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->except('image'); // Ambil semua data kecuali image

        // LOGIKA UPLOAD SEPERTI PUNYAMU
        if ($image = $request->file('image')) {
            $destinationPath = 'images/products/'; // Simpan di folder public/images/products/
            $productImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $productImage);
            $data['image'] = $productImage; // Masukkan nama file ke array data
        }

        // Simpan ke database
        \App\Models\Product::create($data);

        return redirect()->route('products.index')->with('success', 'Menu berhasil ditambahkan!');
    }


    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $data = $request->except('image');

        // LOGIKA UPDATE GAMBAR SEPERTI PUNYAMU
        if ($image = $request->file('image')) {
            $destinationPath = 'images/products/';
            $productImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $productImage);
            $data['image'] = $productImage;

            // (Opsional) Hapus gambar lama jika ada gambar baru yang diupload
            if ($product->image) {
                $old_file = public_path('images/products/' . $product->image);
                if (file_exists($old_file)) {
                    unlink($old_file);
                }
            }
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Menu berhasil diupdate!');
    }

    public function destroy($id)
    {
        $product = \App\Models\Product::findOrFail($id);

        // LOGIKA HAPUS FILE SEPERTI PUNYAMU
        if ($product->image) {
            $file_name = public_path('images/products/' . $product->image);
            if (file_exists($file_name)) {
                unlink($file_name); // Hapus gambar dari folder
            }
        }

        // Hapus data dari database
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Menu berhasil dihapus!');
    }
}