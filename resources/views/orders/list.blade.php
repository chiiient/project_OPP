<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h2>Daftar Pesanan Restoran</h2>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pelanggan</th>
                <th>Meja</th>
                <th>Total Bayar</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->table_number }}</td>
                    <td>Rp {{ number_format($order->total_price) }}</td>
                    <td>
                        <span style="padding: 5px; background: {{ $order->status == 'pending' ? 'yellow' : 'green' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}">
                            <button>Lihat Detail</button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <a href="{{ route('orders.index') }}">+ Tambah Pesanan Baru</a>
</body>

</html>