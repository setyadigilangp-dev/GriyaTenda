<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    public $table = 'categories';
    public $fillable = [
        'nama_kategori',
    ];

    public function barang() {
        return $this->hasMany(Barang::class);
    }
}
