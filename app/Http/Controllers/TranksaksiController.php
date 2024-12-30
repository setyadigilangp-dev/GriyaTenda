<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Barang;
use App\Models\Rental;
use App\Models\Kategori;
use App\Models\RentalItems;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class TranksaksiController extends Controller
{
    

    function data_tranksaksi()
    {
        $rental = Rental::all();
        $user = User::get(['id','fullname']);
        return view('data_tranksaksi.tranksaksi', ['rental' => $rental, 'user' => $user]);
    }

    public function showTranksaksiDetail($id)
    {


        $rental = Rental::with(['metopem'])->findOrFail($id);

        // Periksa status pesanan dan keberadaan bukti pembayaran
        $notEmpty = empty($rental->bukti_pembayaran) && $rental->status_pesanan !== 'Dibatalkan';
        
        // Menggunakan join untuk menggabungkan rentalitems dengan barang
        $rentalItems = DB::table('rentals_items')
        ->join('products', 'rentals_items.products_id', '=', 'products.id')
        ->join('rentals', 'rentals_items.rentals_id', '=', 'rentals.id')
        ->join('metode_bayar', 'rentals.metode_bayar_id', '=', 'metode_bayar.id')
        ->where('rentals_items.rentals_id', '=', $id)
        ->select('rentals_items.*', 'nama_barang as nama_barang', 'harga_sewa as harga_sewa','gambar as gambar',
                 'rentals.*', 'metode_bayar as metode_bayar', 'no_rekening as no_rekening', 'atas_nama as atas_nama')
        ->get();
    
    
        return view('data_tranksaksi.detail_tranksaksi', compact('rental','rentalItems','notEmpty'));
        
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            // Validasi input status
            $request->validate([
                'status_pesanan' => 'string|in:Belum Diambil,Sudah Kembali,Belum Kembali,Dibatalkan',
                'status_pembayaran' => 'string|in:Dibayar,Belum Dibayar,Diproses',
            ]);

            // Mengambil data rental beserta rentalItems dan barang menggunakan query manual
            $rental = Rental::findOrFail($id);
            $rentalItems = RentalItems::with('barang')->where('rentals_id', $id)->get(); // Mengambil rentalItems beserta barang terkait

            // Log status lama
            Log::info("Status pesanan lama: {$rental->status_pesanan} untuk rental_id: {$id}");

            // Cek jika ada permintaan untuk mengupdate status pesanan
            if ($request->has('status_pesanan')) {
                $statusPesananBaru = $request->status_pesanan;
                $statusPesananLama = $rental->status_pesanan;

                // Status pesanan tidak dapat diperbarui jika sudah "Sudah Kembali" atau "Dibatalkan"
                if (in_array($statusPesananLama, ['Sudah Kembali', 'Dibatalkan'])) {
                    return redirect()->back()->with('error', 'Status pesanan tidak dapat diperbarui lagi.');
                }

                // Log perubahan status pesanan
                Log::info("Status pesanan diperbarui menjadi: {$statusPesananBaru} untuk rental_id: {$id}");

                // Jika status berubah menjadi "Proses", kurangi stok barang
                if ($statusPesananBaru === 'Belum Kembali' && $statusPesananLama === null) {
                    foreach ($rentalItems as $detail) {
                        $barang = $detail->barang;
                        $barang->stok -= $detail->jumlah;
                        $barang->save();

                        Log::info("Stok barang {$barang->nama_barang} berkurang menjadi: {$barang->stok}");
                    }
                }

                // Jika status berubah menjadi "Sudah Kembali" atau "Dibatalkan", kembalikan stok barang
                if (in_array($statusPesananBaru, ['Sudah Kembali', 'Dibatalkan'])) {
                    foreach ($rentalItems as $detail) {
                        $barang = $detail->barang;
                        $barang->stok += $detail->jumlah;  // Menambah stok sesuai jumlah barang
                        $barang->save();

                        Log::info("Stok barang {$barang->nama_barang} bertambah menjadi: {$barang->stok}");
                    }
                }

                // Update status pesanan
                $rental->status_pesanan = $statusPesananBaru;
            }

            // Update status pembayaran selalu diperbolehkan
            $statusPembayaranLama = $rental->status_pembayaran;
            $rental->status_pembayaran = $request->status_pembayaran;

            // Simpan perubahan
            $rental->save();

            Log::info("Status pembayaran diperbarui dari '{$statusPembayaranLama}' menjadi '{$rental->status_pembayaran}' untuk rental_id: {$id}");

            return redirect('data_tranksaksi')->with('success', 'Status pesanan dan pembayaran berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error("Terjadi kesalahan saat memperbarui status pesanan: " . $e->getMessage());
            return redirect('data_tranksaksi')->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }




    function editStatus($id)
    {
        $rental = Rental::find($id);

        // Ambil nilai ENUM dari kolom `status_pesanan`
        $statusPesananEnum = DB::select("SHOW COLUMNS FROM rentals LIKE 'status_pesanan'");
        preg_match("/^enum\('(.*)'\)$/", $statusPesananEnum[0]->Type, $matches1);
        $statusPesananOptions = explode("','", $matches1[1]);

        // Ambil nilai ENUM dari kolom `status_pembayaran`
        $statusPembayaranEnum = DB::select("SHOW COLUMNS FROM rentals LIKE 'status_pembayaran'");
        preg_match("/^enum\('(.*)'\)$/", $statusPembayaranEnum[0]->Type, $matches2);
        $statusPembayaranOptions = explode("','", $matches2[1]);

        // Kirim data ENUM ke view
        return view('data_tranksaksi.edit_status', compact('statusPesananOptions', 'statusPembayaranOptions', 'rental'));
    }
}