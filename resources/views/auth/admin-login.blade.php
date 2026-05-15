<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - PizzArt</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#fffaf3] text-[#1f120c] antialiased">
    <main class="grid min-h-screen lg:grid-cols-[1fr_520px]">
        <section class="relative hidden overflow-hidden bg-white lg:block">
            <img src="{{ asset('images/pizzart/hero-pizza.jpg') }}" alt="Fresh pizza" class="absolute inset-0 h-full w-full object-contain object-center">
            <div class="absolute inset-0 bg-[linear-gradient(90deg,rgba(255,255,255,0.95)_0%,rgba(255,255,255,0.78)_42%,rgba(255,250,243,0.25)_100%)]"></div>
            <div class="relative flex h-full flex-col justify-between p-12">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                    <img src="{{ asset('images/pizzart/logo.jpg') }}" alt="PizzArt logo" class="h-14 w-14 rounded-full border border-orange-200 object-cover">
                    <span class="text-2xl font-black text-[#2b0700]">Pizz<span class="text-orange-500">Art</span></span>
                </a>
                <div class="max-w-xl">
                    <p class="text-sm font-black uppercase text-orange-600">Admin workspace</p>
                    <h1 class="mt-3 text-5xl font-black leading-tight text-[#2b0700]">Kelola menu dan pesanan dari satu tempat.</h1>
                    <p class="mt-5 text-base font-medium leading-8 text-[#5b4537]">Masuk untuk mengatur produk, kategori, kasir, dan status pembayaran restoran.</p>
                </div>
            </div>
        </section>

        <section class="flex min-h-screen items-center justify-center px-4 py-10 sm:px-6 lg:px-10">
            <div class="w-full max-w-md">
                <a href="{{ route('home') }}" class="mb-8 inline-flex items-center gap-3 lg:hidden">
                    <img src="{{ asset('images/pizzart/logo.jpg') }}" alt="PizzArt logo" class="h-12 w-12 rounded-full border border-orange-200 object-cover">
                    <span class="text-2xl font-black text-[#2b0700]">Pizz<span class="text-orange-500">Art</span></span>
                </a>

                <div class="rounded-lg border border-black/10 bg-white p-6 shadow-sm sm:p-8">
                    <p class="text-sm font-black uppercase text-orange-600">Login Admin</p>
                    <h2 class="mt-2 text-3xl font-black text-[#2b0700]">Selamat datang kembali</h2>

                    @if ($errors->any())
                        <div class="mt-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-800">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('admin.login.store') }}" method="POST" class="mt-6 space-y-5">
                        @csrf
                        <div>
                            <label class="label" for="email">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" class="field" placeholder="admin@pizzart.test" autocomplete="email" required autofocus>
                        </div>

                        <div>
                            <label class="label" for="password">Password</label>
                            <input id="password" type="password" name="password" class="field" placeholder="Masukkan password" autocomplete="current-password" required>
                        </div>

                        <label class="flex items-center gap-3 text-sm font-bold text-[#5b4537]">
                            <input type="checkbox" name="remember" value="1" class="h-4 w-4 rounded border-black/20 text-orange-500">
                            Ingat sesi login
                        </label>

                        <button type="submit" class="inline-flex h-12 w-full items-center justify-center rounded-md bg-orange-500 px-6 text-sm font-black uppercase text-white transition hover:bg-orange-600">
                            Masuk Admin
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
