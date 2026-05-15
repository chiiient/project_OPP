<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Menampilkan semua data
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // Menampilkan form tambah data
    public function create()
    {
        return view('categories.create');
    }

    // Menyimpan data baru ke database
    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Category::create($request->all());
        return redirect()->route('admin.categories.index');
    }

    // Menampilkan form edit data
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Menyimpan perubahan data ke database
    public function update(Request $request, Category $category)
    {
        $request->validate(['name' => 'required']);
        $category->update($request->all());
        return redirect()->route('admin.categories.index');
    }

    // Menghapus data dari database
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index');
    }
}
