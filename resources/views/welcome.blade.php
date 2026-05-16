@extends('layouts.app')

<<<<<<< HEAD
        <title>{{ config('app.name', 'Laravel') }}</title>
=======
@section('title', 'PizzArt - Fresh & Tasty')
>>>>>>> b653dc537ba58329e120a6967fb939a5974cf7c0

@section('content')
    <section id="Home" class="relative overflow-hidden bg-white">
        <div class="absolute inset-y-0 right-0 hidden w-[55%] lg:block">
            <img src="{{ asset('images/pizzart/hero-pizza.jpg') }}" alt="Freshly baked pizza" class="h-full w-full object-contain object-right-bottom">
        </div>
        <div class="absolute inset-0 bg-[linear-gradient(90deg,#ffffff_0%,#ffffff_48%,rgba(255,255,255,0.78)_66%,rgba(255,255,255,0.28)_100%)]"></div>

        <div class="relative mx-auto grid min-h-[calc(100vh-5rem)] max-w-7xl content-center gap-10 px-4 py-14 sm:px-6 lg:px-8">
            <div class="max-w-2xl">
                <p class="mb-4 inline-flex rounded-md border border-orange-200 bg-orange-50 px-3 py-2 text-xs font-black uppercase text-orange-700">
                    Fresh & Tasty Pizza
                </p>
                <h1 class="text-5xl font-black leading-tight text-[#2b0700] sm:text-6xl lg:text-7xl">
                    Freshly Baked <span class="text-orange-500">Pizza</span><br>
                    Right to Your Table
                </h1>
                <p class="mt-6 max-w-xl text-base font-medium leading-8 text-[#4a3529] sm:text-lg">
                    Pizza hangat dengan topping melimpah, keju lumer, dan alur kasir yang siap dipakai buat ngatur menu, pesanan, sampai pembayaran restoran.
                </p>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('orders.index') }}" class="inline-flex h-12 items-center justify-center rounded-md bg-orange-500 px-6 text-sm font-black uppercase text-white shadow-sm transition hover:bg-orange-600">
                        Order Now
                    </a>
                    <a href="{{ route('products.index') }}" class="inline-flex h-12 items-center justify-center rounded-md border border-[#2b0700]/15 bg-white px-6 text-sm font-black uppercase text-[#2b0700] transition hover:border-orange-300 hover:text-orange-600">
                        Lihat Menu
                    </a>
                </div>
            </div>

            <img src="{{ asset('images/pizzart/hero-pizza.jpg') }}" alt="Pizza with melting cheese" class="mx-auto w-full max-w-sm object-contain sm:max-w-md lg:hidden">
        </div>
    </section>

    <section id="About" class="relative overflow-hidden bg-[#fffaf3] px-4 py-20 sm:px-6 lg:px-8">
        <p class="story-outline absolute left-[-24px] top-4 whitespace-nowrap text-6xl font-black sm:text-8xl lg:text-9xl">
            our story our story our story
        </p>

        <div class="relative mx-auto max-w-7xl">
            <h2 class="text-center text-5xl font-black text-orange-500 sm:text-6xl">Our Story</h2>

            <div class="mt-14 grid items-center gap-10 lg:grid-cols-[0.9fr_1.1fr]">
                <div class="overflow-hidden rounded-lg border border-black/10 bg-white shadow-sm">
                    <img src="{{ asset('images/pizzart/story-pizza.jpg') }}" alt="Pepperoni pizza on wooden board" class="aspect-square w-full object-cover">
                </div>

                <div>
                    <p class="mb-3 text-sm font-black uppercase text-green-700">Resep Warisan, Rasa Abadi</p>
                    <h3 class="text-3xl font-black leading-tight text-[#2b0700] sm:text-4xl">
                        Dari dapur kecil ke meja pelanggan.
                    </h3>
                    <p class="mt-5 text-base font-medium leading-8 text-[#4a3529]">
                        Kisah kami bermula dari dapur kecil penuh cinta, tempat resep pizza keluarga diwariskan selama tiga generasi. Setiap gigitan membawa cita rasa otentik dari adonan yang difermentasi, saus segar, dan topping pilihan.
                    </p>
                    <p class="mt-4 text-base font-medium leading-8 text-[#4a3529]">
                        Frontend ini mempertahankan karakter desain awal lo: putih bersih, orange sebagai aksen utama, logo kuat, foto pizza besar, dan tombol order yang jelas.
                    </p>
                    <a href="{{ route('orders.index') }}" class="mt-7 inline-flex h-12 items-center rounded-md bg-[#2d6a32] px-6 text-sm font-black uppercase text-white transition hover:bg-[#245427]">
                        Mulai Order
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="Menu" class="bg-white px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="max-w-2xl">
                <p class="text-sm font-black uppercase text-orange-600">Restaurant tools</p>
                <h2 class="mt-2 text-3xl font-black text-[#2b0700] sm:text-4xl">Kelola restoran dari satu tempat.</h2>
            </div>

            <div class="mt-9 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
                <a href="{{ route('orders.index') }}" class="rounded-lg border border-black/10 bg-[#fffaf3] p-5 shadow-sm transition hover:-translate-y-1 hover:border-orange-300 hover:shadow-md">
                    <p class="text-sm font-black uppercase text-orange-600">Kasir</p>
                    <h3 class="mt-3 text-xl font-black text-[#2b0700]">Input Pesanan</h3>
                    <p class="mt-3 text-sm font-medium leading-6 text-[#5b4537]">Pilih menu, atur jumlah, dan hitung total langsung.</p>
                </a>
                <a href="{{ route('orders.list') }}" class="rounded-lg border border-black/10 bg-[#fffaf3] p-5 shadow-sm transition hover:-translate-y-1 hover:border-orange-300 hover:shadow-md">
                    <p class="text-sm font-black uppercase text-green-700">Order</p>
                    <h3 class="mt-3 text-xl font-black text-[#2b0700]">Daftar Pesanan</h3>
                    <p class="mt-3 text-sm font-medium leading-6 text-[#5b4537]">Pantau status pending dan paid dengan tampilan rapi.</p>
                </a>
                <a href="{{ route('products.index') }}" class="rounded-lg border border-black/10 bg-[#fffaf3] p-5 shadow-sm transition hover:-translate-y-1 hover:border-orange-300 hover:shadow-md">
                    <p class="text-sm font-black uppercase text-orange-600">Menu</p>
                    <h3 class="mt-3 text-xl font-black text-[#2b0700]">Data Pizza</h3>
                    <p class="mt-3 text-sm font-medium leading-6 text-[#5b4537]">Tambah foto, harga, kategori, dan status menu.</p>
                </a>
                <a href="{{ route('categories.index') }}" class="rounded-lg border border-black/10 bg-[#fffaf3] p-5 shadow-sm transition hover:-translate-y-1 hover:border-orange-300 hover:shadow-md">
                    <p class="text-sm font-black uppercase text-green-700">Kategori</p>
                    <h3 class="mt-3 text-xl font-black text-[#2b0700]">Kelompok Menu</h3>
                    <p class="mt-3 text-sm font-medium leading-6 text-[#5b4537]">Rapikan kategori supaya kasir gampang scan.</p>
                </a>
            </div>
        </div>
    </section>
@endsection
