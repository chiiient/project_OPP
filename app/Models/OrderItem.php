<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'product_id', 'quantity', 'subtotal', 'notes'];

    // Relasi: Item detail ini merujuk ke sebuah Order induk
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relasi: Item detail ini mengambil data dari produk menu tertentu
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
