<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'PizzArt')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#fffaf3] text-[#1f120c] antialiased">
    @php
        $navItems = [
            ['label' => 'Home', 'route' => 'home', 'active' => 'home'],
            ['label' => 'Kasir', 'route' => 'orders.index', 'active' => 'orders.index'],
            ['label' => 'Pesanan', 'route' => 'orders.list', 'active' => ['orders.list', 'orders.show']],
            ['label' => 'Menu', 'route' => 'products.index', 'active' => 'products.*'],
            ['label' => 'Kategori', 'route' => 'categories.index', 'active' => 'categories.*'],
        ];
    @endphp

    <header class="sticky top-0 z-50 border-b border-black/10 bg-white/95 shadow-[0_8px_24px_rgba(31,18,12,0.10)] backdrop-blur">
        <nav class="mx-auto flex h-20 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/pizzart/logo.jpg') }}" alt="PizzArt logo" class="h-14 w-14 rounded-full border border-orange-200 object-cover">
                <span class="text-2xl font-black text-[#2b0700]">Pizz<span class="text-orange-500">Art</span></span>
            </a>

            <div class="hidden items-center gap-7 md:flex">
                @foreach ($navItems as $item)
                    @php
                        $isActive = request()->routeIs(...(array) $item['active']);
                    @endphp
                    <a
                        href="{{ route($item['route']) }}"
                        class="nav-link {{ $isActive ? 'nav-link-active' : '' }}"
                    >
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>

            <div class="hidden items-center gap-2 md:flex">
                <a href="{{ route('orders.index') }}" class="inline-flex h-11 items-center rounded-md bg-orange-500 px-5 text-sm font-bold text-white shadow-sm transition hover:bg-orange-600">
                    Order Now
                </a>
            </div>

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
                    @foreach ($navItems as $item)
                        <a
                            href="{{ route($item['route']) }}"
                            class="block rounded-md px-4 py-3 text-sm font-bold uppercase text-[#2b0700] transition hover:bg-orange-50 hover:text-orange-600"
                        >
                            {{ $item['label'] }}
                        </a>
                    @endforeach
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

    <footer class="border-t border-black/10 bg-[#1f120c] px-4 py-8 text-white sm:px-6 lg:px-8">
        <div class="mx-auto flex max-w-7xl flex-col gap-4 text-sm sm:flex-row sm:items-center sm:justify-between">
            <p class="font-bold">PizzArt Fresh & Tasty</p>
            <p class="text-white/70">Built for menu, cashier, and restaurant order flow.</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
