<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    public $table = 'products';
    public $fillable = [
        'nama_barang',
        'categories_id',
        'stok',
        'harga_sewa',
        'denda_rusak',
        'denda_hilang',
        'gambar',
    ];

    public function kategori()
	{
		return $this->belongsTo(Kategori::class,'categories_id');
	}
    
    // Relasi dengan Cart
    public function carts()
    {
        return $this->hasMany(Cart::class, 'product_id'); // relasi satu ke banyak, barang bisa memiliki banyak keranjang
    }

    public function rentalItems()
    {
        return $this->hasMany(RentalItems::class, 'products_id');
    }
}
