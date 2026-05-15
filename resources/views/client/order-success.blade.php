@extends('layouts.client')

@section('title', 'Pesanan Berhasil - PizzArt')

@section('content')
    <section class="bg-white px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-4xl">
            <div class="rounded-lg border border-black/10 bg-[#fffaf3] p-6 shadow-sm sm:p-8">
                <p class="text-sm font-black uppercase text-green-700">Checkout berhasil</p>
                <h1 class="mt-2 text-4xl font-black text-[#2b0700]">Pesananmu diterima, {{ $order->customer_name }}.</h1>
                <p class="mt-3 text-sm font-medium leading-6 text-[#5b4537]">
                    Pesanan #{{ $order->id }} untuk meja {{ $order->table_number }} sudah kami terima. Silakan tunggu, tim kami akan menyiapkan pesananmu.
                </p>
                <div class="mt-5 rounded-lg border border-orange-200 bg-orange-50 px-4 py-3 text-sm font-bold text-orange-800">
                    Status pembayaran: menunggu konfirmasi kasir.
                </div>

                <div class="mt-8 overflow-hidden rounded-lg border border-black/10 bg-white">
                    <table class="min-w-full divide-y divide-black/10">
                        <thead class="bg-[#fff3e2]">
                            <tr>
                                <th class="px-5 py-4 text-left text-xs font-black uppercase text-[#6b4a37]">Menu</th>
                                <th class="px-5 py-4 text-left text-xs font-black uppercase text-[#6b4a37]">Qty</th>
                                <th class="px-5 py-4 text-right text-xs font-black uppercase text-[#6b4a37]">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-black/10">
                            @foreach ($order->details as $detail)
                                <tr>
                                    <td class="px-5 py-4 text-sm font-black text-[#2b0700]">{{ $detail->product?->name ?? 'Menu' }}</td>
                                    <td class="px-5 py-4 text-sm font-bold text-[#4a3529]">{{ $detail->quantity }}</td>
                                    <td class="px-5 py-4 text-right text-sm font-black text-[#2b0700]">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-2xl font-black text-[#2b0700]">Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                    <a href="{{ route('home') }}" class="inline-flex h-11 items-center justify-center rounded-md bg-orange-500 px-5 text-sm font-black uppercase text-white transition hover:bg-orange-600">
                        Kembali Home
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
