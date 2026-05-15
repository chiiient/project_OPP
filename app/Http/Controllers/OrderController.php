<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Ambil produk agar bisa dipilih di halaman kasir
        $products = \App\Models\Product::all();
        return view('orders.index', compact('products'));
    }
    public function store(Request $request)
    {
        // 1. Hitung total harga dari semua item yang diisi qty-nya
        $totalPrice = 0;
        foreach ($request->items as $item) {
            if ($item['qty'] > 0) {
                $totalPrice += $item['qty'] * $item['price'];
            }
        }

        // 2. Simpan ke tabel orders
        $order = \App\Models\Order::create([
            'customer_name' => $request->customer_name,
            'table_number' => $request->table_number,
            'total_price' => $totalPrice,
            'status' => 'pending'
        ]);

        // 3. Simpan rincian per produk ke tabel order_details
        foreach ($request->items as $productId => $item) {
            // Di dalam foreach fungsi store()
            if ($item['qty'] > 0) {
                \App\Models\OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $item['qty'], // GANTI INI JADI quantity
                    'subtotal' => $item['qty'] * $item['price'],
                ]);
            }
        }
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil diproses!');
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

        return redirect()->route('orders.list')->with('success', 'Pesanan berhasil diselesaikan/dibayar!');
    }
}
