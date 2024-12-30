<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Barang;
use App\Models\Rental;
use App\Models\Metopem;
use App\Models\RentalItems;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreRentalRequest;
use App\Http\Requests\UpdateRentalRequest;

class RentalController extends Controller
{


    /**
     * Show the form for creating a new resource.
     */
            private function generateRentId()
        {
            return rand(100, 999);
        }

        public function rental(Request $request)
        {
            $user_id = Auth::id();

            try {
                Log::info("Memulai proses rental untuk user_id: $user_id");

                // Ambil data keranjang
                $cart = Cart::with('barang')->where('user_id', $user_id)->get();
                Log::info("Keranjang berhasil diambil. Jumlah item: " . $cart->count());

                if ($cart->isEmpty()) {
                    Log::warning("Keranjang kosong untuk user_id: $user_id");
                    return redirect()->back()->with('error', 'Keranjang Anda kosong.');
                }

                // Validasi input tanggal dan metode pembayaran
                $request->validate([
                    'start_date' => 'required|date',
                    'end_date' => 'required|date',
                    'metode_bayar_id' => 'required|integer',
                ]);
                Log::info("Validasi berhasil untuk user_id: $user_id");

                // Ambil tanggal dari request
                $startDate = Carbon::parse($request->input('start_date'));
                $endDate = Carbon::parse($request->input('end_date'));
                Log::info("Tanggal sewa: $startDate, Tanggal kembali: $endDate");

                // Hitung jumlah hari (minimal 1 hari)
                $totalDays = $endDate->diffInDays($startDate) ?: 1;
                Log::info("Total hari sewa: $totalDays");

                // Hitung total harga
                $totalPrice = 0;
                $harga = 0;
                foreach ($cart as $item) {
                    $totalPrice += $item->barang->harga_sewa * $item->jumlah * $totalDays;
                    $harga += $item->barang->harga_sewa * $item->jumlah;
                    Log::info("Menghitung harga untuk item: {$item->barang->nama_barang}, Harga total: $totalPrice");
                }

                // Dapatkan kode rent_id unik
                $rent_id = $this->generateRentId();
                $kode_rent_id = "R-".$rent_id;

                $total_with_code = $totalPrice + $rent_id;
                Log::info("Rent ID yang dihasilkan: $rent_id");

                // Simpan transaksi ke tabel transactions
                Rental::create([
                    'id' => $kode_rent_id,
                    'user_id' => $user_id,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'metode_bayar_id' => $request->metode_bayar_id,
                    'total' => $total_with_code,
                ]);
                Log::info("Transaksi berhasil disimpan untuk rent_id: $rent_id");

                // Simpan setiap item keranjang ke tabel transaction_items
                foreach ($cart as $item) {
                    RentalItems::create([
                        'rentals_id' => $kode_rent_id,
                        'products_id' => $item->product_id,
                        'jumlah' => $item->jumlah,
                        'harga' => $item->barang->harga_sewa * $item->jumlah,
                    ]);
                    Log::info("Item berhasil disimpan untuk product_id: {$item->product_id}");

                    // Kurangi stok produk
                    $product = Barang::find($item->product_id);
                    if ($product) {
                        $product->stok -= $item->jumlah;
                        $product->save();
                        Log::info("Stok berhasil diperbarui untuk barang_id: {$item->barang_id}, Stok baru: {$product->stok}");
                    } else {
                        Log::error("Produk dengan ID {$item->product_id} tidak ditemukan");
                    }
                }

                // Hapus keranjang setelah checkout
                Cart::where('user_id', $user_id)->delete();
                Log::info("Keranjang berhasil dihapus untuk user_id: $user_id");

                return redirect()->back()->with('success', 'Checkout berhasil!');
            } catch (\Exception $e) {
                // Log error jika terjadi masalah
                Log::error("Error saat memproses rental untuk user_id: $user_id. Pesan: " . $e->getMessage());
                return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses rental. Silakan coba lagi.');
            }
        }


}
