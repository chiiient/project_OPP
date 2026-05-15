<form action="{{ route('orders.store') }}" method="POST">
    @csrf
    <h3>Informasi Pelanggan</h3>
    <input type="text" name="customer_name" placeholder="Nama Pelanggan" required>
    <input type="number" name="table_number" placeholder="Nomor Meja" required>

    <h3>Pilih Menu</h3>
    <table>
        <thead>
            <tr>
                <th>Menu</th>
                <th>Harga</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    <input type="number" name="items[{{ $product->id }}][qty]" value="0" min="0">
                    <input type="hidden" name="items[{{ $product->id }}][price]" value="{{ $product->price }}">
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <button type="submit">Simpan Pesanan</button>
</form>