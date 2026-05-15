<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'PizzArt')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#fffaf3] text-[#1f120c] antialiased">
    <header class="sticky top-0 z-50 border-b border-black/10 bg-white/95 shadow-[0_8px_24px_rgba(31,18,12,0.10)] backdrop-blur">
        <nav class="mx-auto flex h-20 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/pizzart/logo.jpg') }}" alt="PizzArt logo" class="h-14 w-14 rounded-full border border-orange-200 object-cover">
                <span class="text-2xl font-black text-[#2b0700]">Pizz<span class="text-orange-500">Art</span></span>
            </a>

            <div class="hidden items-center gap-7 md:flex">
                <a href="{{ route('home') }}#Home" class="nav-link">Home</a>
                <a href="{{ route('home') }}#About" class="nav-link">Our Story</a>
                <a href="{{ route('home') }}#Menu" class="nav-link">Menu</a>
                <a href="{{ route('home') }}#Gallery" class="nav-link">Gallery</a>
                <a href="{{ route('home') }}#Contact" class="nav-link">Contact</a>
            </div>

            <a href="{{ route('client.orders.index') }}" class="hidden h-11 items-center rounded-md bg-orange-500 px-5 text-sm font-bold text-white shadow-sm transition hover:bg-orange-600 md:inline-flex">
                Order Now
            </a>

            <details class="group relative md:hidden">
                <summary class="flex h-11 w-11 cursor-pointer list-none items-center justify-center rounded-md border border-black/10 bg-white text-[#2b0700] shadow-sm">
                    <span class="sr-only">Open navigation</span>
                    <svg class="h-6 w-6 group-open:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 7h16M4 12h16M4 17h16" stroke-linecap="round"/>
                    </svg>
                    <svg class="hidden h-6 w-6 group-open:block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 6l12 12M18 6L6 18" stroke-linecap="round"/>
                    </svg>
                </summary>
                <div class="absolute right-0 mt-3 w-56 rounded-lg border border-black/10 bg-white p-2 shadow-xl">
                    <a href="{{ route('home') }}#Home" class="block rounded-md px-4 py-3 text-sm font-bold uppercase text-[#2b0700] transition hover:bg-orange-50 hover:text-orange-600">Home</a>
                    <a href="{{ route('home') }}#About" class="block rounded-md px-4 py-3 text-sm font-bold uppercase text-[#2b0700] transition hover:bg-orange-50 hover:text-orange-600">Our Story</a>
                    <a href="{{ route('home') }}#Menu" class="block rounded-md px-4 py-3 text-sm font-bold uppercase text-[#2b0700] transition hover:bg-orange-50 hover:text-orange-600">Menu</a>
                    <a href="{{ route('home') }}#Gallery" class="block rounded-md px-4 py-3 text-sm font-bold uppercase text-[#2b0700] transition hover:bg-orange-50 hover:text-orange-600">Gallery</a>
                    <a href="{{ route('home') }}#Contact" class="block rounded-md px-4 py-3 text-sm font-bold uppercase text-[#2b0700] transition hover:bg-orange-50 hover:text-orange-600">Contact</a>
                    <a href="{{ route('client.orders.index') }}" class="block rounded-md px-4 py-3 text-sm font-bold uppercase text-orange-600 transition hover:bg-orange-50">Order Now</a>
                </div>
            </details>
        </nav>
    </header>

    <main>
        @if (session('success'))
            <div class="mx-auto mt-6 max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm font-semibold text-green-800">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="mx-auto mt-6 max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-800">
                    <p class="mb-2 font-black">Ada input yang perlu diperbaiki:</p>
                    <ul class="list-disc space-y-1 pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="border-t border-black/10 bg-[#1f120c] text-white">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 py-12 sm:px-6 lg:grid-cols-[1.4fr_0.8fr_0.8fr_1fr] lg:px-8">
            <div>
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                    <img src="{{ asset('images/pizzart/logo.jpg') }}" alt="PizzArt logo" class="h-14 w-14 rounded-full border border-orange-300/40 object-cover">
                    <span class="text-2xl font-black">Pizz<span class="text-orange-400">Art</span></span>
                </a>
                <p class="mt-5 max-w-sm text-sm font-medium leading-7 text-white/70">
                    Pizza hangat, topping melimpah, dan suasana makan yang nyaman untuk setiap kunjungan.
                </p>
                <a href="{{ route('client.orders.index') }}" class="mt-6 inline-flex h-11 items-center rounded-md bg-orange-500 px-5 text-sm font-black uppercase text-white transition hover:bg-orange-600">
                    Order Now
                </a>
            </div>

            <div>
                <h2 class="text-sm font-black uppercase tracking-wide text-orange-300">Navigasi</h2>
                <div class="mt-5 grid gap-3 text-sm font-bold text-white/75">
                    <a href="{{ route('home') }}#Home" class="transition hover:text-orange-300">Home</a>
                    <a href="{{ route('home') }}#About" class="transition hover:text-orange-300">Our Story</a>
                    <a href="{{ route('home') }}#Menu" class="transition hover:text-orange-300">Menu</a>
                    <a href="{{ route('home') }}#Gallery" class="transition hover:text-orange-300">Gallery</a>
                    <a href="{{ route('home') }}#Contact" class="transition hover:text-orange-300">Contact</a>
                    <a href="{{ route('client.orders.index') }}" class="transition hover:text-orange-300">Order</a>
                </div>
            </div>

            <div>
                <h2 class="text-sm font-black uppercase tracking-wide text-orange-300">Favorit</h2>
                <div class="mt-5 grid gap-3 text-sm font-bold text-white/75">
                    <p>Fresh pizza</p>
                    <p>Cheesy toppings</p>
                    <p>Dine-in order</p>
                    <p>Fast service</p>
                </div>
            </div>

            <div>
                <h2 class="text-sm font-black uppercase tracking-wide text-orange-300">Info Restoran</h2>
                <div class="mt-5 space-y-4 text-sm font-medium leading-6 text-white/75">
                    <p>
                        <span class="block font-black text-white">Jam buka</span>
                        Setiap hari, 10.00 - 22.00
                    </p>
                    <p>
                        <span class="block font-black text-white">Kontak</span>
                        +62 812-3456-7890
                    </p>
                    <p>
                        <span class="block font-black text-white">Lokasi</span>
                        Fresh from the PizzArt kitchen
                    </p>
                </div>
            </div>
        </div>

        <div class="border-t border-white/10 px-4 py-5 sm:px-6 lg:px-8">
            <div class="mx-auto flex max-w-7xl flex-col gap-3 text-xs font-bold uppercase text-white/50 sm:flex-row sm:items-center sm:justify-between">
                <p>&copy; {{ date('Y') }} PizzArt Fresh & Tasty.</p>
                <p>Fresh pizza, simple ordering, better service.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
