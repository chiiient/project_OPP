<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'table_id', 'customer_name', 'total_price', 'status'];

    // Relasi: Pesanan ini dilayani oleh seorang User (Kasir/Admin)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Pesanan ini ditempatkan di meja tertentu
    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    // Relasi: Satu pesanan memiliki banyak item pizza yang dibeli
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
