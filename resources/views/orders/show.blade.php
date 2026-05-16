@extends('layouts.app')

@section('title', 'Detail Pesanan - PizzArt')

@section('content')
    @php
        $statusClass = match ($order->status) {
            'paid', 'completed' => 'bg-green-100 text-green-700',
            'cancelled', 'canceled' => 'bg-red-100 text-red-700',
            'processing' => 'bg-sky-100 text-sky-700',
            default => 'bg-orange-100 text-orange-700',
        };
    @endphp

    <section class="px-4 py-10 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-6xl">
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm font-black uppercase text-orange-600">Detail pesanan</p>
                    <h1 class="mt-2 text-4xl font-black text-[#2b0700]">Order #{{ $order->id }}</h1>
                </div>
                <a href="{{ route('orders.list') }}" class="inline-flex h-11 items-center justify-center rounded-md border border-black/10 bg-white px-5 text-sm font-black uppercase text-[#2b0700] transition hover:border-orange-300 hover:text-orange-600">
                    Kembali
                </a>
            </div>

            <div class="grid gap-6 lg:grid-cols-[1fr_320px]">
                <div class="overflow-hidden rounded-lg border border-black/10 bg-white shadow-sm">
                    <div class="border-b border-black/10 bg-[#fff3e2] px-5 py-4">
                        <h2 class="text-xl font-black text-[#2b0700]">Item Pesanan</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-black/10">
                            <thead>
                                <tr>
                                    <th class="px-5 py-4 text-left text-xs font-black uppercase text-[#6b4a37]">Menu</th>
                                    <th class="px-5 py-4 text-left text-xs font-black uppercase text-[#6b4a37]">Harga</th>
                                    <th class="px-5 py-4 text-left text-xs font-black uppercase text-[#6b4a37]">Qty</th>
                                    <th class="px-5 py-4 text-right text-xs font-black uppercase text-[#6b4a37]">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-black/10">
                                @foreach($order->details as $detail)
                                    <tr>
                                        <td class="px-5 py-4">
                                            <div class="flex min-w-56 items-center gap-3">
                                                <img
                                                    src="{{ $detail->product?->image ? asset('images/products/' . $detail->product->image) : asset('images/pizzart/logo.jpg') }}"
                                                    alt="{{ $detail->product?->name ?? 'Menu' }}"
                                                    class="h-12 w-12 rounded-lg border border-black/10 object-cover"
                                                >
                                                <span class="font-black text-[#2b0700]">{{ $detail->product?->name ?? 'Menu terhapus' }}</span>
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-5 py-4 text-sm font-bold text-[#4a3529]">Rp {{ number_format($detail->product?->price ?? 0, 0, ',', '.') }}</td>
                                        <td class="whitespace-nowrap px-5 py-4 text-sm font-black text-[#2b0700]">{{ $detail->quantity }}</td>
                                        <td class="whitespace-nowrap px-5 py-4 text-right text-sm font-black text-[#2b0700]">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <aside class="h-max rounded-lg border border-black/10 bg-white p-5 shadow-sm">
                    <p class="text-sm font-black uppercase text-orange-600">Receipt</p>
                    <div class="mt-5 space-y-4 text-sm">
                        <div class="flex items-center justify-between gap-4">
                            <span class="font-black uppercase text-[#6b4a37]">Pelanggan</span>
                            <span class="font-bold text-[#2b0700]">{{ $order->customer_name }}</span>
                        </div>
                        <div class="flex items-center justify-between gap-4">
                            <span class="font-black uppercase text-[#6b4a37]">Meja</span>
                            <span class="font-bold text-[#2b0700]">{{ $order->table_number }}</span>
                        </div>
                        <div class="flex items-center justify-between gap-4">
                            <span class="font-black uppercase text-[#6b4a37]">Status</span>
                            <span class="inline-flex rounded-md px-3 py-1 text-xs font-black uppercase {{ $statusClass }}">{{ ucfirst($order->status) }}</span>
                        </div>
                    </div>

                    <div class="my-5 border-t border-black/10"></div>

                    <div class="flex items-center justify-between gap-4">
                        <span class="text-sm font-black uppercase text-[#6b4a37]">Total Harga</span>
                        <span class="text-2xl font-black text-[#2b0700]">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>

                    @if($order->status == 'pending')
                        <form action="{{ route('orders.pay', $order->id) }}" method="POST" class="mt-5">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="inline-flex h-12 w-full items-center justify-center rounded-md bg-[#2d6a32] px-6 text-sm font-black uppercase text-white transition hover:bg-[#245427]" onclick="return confirm('Apakah pelanggan sudah membayar dan pesanan selesai?')">
                                Selesaikan & Bayar
                            </button>
                        </form>
                    @else
                        <button class="mt-5 inline-flex h-12 w-full cursor-not-allowed items-center justify-center rounded-md bg-[#6b4a37] px-6 text-sm font-black uppercase text-white opacity-70" disabled>
                            Pesanan Selesai
                        </button>
                    @endif
                </aside>
            </div>
        </div>
    </section>
@endsection
