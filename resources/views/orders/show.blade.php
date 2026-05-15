<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Detail Pesanan #{{ $order->id }}</h2>
<p><strong>Nama Pelanggan:</strong> {{ $order->customer_name }}</p>
<p><strong>Nomor Meja:</strong> {{ $order->table_number }}</p>
<p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>Menu</th>
            <th>Harga Satuan</th>
            <th>Jumlah (Qty)</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->details as $detail)
        <tr>
            <td>{{ $detail->product->name }}</td>
            <td>Rp {{ number_format($detail->product->price) }}</td>
            <td>{{ $detail->quantity }}</td> <td>Rp {{ number_format($detail->subtotal) }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3">Total Harga</th>
            <th>Rp {{ number_format($order->total_price) }}</th>
        </tr>
    </tfoot>
</table>
<br>
<hr>
<div style="display: flex; gap: 10px;">
    <a href="{{ route('orders.list') }}">
        <button style="padding: 10px;">Kembali ke Daftar</button>
    </a>

    @if($order->status == 'pending')
        <form action="{{ route('orders.pay', $order->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit" style="padding: 10px; background-color: #28a745; color: white; border: none; cursor: pointer;" onclick="return confirm('Apakah pelanggan sudah membayar dan pesanan selesai?')">
                Selesaikan & Bayar Pesanan
            </button>
        </form>
    @else
        <button style="padding: 10px; background-color: #6c757d; color: white; border: none;" disabled>
            Pesanan Sudah Selesai
        </button>
    @endif
</div>

<br>
<a href="{{ route('orders.list') }}"> Kembali ke Daftar </a>
</body>
</html>