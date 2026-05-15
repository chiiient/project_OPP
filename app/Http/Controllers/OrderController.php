<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function clientIndex()
    {
        $products = \App\Models\Product::with('category')
            ->where('is_available', true)
            ->get();

        return view('client.order', compact('products'));
    }

    public function index()
    {
        // Ambil produk agar bisa dipilih di halaman kasir
        $products = \App\Models\Product::all();
        return view('orders.index', compact('products'));
    }
    public function store(Request $request)
    {
        $order = $this->createOrderFromRequest($request);
        if (! $order instanceof \App\Models\Order) {
            return $order;
        }

        return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil diproses!');
    }

    public function clientStore(Request $request)
    {
        $order = $this->createOrderFromRequest($request);
        if (! $order instanceof \App\Models\Order) {
            return $order;
        }

        return redirect()->route('client.orders.success', $order->id)->with('success', 'Pesanan berhasil diproses!');
    }

    private function createOrderFromRequest(Request $request)
    {
        $items = $request->input('items', []);

        // 1. Hitung total harga dari semua item yang diisi qty-nya
        $totalPrice = 0;
        foreach ($items as $item) {
            $qty = (int) ($item['qty'] ?? 0);
            $price = (int) ($item['price'] ?? 0);

            if ($qty > 0) {
                $totalPrice += $qty * $price;
            }
        }

        if ($totalPrice <= 0) {
            return back()->withErrors(['items' => 'Pilih minimal satu menu untuk membuat pesanan.'])->withInput();
        }

        // 2. Simpan ke tabel orders
        $order = \App\Models\Order::create([
            'customer_name' => $request->customer_name,
            'table_number' => $request->table_number,
            'total_price' => $totalPrice,
            'status' => 'pending'
        ]);

        // 3. Simpan rincian per produk ke tabel order_details
        foreach ($items as $productId => $item) {
            $qty = (int) ($item['qty'] ?? 0);
            $price = (int) ($item['price'] ?? 0);

            if ($qty > 0) {
                \App\Models\OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $qty,
                    'subtotal' => $qty * $price,
                ]);
            }
        }

        return $order;
    }

    public function clientSuccess($id)
    {
        $order = \App\Models\Order::with('details.product')->findOrFail($id);

        return view('client.order-success', compact('order'));
    }

    public function show_all()
    {
        // Ambil semua order, urutkan dari yang terbaru
        $orders = \App\Models\Order::orderBy('created_at', 'desc')->get();
        return view('orders.list', compact('orders'));
    }
    public function show($id)
    {
        // Ambil data order berdasarkan ID, sertakan relasi detail dan produknya
        $order = \App\Models\Order::with('details.product')->findOrFail($id);

        return view('orders.show', compact('order'));
    }
    public function markAsPaid($id)
    {
        $order = \App\Models\Order::findOrFail($id);
        $order->status = 'paid';
        $order->save();

        return redirect()->route('admin.orders.list')->with('success', 'Pesanan berhasil diselesaikan/dibayar!');
    }
}
