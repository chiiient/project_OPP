@extends('layouts.admin')

@section('title', 'Daftar Menu - PizzArt')
@section('adminHeading', 'Manajemen Menu')

@section('content')
    <section class="px-4 py-10 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm font-black uppercase text-orange-600">Menu restoran</p>
                    <h1 class="mt-2 text-4xl font-black text-[#2b0700]">Daftar Menu Pizza</h1>
                    <p class="mt-3 max-w-2xl text-sm font-medium leading-6 text-[#5b4537]">
                        Kelola foto, kategori, harga, dan status ketersediaan menu.
                    </p>
                </div>
                <a href="{{ route('admin.products.create') }}" class="inline-flex h-12 items-center justify-center rounded-md bg-orange-500 px-5 text-sm font-black uppercase text-white transition hover:bg-orange-600">
                    Tambah Menu
                </a>
            </div>

            <div class="mt-8 overflow-hidden rounded-lg border border-black/10 bg-white shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-black/10">
                        <thead class="bg-[#fff3e2]">
                            <tr>
                                <th class="px-5 py-4 text-left text-xs font-black uppercase text-[#6b4a37]">Menu</th>
                                <th class="px-5 py-4 text-left text-xs font-black uppercase text-[#6b4a37]">Kategori</th>
                                <th class="px-5 py-4 text-left text-xs font-black uppercase text-[#6b4a37]">Harga</th>
                                <th class="px-5 py-4 text-left text-xs font-black uppercase text-[#6b4a37]">Status</th>
                                <th class="px-5 py-4 text-right text-xs font-black uppercase text-[#6b4a37]">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-black/10 bg-white">
                            @forelse ($products as $product)
                                <tr class="transition hover:bg-orange-50/60">
                                    <td class="px-5 py-4">
                                        <div class="flex min-w-72 items-center gap-4">
                                            <img
                                                src="{{ $product->image ? asset('images/products/' . $product->image) : asset('images/pizzart/logo.jpg') }}"
                                                alt="{{ $product->name }}"
                                                class="h-16 w-16 rounded-lg border border-black/10 object-cover"
                                            >
                                            <div>
                                                <p class="font-black text-[#2b0700]">{{ $product->name }}</p>
                                                <p class="mt-1 line-clamp-2 max-w-md text-sm font-medium text-[#6b4a37]">
                                                    {{ $product->description ?: 'Belum ada deskripsi menu.' }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-5 py-4 text-sm font-bold text-[#4a3529]">
                                        {{ $product->category?->name ?? 'Tanpa kategori' }}
                                    </td>
                                    <td class="whitespace-nowrap px-5 py-4 text-sm font-black text-[#2b0700]">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </td>
                                    <td class="whitespace-nowrap px-5 py-4">
                                        @if ($product->is_available)
                                            <span class="inline-flex rounded-md bg-green-100 px-3 py-1 text-xs font-black uppercase text-green-700">Tersedia</span>
                                        @else
                                            <span class="inline-flex rounded-md bg-red-100 px-3 py-1 text-xs font-black uppercase text-red-700">Habis</span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="inline-flex h-10 items-center rounded-md border border-black/10 bg-white px-4 text-sm font-black text-[#2b0700] transition hover:border-orange-300 hover:text-orange-600">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex h-10 items-center rounded-md bg-red-600 px-4 text-sm font-black text-white transition hover:bg-red-700" onclick="return confirm('Apakah kamu yakin ingin menghapus menu ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-5 py-14 text-center">
                                        <p class="text-lg font-black text-[#2b0700]">Belum ada menu.</p>
                                        <p class="mt-2 text-sm font-medium text-[#6b4a37]">Tambah menu pizza pertama buat mulai pakai halaman kasir.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
