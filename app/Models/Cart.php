<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    public $table = 'cart';
    public $fillable = [
        'user_id',
        'product_id',
        'nama_barang',
        'harga',
        'jumlah',
        'gambar',

    ];

    public function user()
	{
		return $this->belongsTo(user::class,'user_id');
	}
    
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'product_id'); // 'product_id' adalah foreign key yang mengarah ke 'id' di tabel Barang
    }

    
}
