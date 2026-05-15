@extends('layouts.admin')

@section('title', 'Edit Menu - PizzArt')

@section('content')
    <section class="px-4 py-10 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-5xl">
            <div class="mb-7 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm font-black uppercase text-orange-600">Edit menu</p>
                    <h1 class="mt-2 text-4xl font-black text-[#2b0700]">{{ $product->name }}</h1>
                </div>
                <a href="{{ route('admin.products.index') }}" class="inline-flex h-11 items-center justify-center rounded-md border border-black/10 bg-white px-5 text-sm font-black uppercase text-[#2b0700] transition hover:border-orange-300 hover:text-orange-600">
                    Kembali
                </a>
            </div>

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="rounded-lg border border-black/10 bg-white p-5 shadow-sm sm:p-7">
                @csrf
                @method('PUT')

                <div class="grid gap-5 md:grid-cols-[1fr_260px]">
                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="label" for="category_id">Kategori</label>
                            <select id="category_id" name="category_id" class="field" required>
                                <option value="">Pilih kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="label" for="name">Nama Menu</label>
                            <input id="name" type="text" name="name" value="{{ old('name', $product->name) }}" class="field" required>
                        </div>

                        <div>
                            <label class="label" for="price">Harga</label>
                            <input id="price" type="number" name="price" value="{{ old('price', $product->price) }}" class="field" min="0" required>
                        </div>

                        <div>
                            <label class="label" for="image">Ganti Foto</label>
                            <input id="image" type="file" name="image" accept="image/png,image/jpeg,image/jpg" class="field">
                        </div>

                        <div class="md:col-span-2">
                            <label class="label" for="description">Deskripsi</label>
                            <textarea id="description" name="description" rows="5" class="field">{{ old('description', $product->description) }}</textarea>
                        </div>

                        <div class="md:col-span-2">
                            <input type="hidden" name="is_available" value="0">
                            <label class="flex items-start gap-3 py-2">
                                <input type="checkbox" name="is_available" value="1" class="h-5 w-5 rounded border-black/20 text-orange-500" @checked(old('is_available', $product->is_available))>
                                <span>
                                    <span class="block text-sm font-black uppercase text-[#2b0700]">Menu tersedia</span>
                                    <span class="block text-sm font-medium text-[#6b4a37]">Nonaktifkan kalau stok sedang habis.</span>
                                </span>
                            </label>
                        </div>
                    </div>

                    <aside class="md:border-l md:border-black/10 md:pl-5">
                        <p class="mb-3 text-sm font-black uppercase text-[#6b4a37]">Foto saat ini</p>
                        <img
                            src="{{ $product->image ? asset('images/products/' . $product->image) : asset('images/pizzart/logo.jpg') }}"
                            alt="{{ $product->name }}"
                            class="aspect-square w-full rounded-lg border border-black/10 object-cover"
                        >
                    </aside>
                </div>

                <div class="mt-7 flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <button type="submit" class="inline-flex h-12 items-center justify-center rounded-md bg-orange-500 px-6 text-sm font-black uppercase text-white transition hover:bg-orange-600">
                        Update Menu
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
