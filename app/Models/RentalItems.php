<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalItems extends Model
{
    use HasFactory;
    public $table = 'rentals_items';
    protected $primaryKey = 'rentals_id';
    public $fillable = [
        'rentals_id',
        'products_id',
        'jumlah',
        'harga',
    ];
    public function rental()
    {
        return $this->belongsTo(Rental::class, 'rentals_id', 'id');
    }
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'products_id', 'id');
    }

}