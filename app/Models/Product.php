<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'price', 'image', 'is_available'];

    // Relasi: Produk ini termasuk ke dalam sebuah kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi: Produk ini bisa dipesan di banyak item detail pesanan
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
