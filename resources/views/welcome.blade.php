@extends('layouts.client')

@section('title', 'PizzArt - Fresh & Tasty')

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
                    Nikmati pizza hangat dengan topping melimpah, keju lumer, dan rasa rumahan yang siap menemani makan siang, malam, atau kumpul bareng orang terdekat.
                </p>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('client.orders.index') }}" class="inline-flex h-12 items-center justify-center rounded-md bg-orange-500 px-6 text-sm font-black uppercase text-white shadow-sm transition hover:bg-orange-600">
                        Order Now
                    </a>
                    <a href="{{ route('home') }}#Menu" class="inline-flex h-12 items-center justify-center rounded-md border border-[#2b0700]/15 bg-white px-6 text-sm font-black uppercase text-[#2b0700] transition hover:border-orange-300 hover:text-orange-600">
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
                    <a href="{{ route('client.orders.index') }}" class="mt-7 inline-flex h-12 items-center rounded-md bg-[#2d6a32] px-6 text-sm font-black uppercase text-white transition hover:bg-[#245427]">
                        Mulai Order
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="Menu" class="bg-white px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div class="max-w-2xl">
                    <p class="text-sm font-black uppercase text-orange-600">PizzArt menu</p>
                    <h2 class="mt-2 text-3xl font-black text-[#2b0700] sm:text-4xl">Pilih pizza favorit dari dapur kami.</h2>
                    <p class="mt-3 text-sm font-medium leading-6 text-[#5b4537]">
                        Dari topping klasik sampai signature pizza, setiap menu dibuat hangat dengan bahan pilihan.
                    </p>
                </div>
                <a href="{{ route('client.orders.index') }}" class="inline-flex h-11 items-center justify-center rounded-md bg-orange-500 px-5 text-sm font-black uppercase text-white transition hover:bg-orange-600">
                    Order Menu
                </a>
            </div>

            <div class="mt-9 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($products as $product)
                    <article class="overflow-hidden rounded-lg border border-black/10 bg-[#fffaf3] shadow-sm transition hover:-translate-y-1 hover:border-orange-300 hover:shadow-md">
                        <img
                            src="{{ $product->image ? asset('images/products/' . $product->image) : asset('images/pizzart/logo.jpg') }}"
                            alt="{{ $product->name }}"
                            class="aspect-[4/3] w-full bg-white object-cover"
                        >
                        <div class="p-5">
                            <p class="text-xs font-black uppercase text-orange-600">{{ $product->category?->name ?? 'Menu Pizza' }}</p>
                            <div class="mt-2 flex items-start justify-between gap-4">
                                <h3 class="text-xl font-black leading-snug text-[#2b0700]">{{ $product->name }}</h3>
                                <span class="whitespace-nowrap text-lg font-black text-orange-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>
                            <p class="mt-3 line-clamp-2 min-h-12 text-sm font-medium leading-6 text-[#5b4537]">
                                {{ $product->description ?: 'Pizza fresh dengan topping pilihan dari dapur PizzArt.' }}
                            </p>
                            <div class="mt-5 flex items-center justify-between gap-3">
                                <span class="rounded-md bg-green-100 px-3 py-1 text-xs font-black uppercase text-green-700">Ready</span>
                                <a href="{{ route('client.orders.index') }}" class="inline-flex h-10 items-center rounded-md bg-orange-500 px-4 text-sm font-black uppercase text-white transition hover:bg-orange-600">
                                    Pilih Menu
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="rounded-lg border border-dashed border-orange-300 bg-orange-50 p-8 text-center md:col-span-2 lg:col-span-3">
                        <p class="text-lg font-black text-[#2b0700]">Menu belum tersedia.</p>
                        <p class="mt-2 text-sm font-medium text-[#6b4a37]">Kami sedang menyiapkan pilihan terbaik untuk kamu.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="Gallery" class="overflow-hidden bg-[#1f120c] px-4 py-20 text-white sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="grid gap-10 lg:grid-cols-[0.85fr_1.15fr] lg:items-end">
                <div>
                    <p class="text-sm font-black uppercase text-orange-300">Gallery</p>
                    <h2 class="mt-3 text-4xl font-black leading-tight sm:text-5xl">
                        Potongan rasa dari dapur PizzArt.
                    </h2>
                    <p class="mt-5 max-w-xl text-sm font-medium leading-7 text-white/70">
                        Lihat lebih dekat warna saus, lelehan keju, dan tekstur roti yang bikin setiap pizza terasa hidup sebelum sampai ke meja.
                    </p>
                </div>
                <div class="grid grid-cols-3 gap-3 text-center">
                    <div class="border-l border-white/10 px-4">
                        <p class="text-3xl font-black text-orange-300">{{ $products->count() }}</p>
                        <p class="mt-1 text-xs font-black uppercase text-white/50">Pilihan menu</p>
                    </div>
                    <div class="border-l border-white/10 px-4">
                        <p class="text-3xl font-black text-orange-300">{{ $products->whereNotNull('image')->count() }}</p>
                        <p class="mt-1 text-xs font-black uppercase text-white/50">Foto menu</p>
                    </div>
                    <div class="border-l border-white/10 px-4">
                        <p class="text-3xl font-black text-orange-300">{{ $products->pluck('category_id')->filter()->unique()->count() }}</p>
                        <p class="mt-1 text-xs font-black uppercase text-white/50">Kategori</p>
                    </div>
                </div>
            </div>

            @php
                $galleryProducts = $products->whereNotNull('image')->values();
            @endphp

            <div class="mt-12">
                @if ($galleryProducts->isNotEmpty())
                    <div class="grid auto-rows-[180px] gap-4 md:grid-cols-4 md:auto-rows-[220px]">
                        @foreach ($galleryProducts as $product)
                            @php
                                $tileClass = match ($loop->index % 6) {
                                    0 => 'md:col-span-2 md:row-span-2',
                                    3 => 'md:col-span-2',
                                    default => '',
                                };
                            @endphp
                            <figure class="group relative overflow-hidden rounded-lg border border-white/10 bg-white/5 {{ $tileClass }}">
                                <img
                                    src="{{ asset('images/products/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                    class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                >
                                <figcaption class="absolute inset-x-0 bottom-0 bg-[linear-gradient(0deg,rgba(31,18,12,0.92)_0%,rgba(31,18,12,0)_100%)] p-5 pt-16">
                                    <p class="text-xs font-black uppercase text-orange-300">{{ $product->category?->name ?? 'PizzArt' }}</p>
                                    <h3 class="mt-1 text-xl font-black leading-tight">{{ $product->name }}</h3>
                                </figcaption>
                            </figure>
                        @endforeach
                    </div>
                @else
                    <div class="rounded-lg border border-dashed border-white/20 bg-white/5 p-8 text-center">
                        <p class="text-lg font-black">Gallery belum punya foto.</p>
                        <p class="mt-2 text-sm font-medium text-white/60">Foto pilihan dari dapur kami akan segera hadir.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section id="Contact" class="bg-[#fffaf3] px-4 py-20 sm:px-6 lg:px-8">
        <div class="mx-auto grid max-w-7xl gap-10 lg:grid-cols-[0.9fr_1.1fr]">
            <div>
                <p class="text-sm font-black uppercase text-orange-600">Contact Us</p>
                <h2 class="mt-3 text-4xl font-black leading-tight text-[#2b0700] sm:text-5xl">
                    Datang, pesan, atau tanya dulu.
                </h2>
                <p class="mt-5 max-w-xl text-sm font-medium leading-7 text-[#5b4537]">
                    Kami siap menyambut kamu untuk makan di tempat, pesan lebih dulu, atau tanya menu favorit hari ini.
                </p>

                <div class="mt-8 grid gap-4 sm:grid-cols-2">
                    <div class="rounded-lg border border-black/10 bg-white p-5 shadow-sm">
                        <p class="text-xs font-black uppercase text-orange-600">Alamat</p>
                        <p class="mt-2 text-sm font-bold leading-6 text-[#2b0700]">Jl. Mozzarella Raya No. 18, Jakarta Selatan</p>
                    </div>
                    <div class="rounded-lg border border-black/10 bg-white p-5 shadow-sm">
                        <p class="text-xs font-black uppercase text-orange-600">Jam Buka</p>
                        <p class="mt-2 text-sm font-bold leading-6 text-[#2b0700]">Setiap hari, 10.00 - 22.00</p>
                    </div>
                    <div class="rounded-lg border border-black/10 bg-white p-5 shadow-sm">
                        <p class="text-xs font-black uppercase text-orange-600">WhatsApp</p>
                        <p class="mt-2 text-sm font-bold leading-6 text-[#2b0700]">+62 812-3456-7890</p>
                    </div>
                    <div class="rounded-lg border border-black/10 bg-white p-5 shadow-sm">
                        <p class="text-xs font-black uppercase text-orange-600">Email</p>
                        <p class="mt-2 text-sm font-bold leading-6 text-[#2b0700]">hello@pizzart.test</p>
                    </div>
                </div>
            </div>

            <div class="grid min-h-[420px] content-between rounded-lg border border-black/10 bg-white p-6 shadow-sm">
                <div>
                    <p class="text-xs font-black uppercase text-green-700">Visit our kitchen</p>
                    <h3 class="mt-2 text-3xl font-black text-[#2b0700]">PizzArt Kitchen</h3>
                    <p class="mt-3 text-sm font-medium leading-7 text-[#5b4537]">
                        Temukan lokasi kami dan mampir untuk menikmati pizza hangat langsung dari dapur.
                    </p>
                </div>

                <div class="mt-8 overflow-hidden rounded-lg border border-orange-200 bg-[#fff3e2]">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d17639.714852517092!2d106.91570031620418!3d-6.156863998446404!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5b76e891967%3A0x7734f083b8028ad0!2sD%27Kanteen%20by%20Mr.%20Koki!5e0!3m2!1sid!2sid!4v1778881635333!5m2!1sid!2sid"
                        class="h-72 w-full"
                        style="border:0;"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                    ></iframe>
                </div>

                <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('client.orders.index') }}" class="inline-flex h-11 items-center justify-center rounded-md bg-orange-500 px-5 text-sm font-black uppercase text-white transition hover:bg-orange-600">
                        Order Now
                    </a>
                    <a href="https://maps.app.goo.gl/KRdnM99kKfa5S3Q89" target="_blank" rel="noopener noreferrer" class="inline-flex h-11 items-center justify-center rounded-md border border-black/10 bg-white px-5 text-sm font-black uppercase text-[#2b0700] transition hover:border-orange-300 hover:text-orange-600">
                        Buka Maps
                    </a>
                    <a href="https://wa.me/6281234567890" class="inline-flex h-11 items-center justify-center rounded-md border border-black/10 bg-white px-5 text-sm font-black uppercase text-[#2b0700] transition hover:border-orange-300 hover:text-orange-600">
                        Chat WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
