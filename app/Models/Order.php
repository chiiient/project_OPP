<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{   
    protected $fillable = [
        'customer_name', 'table_number', 'total_price', 'status', 'user_id'
    ];

    // Relasi: 1 Pesanan diproses oleh 1 User (Kasir)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: 1 Pesanan memiliki banyak Detail Pesanan
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function details()
{
    return $this->hasMany(OrderDetail::class);
}
}
