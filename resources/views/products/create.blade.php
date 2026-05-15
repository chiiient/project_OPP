@extends('layouts.admin')

@section('title', 'Tambah Menu - PizzArt')

@section('content')
    <section class="px-4 py-10 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-5xl">
            <div class="mb-7 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm font-black uppercase text-orange-600">Menu baru</p>
                    <h1 class="mt-2 text-4xl font-black text-[#2b0700]">Tambah Menu Pizza</h1>
                </div>
                <a href="{{ route('admin.products.index') }}" class="inline-flex h-11 items-center justify-center rounded-md border border-black/10 bg-white px-5 text-sm font-black uppercase text-[#2b0700] transition hover:border-orange-300 hover:text-orange-600">
                    Kembali
                </a>
            </div>

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="rounded-lg border border-black/10 bg-white p-5 shadow-sm sm:p-7">
                @csrf

                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label class="label" for="category_id">Kategori</label>
                        <select id="category_id" name="category_id" class="field" required>
                            <option value="">Pilih kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="label" for="name">Nama Menu</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" class="field" placeholder="Pepperoni Melt" required>
                    </div>

                    <div>
                        <label class="label" for="price">Harga</label>
                        <input id="price" type="number" name="price" value="{{ old('price') }}" class="field" placeholder="45000" min="0" required>
                    </div>

                    <div>
                        <label class="label" for="image">Foto Menu</label>
                        <input id="image" type="file" name="image" accept="image/png,image/jpeg,image/jpg" class="field">
                    </div>

                    <div class="md:col-span-2">
                        <label class="label" for="description">Deskripsi</label>
                        <textarea id="description" name="description" rows="5" class="field" placeholder="Adonan tipis, saus tomat segar, mozzarella, dan topping pilihan.">{{ old('description') }}</textarea>
                    </div>

                    <div class="md:col-span-2">
                        <input type="hidden" name="is_available" value="0">
                        <label class="flex items-start gap-3 py-2">
                            <input type="checkbox" name="is_available" value="1" class="h-5 w-5 rounded border-black/20 text-orange-500" checked>
                            <span>
                                <span class="block text-sm font-black uppercase text-[#2b0700]">Menu tersedia</span>
                                <span class="block text-sm font-medium text-[#6b4a37]">Aktifkan supaya menu muncul sebagai pilihan kasir.</span>
                            </span>
                        </label>
                    </div>
                </div>

                <div class="mt-7 flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <button type="submit" class="inline-flex h-12 items-center justify-center rounded-md bg-orange-500 px-6 text-sm font-black uppercase text-white transition hover:bg-orange-600">
                        Simpan Menu
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
