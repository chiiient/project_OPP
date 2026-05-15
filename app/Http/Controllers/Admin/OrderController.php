<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Table;

class OrderController extends Controller
{
    /**
     * 1. HALAMAN DASHBOARD ADMIN
     * Menampilkan status meja dan ringkasan pesanan hari ini
     */
    public function dashboard()
    {
        // Ambil semua meja beserta pesanan yang masih aktif di meja tersebut
        $tables = Table::all();
        
        // Ambil pesanan yang butuh diproses (pending/processing)
        $active_orders = Order::with('table')
            ->whereIn('status', ['pending', 'processing'])
            ->latest()
            ->get();
            
        // Hitung total pendapatan dari pesanan yang sudah selesai (Completed)
        $total_revenue = Order::where('status', 'completed')->sum('total_price');

        return view('admin.dashboard', compact('tables', 'active_orders', 'total_revenue'));
    }

    /**
     * 2. HALAMAN DAFTAR SEMUA PESANAN (Riwayat / History)
     */
    public function index()
    {
        // Ambil semua pesanan dari yang paling baru, gabungkan dengan relasi meja & user kasirnya
        $orders = Order::with(['table', 'user'])->latest()->paginate(10);
        
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * 3. HALAMAN DETAIL PESANAN (Melihat item Pizza apa saja yang dipesan)
     */
    public function show($id)
    {
        // Cari pesanan berdasarkan ID. Ambil juga data relasi item dan nama produknya
        $order = Order::with(['items.product', 'table', 'user'])->findOrFail($id);
        
        return view('admin.orders.show', compact('order'));
    }

    /**
     * 4. FUNGSI UPDATE STATUS PESANAN (Misal: dari Pending -> Completed)
     */
    public function updateStatus(Request $request, $id)
    {
        // Validasi input status yang dikirim
        $request->validate([
            'status' => 'required|in:pending,processing,completed,canceled'
        ]);

        // Cari pesanan
        $order = Order::findOrFail($id);
        
        // Update statusnya
        $order->update([
            'status' => $request->status
        ]);

        // Logika tambahan: Jika pesanan sudah Selesai (Completed) atau Dibatalkan (Canceled),
        // Maka status mejanya otomatis kita ubah jadi "Available" (Kosong) lagi.
        if (in_array($request->status, ['completed', 'canceled']) && $order->table_id) {
            $table = Table::find($order->table_id);
            if ($table) {
                $table->update(['status' => 'available']);
            }
        }

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}