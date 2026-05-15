@extends('layouts.client')

@section('title', 'Order Menu - PizzArt')

@section('content')
    <section class="bg-white px-4 py-12 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm font-black uppercase text-orange-600">Order PizzArt</p>
                    <h1 class="mt-2 text-4xl font-black text-[#2b0700]">Pilih Menu Pesanan</h1>
                    <p class="mt-3 max-w-2xl text-sm font-medium leading-6 text-[#5b4537]">
                        Pilih pizza, isi nama dan nomor meja, lalu tim kami akan menyiapkan pesananmu.
                    </p>
                </div>
                <a href="{{ route('home') }}#Menu" class="inline-flex h-11 items-center justify-center rounded-md border border-black/10 bg-white px-5 text-sm font-black uppercase text-[#2b0700] transition hover:border-orange-300 hover:text-orange-600">
                    Lihat Menu
                </a>
            </div>

            <form action="{{ route('client.orders.store') }}" method="POST" id="order-form" class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_360px]">
                @csrf

                <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
                    @forelse($products as $product)
                        <article class="rounded-lg border border-black/10 bg-[#fffaf3] shadow-sm transition hover:-translate-y-1 hover:border-orange-300 hover:shadow-md">
                            <img
                                src="{{ $product->image ? asset('images/products/' . $product->image) : asset('images/pizzart/logo.jpg') }}"
                                alt="{{ $product->name }}"
                                class="aspect-[4/3] w-full rounded-t-lg bg-white object-cover"
                            >
                            <div class="p-4">
                                <p class="text-xs font-black uppercase text-orange-600">{{ $product->category?->name ?? 'Menu Pizza' }}</p>
                                <h2 class="mt-1 text-lg font-black leading-snug text-[#2b0700]">{{ $product->name }}</h2>
                                <p class="mt-3 line-clamp-2 min-h-12 text-sm font-medium leading-6 text-[#6b4a37]">
                                    {{ $product->description ?: 'Pizza fresh dengan topping pilihan.' }}
                                </p>

                                <div class="mt-4 flex items-center justify-between gap-3">
                                    <p class="text-lg font-black text-[#2b0700]">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                    <div class="flex h-11 items-center rounded-md border border-black/10 bg-white">
                                        <button type="button" class="h-10 w-10 text-lg font-black text-[#2b0700] transition hover:text-orange-600" data-step="-1" data-target="qty-{{ $product->id }}">-</button>
                                        <input
                                            id="qty-{{ $product->id }}"
                                            type="number"
                                            name="items[{{ $product->id }}][qty]"
                                            value="0"
                                            min="0"
                                            class="order-qty h-10 w-14 bg-transparent text-center text-sm font-black text-[#2b0700] outline-none"
                                            data-price="{{ $product->price }}"
                                        >
                                        <button type="button" class="h-10 w-10 text-lg font-black text-[#2b0700] transition hover:text-orange-600" data-step="1" data-target="qty-{{ $product->id }}">+</button>
                                    </div>
                                </div>
                                <input type="hidden" name="items[{{ $product->id }}][price]" value="{{ $product->price }}">
                            </div>
                        </article>
                    @empty
                        <div class="rounded-lg border border-dashed border-orange-300 bg-orange-50 p-8 text-center sm:col-span-2 xl:col-span-3">
                            <p class="text-lg font-black text-[#2b0700]">Menu belum tersedia.</p>
                            <p class="mt-2 text-sm font-medium text-[#6b4a37]">Silakan cek kembali nanti.</p>
                        </div>
                    @endforelse
                </div>

                <aside class="h-max rounded-lg border border-black/10 bg-white p-5 shadow-sm lg:sticky lg:top-28">
                    <p class="text-sm font-black uppercase text-orange-600">Checkout</p>
                    <h2 class="mt-2 text-2xl font-black text-[#2b0700]">Informasi Pesanan</h2>

                    <div class="mt-5 space-y-4">
                        <div>
                            <label class="label" for="customer_name">Nama Pelanggan</label>
                            <input id="customer_name" type="text" name="customer_name" value="{{ old('customer_name') }}" class="field" placeholder="Nama kamu" required>
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
                        Kirim Pesanan
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

            input.value = Math.max(0, Number(input.value || 0) + Number(button.dataset.step));
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
