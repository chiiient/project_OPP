@extends('layouts.admin')

@section('title', 'Daftar Pesanan - PizzArt')
@section('adminHeading', 'Daftar Pesanan')

@section('content')
    <section class="px-4 py-10 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm font-black uppercase text-orange-600">Order tracking</p>
                    <h1 class="mt-2 text-4xl font-black text-[#2b0700]">Daftar Pesanan</h1>
                    <p class="mt-3 max-w-2xl text-sm font-medium leading-6 text-[#5b4537]">
                        Pantau semua pesanan yang masuk dari pelanggan, cek detail item, dan perbarui status pembayarannya.
                    </p>
                </div>
                <a href="{{ route('admin.orders.index') }}" class="inline-flex h-12 items-center justify-center rounded-md bg-orange-500 px-5 text-sm font-black uppercase text-white transition hover:bg-orange-600">
                    Tambah Pesanan
                </a>
            </div>

            <div class="mt-8 overflow-hidden rounded-lg border border-black/10 bg-white shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-black/10">
                        <thead class="bg-[#fff3e2]">
                            <tr>
                                <th class="px-5 py-4 text-left text-xs font-black uppercase text-[#6b4a37]">Order</th>
                                <th class="px-5 py-4 text-left text-xs font-black uppercase text-[#6b4a37]">Pelanggan</th>
                                <th class="px-5 py-4 text-left text-xs font-black uppercase text-[#6b4a37]">Meja</th>
                                <th class="px-5 py-4 text-left text-xs font-black uppercase text-[#6b4a37]">Total</th>
                                <th class="px-5 py-4 text-left text-xs font-black uppercase text-[#6b4a37]">Status</th>
                                <th class="px-5 py-4 text-left text-xs font-black uppercase text-[#6b4a37]">Tanggal</th>
                                <th class="px-5 py-4 text-right text-xs font-black uppercase text-[#6b4a37]">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-black/10 bg-white">
                            @forelse($orders as $order)
                                @php
                                    $statusClass = match ($order->status) {
                                        'paid', 'completed' => 'bg-green-100 text-green-700',
                                        'cancelled', 'canceled' => 'bg-red-100 text-red-700',
                                        'processing' => 'bg-sky-100 text-sky-700',
                                        default => 'bg-orange-100 text-orange-700',
                                    };
                                @endphp
                                <tr class="transition hover:bg-orange-50/60">
                                    <td class="whitespace-nowrap px-5 py-4 text-sm font-black text-[#2b0700]">#{{ $order->id }}</td>
                                    <td class="whitespace-nowrap px-5 py-4 text-sm font-bold text-[#4a3529]">{{ $order->customer_name }}</td>
                                    <td class="whitespace-nowrap px-5 py-4 text-sm font-bold text-[#4a3529]">{{ $order->table_number }}</td>
                                    <td class="whitespace-nowrap px-5 py-4 text-sm font-black text-[#2b0700]">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                    <td class="whitespace-nowrap px-5 py-4">
                                        <span class="inline-flex rounded-md px-3 py-1 text-xs font-black uppercase {{ $statusClass }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-5 py-4 text-sm font-medium text-[#6b4a37]">{{ $order->created_at->format('d M Y, H:i') }}</td>
                                    <td class="px-5 py-4 text-right">
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="inline-flex h-10 items-center rounded-md border border-black/10 bg-white px-4 text-sm font-black text-[#2b0700] transition hover:border-orange-300 hover:text-orange-600">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-5 py-14 text-center">
                                        <p class="text-lg font-black text-[#2b0700]">Belum ada pesanan.</p>
                                        <p class="mt-2 text-sm font-medium text-[#6b4a37]">Pesanan pelanggan yang sudah checkout akan tampil di sini.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
