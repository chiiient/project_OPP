@extends('layouts.app')

@section('title', 'Tambah Kategori - PizzArt')

@section('content')
    <section class="px-4 py-10 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl">
            <div class="mb-7 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm font-black uppercase text-orange-600">Kategori baru</p>
                    <h1 class="mt-2 text-4xl font-black text-[#2b0700]">Tambah Kategori</h1>
                </div>
                <a href="{{ route('categories.index') }}" class="inline-flex h-11 items-center justify-center rounded-md border border-black/10 bg-white px-5 text-sm font-black uppercase text-[#2b0700] transition hover:border-orange-300 hover:text-orange-600">
                    Kembali
                </a>
            </div>

            <form action="{{ route('categories.store') }}" method="POST" class="rounded-lg border border-black/10 bg-white p-5 shadow-sm sm:p-7">
                @csrf
                <label class="label" for="name">Nama Kategori</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" class="field" placeholder="Pizza Signature" required>

                <div class="mt-7 flex justify-end">
                    <button type="submit" class="inline-flex h-12 items-center justify-center rounded-md bg-orange-500 px-6 text-sm font-black uppercase text-white transition hover:bg-orange-600">
                        Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
