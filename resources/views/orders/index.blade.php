@extends('layouts.admin')

@section('title', 'Kasir - PizzArt')
@section('adminHeading', 'Kasir')

@section('content')
    <section class="px-4 py-10 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm font-black uppercase text-orange-600">Kasir restoran</p>
                    <h1 class="mt-2 text-4xl font-black text-[#2b0700]">Buat Pesanan Baru</h1>
                    <p class="mt-3 max-w-2xl text-sm font-medium leading-6 text-[#5b4537]">
                        Pilih menu pizza, atur jumlah, lalu simpan pesanan pelanggan.
                    </p>
                </div>
                <a href="{{ route('admin.orders.list') }}" class="inline-flex h-11 items-center justify-center rounded-md border border-black/10 bg-white px-5 text-sm font-black uppercase text-[#2b0700] transition hover:border-orange-300 hover:text-orange-600">
                    Daftar Pesanan
                </a>
            </div>

            <form action="{{ route('admin.orders.store') }}" method="POST" id="order-form" class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_360px]">
                @csrf

                <div>
                    <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
                        @forelse($products as $product)
                            @php
                                $available = (bool) $product->is_available;
                            @endphp
                            <article class="rounded-lg border border-black/10 bg-white shadow-sm transition hover:-translate-y-1 hover:border-orange-300 hover:shadow-md {{ $available ? '' : 'opacity-60' }}">
                                <img
                                    src="{{ $product->image ? asset('images/products/' . $product->image) : asset('images/pizzart/logo.jpg') }}"
                                    alt="{{ $product->name }}"
                                    class="aspect-[4/3] w-full rounded-t-lg object-cover"
                                >
                                <div class="p-4">
                                    <div class="flex items-start justify-between gap-3">
                                        <div>
                                            <p class="text-xs font-black uppercase text-orange-600">{{ $product->category?->name ?? 'Menu' }}</p>
                                            <h2 class="mt-1 text-lg font-black leading-snug text-[#2b0700]">{{ $product->name }}</h2>
                                        </div>
                                        @if ($available)
                                            <span class="rounded-md bg-green-100 px-2 py-1 text-[11px] font-black uppercase text-green-700">Ready</span>
                                        @else
                                            <span class="rounded-md bg-red-100 px-2 py-1 text-[11px] font-black uppercase text-red-700">Habis</span>
                                        @endif
                                    </div>

                                    <p class="mt-3 line-clamp-2 min-h-12 text-sm font-medium leading-6 text-[#6b4a37]">
                                        {{ $product->description ?: 'Pizza fresh dengan topping pilihan.' }}
                                    </p>

                                    <div class="mt-4 flex items-center justify-between gap-3">
                                        <p class="text-lg font-black text-[#2b0700]">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                        <div class="flex h-11 items-center rounded-md border border-black/10 bg-[#fffaf3]">
                                            <button type="button" class="h-10 w-10 text-lg font-black text-[#2b0700] transition hover:text-orange-600 disabled:cursor-not-allowed disabled:opacity-40" data-step="-1" data-target="qty-{{ $product->id }}" @disabled(! $available)>-</button>
                                            <input
                                                id="qty-{{ $product->id }}"
                                                type="number"
                                                name="items[{{ $product->id }}][qty]"
                                                value="0"
                                                min="0"
                                                class="order-qty h-10 w-14 bg-transparent text-center text-sm font-black text-[#2b0700] outline-none"
                                                data-price="{{ $product->price }}"
                                                @readonly(! $available)
                                            >
                                            <button type="button" class="h-10 w-10 text-lg font-black text-[#2b0700] transition hover:text-orange-600 disabled:cursor-not-allowed disabled:opacity-40" data-step="1" data-target="qty-{{ $product->id }}" @disabled(! $available)>+</button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="items[{{ $product->id }}][price]" value="{{ $product->price }}">
                                </div>
                            </article>
                        @empty
                            <div class="rounded-lg border border-black/10 bg-white p-8 text-center shadow-sm sm:col-span-2 xl:col-span-3">
                                <p class="text-lg font-black text-[#2b0700]">Belum ada menu.</p>
                                <p class="mt-2 text-sm font-medium text-[#6b4a37]">Tambah menu dulu sebelum membuat pesanan.</p>
                                <a href="{{ route('admin.products.create') }}" class="mt-5 inline-flex h-11 items-center rounded-md bg-orange-500 px-5 text-sm font-black uppercase text-white transition hover:bg-orange-600">
                                    Tambah Menu
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>

                <aside class="h-max rounded-lg border border-black/10 bg-white p-5 shadow-sm lg:sticky lg:top-28">
                    <p class="text-sm font-black uppercase text-orange-600">Checkout</p>
                    <h2 class="mt-2 text-2xl font-black text-[#2b0700]">Informasi Pelanggan</h2>

                    <div class="mt-5 space-y-4">
                        <div>
                            <label class="label" for="customer_name">Nama Pelanggan</label>
                            <input id="customer_name" type="text" name="customer_name" value="{{ old('customer_name') }}" class="field" placeholder="Nama pelanggan" required>
                        </div>
                        <div>
                            <label class="label" for="table_number">Nomor Meja</label>
                            <input id="table_number" type="number" name="table_number" value="{{ old('table_number') }}" class="field" placeholder="12" min="1" required>
                        </div>
                    </div>

                    <div class="mt-6 border-y border-orange-200 bg-orange-50 py-4">
                        <div class="flex items-center justify-between gap-4">
                            <span class="text-sm font-black uppercase text-[#6b4a37]">Item</span>
                            <span id="order-items-count" class="text-sm font-black text-[#2b0700]">0</span>
                        </div>
                        <div class="mt-3 flex items-center justify-between gap-4">
                            <span class="text-sm font-black uppercase text-[#6b4a37]">Total</span>
                            <span id="order-total" class="text-2xl font-black text-[#2b0700]">Rp 0</span>
                        </div>
                    </div>

                    <button type="submit" class="mt-5 inline-flex h-12 w-full items-center justify-center rounded-md bg-orange-500 px-6 text-sm font-black uppercase text-white transition hover:bg-orange-600 disabled:cursor-not-allowed disabled:opacity-50" @disabled($products->isEmpty())>
                        Simpan Pesanan
                    </button>
                </aside>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        const orderFormatter = new Intl.NumberFormat('id-ID');
        const qtyInputs = Array.from(document.querySelectorAll('.order-qty'));
        const totalEl = document.getElementById('order-total');
        const countEl = document.getElementById('order-items-count');

        function updateOrderTotal() {
            let total = 0;
            let count = 0;

            qtyInputs.forEach((input) => {
                const qty = Math.max(0, Number(input.value || 0));
                const price = Number(input.dataset.price || 0);
                total += qty * price;
                count += qty;
            });

            totalEl.textContent = `Rp ${orderFormatter.format(total)}`;
            countEl.textContent = orderFormatter.format(count);
        }

        document.addEventListener('click', (event) => {
            const button = event.target.closest('[data-step]');
            if (!button) return;

            const input = document.getElementById(button.dataset.target);
            if (!input) return;

            const nextValue = Math.max(0, Number(input.value || 0) + Number(button.dataset.step));
            input.value = nextValue;
            updateOrderTotal();
        });

        qtyInputs.forEach((input) => {
            input.addEventListener('input', () => {
                if (Number(input.value) < 0) input.value = 0;
                updateOrderTotal();
            });
        });

        updateOrderTotal();
    </script>
@endpush
