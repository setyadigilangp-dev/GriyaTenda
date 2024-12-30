<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metopem extends Model
{
    use HasFactory;
    public $table = 'metode_bayar';
    public $fillable = [
        'metode_bayar',
        'no_rekening',
        'atas_nama',
    ];

    public function rentals()
    {
        return $this->hasMany(Rental::class, 'metode_bayar_id', 'id');
    }
}
