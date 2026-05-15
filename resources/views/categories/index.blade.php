@extends('layouts.admin')

@section('title', 'Kategori Menu - PizzArt')
@section('adminHeading', 'Manajemen Kategori')

@section('content')
    <section class="px-4 py-10 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-5xl">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm font-black uppercase text-orange-600">Kategori</p>
                    <h1 class="mt-2 text-4xl font-black text-[#2b0700]">Kategori Menu</h1>
                    <p class="mt-3 max-w-2xl text-sm font-medium leading-6 text-[#5b4537]">
                        Pakai kategori supaya daftar menu lebih gampang dipindai kasir.
                    </p>
                </div>
                <a href="{{ route('admin.categories.create') }}" class="inline-flex h-12 items-center justify-center rounded-md bg-orange-500 px-5 text-sm font-black uppercase text-white transition hover:bg-orange-600">
                    Tambah Kategori
                </a>
            </div>

            <div class="mt-8 overflow-hidden rounded-lg border border-black/10 bg-white shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-black/10">
                        <thead class="bg-[#fff3e2]">
                            <tr>
                                <th class="px-5 py-4 text-left text-xs font-black uppercase text-[#6b4a37]">ID</th>
                                <th class="px-5 py-4 text-left text-xs font-black uppercase text-[#6b4a37]">Nama Kategori</th>
                                <th class="px-5 py-4 text-right text-xs font-black uppercase text-[#6b4a37]">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-black/10 bg-white">
                            @forelse ($categories as $category)
                                <tr class="transition hover:bg-orange-50/60">
                                    <td class="whitespace-nowrap px-5 py-4 text-sm font-black text-[#2b0700]">#{{ $category->id }}</td>
                                    <td class="px-5 py-4 text-sm font-bold text-[#4a3529]">{{ $category->name }}</td>
                                    <td class="px-5 py-4">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="inline-flex h-10 items-center rounded-md border border-black/10 bg-white px-4 text-sm font-black text-[#2b0700] transition hover:border-orange-300 hover:text-orange-600">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex h-10 items-center rounded-md bg-red-600 px-4 text-sm font-black text-white transition hover:bg-red-700" onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-5 py-14 text-center">
                                        <p class="text-lg font-black text-[#2b0700]">Belum ada kategori.</p>
                                        <p class="mt-2 text-sm font-medium text-[#6b4a37]">Buat kategori pertama sebelum menambahkan menu.</p>
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
