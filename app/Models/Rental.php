<?php

namespace App\Models;


use Carbon\Carbon;
use App\Models\RentalItems;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rental extends Model
{
    use HasFactory;
    public $table = 'rentals';
    protected $primaryKey = 'id'; // Nama kolom primary key
    public $incrementing = false; // Non-aktifkan auto-increment
    protected $keyType = 'string'; // Definisikan tipe primary key sebagai string
    public $fillable = [
        'id',
        'user_id',
        'start_date',
        'end_date',
        'total',
        'metode_bayar_id',
        'status_pesanan',
        'status_pembayaran',


    ];
     // Cast tgl_sewa dan tgl_kembali sebagai date untuk memudahkan manipulasi tanggal
     protected $dates = [
        'start_date',
        'end_date',
    ];

    /**
     * Relasi ke User
     * Setiap rent memiliki satu user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Akses tgl_kembali dalam format tertentu (optional)
     */
    public function getFormattedTglKembaliAttribute()
    {
        return Carbon::parse($this->end_date)->format('d F Y');
    }

    /**
     * Akses tgl_sewa dalam format tertentu (optional)
     */
    public function getFormattedTglSewaAttribute()
    {
        return Carbon::parse($this->start_date)->format('d F Y');
    }

    public function rentalItems()
    {
        return $this->hasMany(RentalItems::class, 'rentals_id', 'id');
    }


    public function metopem()
    {
        return $this->belongsTo(Metopem::class, 'metode_bayar_id', 'id');
    }

}
