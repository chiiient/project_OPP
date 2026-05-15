<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'subtotal'
    ];

    // Relasi: Detail ini milik 1 Pesanan
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relasi: Detail ini mengarah ke 1 Produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
}
