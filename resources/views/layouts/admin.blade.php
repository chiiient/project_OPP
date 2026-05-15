<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin - PizzArt')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#f6f1ea] text-[#1f120c] antialiased">
    @php
        $adminItems = [
            ['label' => 'Kasir', 'route' => 'admin.orders.index', 'active' => 'admin.orders.index'],
            ['label' => 'Pesanan', 'route' => 'admin.orders.list', 'active' => ['admin.orders.list', 'admin.orders.show']],
            ['label' => 'Menu', 'route' => 'admin.products.index', 'active' => 'admin.products.*'],
            ['label' => 'Kategori', 'route' => 'admin.categories.index', 'active' => 'admin.categories.*'],
        ];
    @endphp

    <div class="lg:grid lg:min-h-screen lg:grid-cols-[280px_1fr]">
        <aside class="hidden border-r border-black/10 bg-[#1f120c] text-white lg:block">
            <div class="sticky top-0 flex h-screen flex-col px-5 py-6">
                <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/pizzart/logo.jpg') }}" alt="PizzArt logo" class="h-12 w-12 rounded-full border border-orange-300/40 object-cover">
                    <div>
                        <p class="text-xl font-black">Pizz<span class="text-orange-400">Art</span></p>
                        <p class="text-xs font-bold uppercase text-white/50">Admin Panel</p>
                    </div>
                </a>

                <nav class="mt-10 grid gap-2">
                    @foreach ($adminItems as $item)
                        @php
                            $isActive = request()->routeIs(...(array) $item['active']);
                        @endphp
                        <a href="{{ route($item['route']) }}" class="rounded-md px-4 py-3 text-sm font-black uppercase transition {{ $isActive ? 'bg-orange-500 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>

                <div class="mt-auto rounded-lg border border-white/10 bg-white/5 p-4">
                    <p class="text-xs font-black uppercase text-orange-300">Status</p>
                    <p class="mt-2 text-sm font-medium leading-6 text-white/70">Kelola menu, kategori, dan pesanan restoran dari area internal.</p>
                </div>
            </div>
        </aside>

        <div class="min-w-0">
            <header class="sticky top-0 z-40 border-b border-black/10 bg-white/95 shadow-sm backdrop-blur">
                <div class="flex h-16 items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
                    <div>
                        <p class="text-xs font-black uppercase text-orange-600">PizzArt Admin</p>
                        <h1 class="text-lg font-black text-[#2b0700]">@yield('adminHeading', 'Restaurant Workspace')</h1>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="hidden text-right sm:block">
                            <p class="text-sm font-black text-[#2b0700]">{{ auth()->user()->name }}</p>
                            <p class="text-xs font-bold text-[#6b4a37]">{{ auth()->user()->email }}</p>
                        </div>
                        <a href="{{ route('home') }}" class="inline-flex h-10 items-center rounded-md border border-black/10 bg-white px-4 text-sm font-black text-[#2b0700] transition hover:border-orange-300 hover:text-orange-600">
                            View Site
                        </a>
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="inline-flex h-10 items-center rounded-md bg-[#1f120c] px-4 text-sm font-black text-white transition hover:bg-orange-600">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>

                <nav class="flex gap-2 overflow-x-auto border-t border-black/10 px-4 py-2 sm:px-6 lg:hidden">
                    @foreach ($adminItems as $item)
                        @php
                            $isActive = request()->routeIs(...(array) $item['active']);
                        @endphp
                        <a href="{{ route($item['route']) }}" class="whitespace-nowrap rounded-md px-3 py-2 text-xs font-black uppercase transition {{ $isActive ? 'bg-orange-500 text-white' : 'bg-[#fffaf3] text-[#2b0700] hover:text-orange-600' }}">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
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
        </div>
    </div>

    @stack('scripts')
</body>
</html>
