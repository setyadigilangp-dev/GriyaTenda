<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rental;
use App\Models\Metopem;
use App\Models\Question;
use App\Models\RentalItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Barang as ModelsBarang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Kategori as ModelsKategori;
use Illuminate\Database\Eloquent\Relations\Relation;

class PageFrontendController extends Controller
{
    
    public function home_client()
    {
        return view('frontend.dashboard');
    }

    public function kontak()
    {
        return view('frontend.kontak');
    }
    public function tentangkami()
    {
        return view('frontend.tentangkami');
    }

    public function kontak_depan()
    {
        return view('halaman_depan.kontak');
    }
    public function tentangkami_depan()
    {
        return view('halaman_depan.tentangkami');
    }
    

    public function sewa(Request $request)
    {

        $kategori_id = $request->input('kategori_id');
        $search = $request->input('search');
    
        $query = ModelsBarang::query();
    
        if ($kategori_id) {
            $query->where('categories_id', $kategori_id);
        }
    
        if ($search) {
            $query->where('nama_barang', 'like', '%' . $search . '%');
        }
    
        $barangs = $query->get();
    
        $kategoris = ModelsKategori::all();
    
        return view('frontend.sewa', compact('barangs', 'kategoris', 'kategori_id', 'search'));

    }

    public function data_pesanan(Request $request)
    {
        
        $metopem = Metopem::get(['id','metode_bayar']);

        $user_id = Auth::id(); // Ambil user yang sedang login
        $rental = Rental::where('user_id', $user_id)->get(); // Ambil semua item rental berdasarkan user_id
        $rentalitem = RentalItems::all();
        $barang = ModelsBarang::all();

        
        return view('frontend.data_pesanan',['metopem' => $metopem, 'rental' => $rental]);
    }

    public function tranksaksi($id)
    {
        $data = ModelsBarang::find($id);
        if (!$data) {
            // Kembalikan ke halaman error atau halaman lain dengan pesan error
            return redirect()->route('sewa')->with('error', 'Barang tidak ditemukan.');
        }

        $kategori = ModelsKategori::get(['id', 'nama_kategori']);

        return view('frontend.tranksaksi', ['kategori' => $kategori, 'data' => $data]);
        
    }


    public function showRentalDetail($id)
    {


        $rental = Rental::with(['metopem'])->findOrFail($id);

         // Periksa status pesanan dan keberadaan bukti pembayaran
        $canUpload = empty($rental->bukti_pembayaran) && $rental->status_pesanan !== 'Dibatalkan';
        
        // Menggunakan join untuk menggabungkan rentalitems dengan barang
        $rentalItems = DB::table('rentals_items')
        ->join('products', 'rentals_items.products_id', '=', 'products.id')
        ->join('rentals', 'rentals_items.rentals_id', '=', 'rentals.id')
        ->join('metode_bayar', 'rentals.metode_bayar_id', '=', 'metode_bayar.id')
        ->where('rentals_items.rentals_id', '=', $id)
        ->select('rentals_items.*', 'nama_barang as nama_barang', 'harga_sewa as harga_sewa','gambar as gambar',
                 'rentals.*', 'metode_bayar as metode_bayar', 'no_rekening as no_rekening', 'atas_nama as atas_nama')
        ->get();
    
    
        return view('frontend.detail_pesanan', compact('rental','rentalItems','canUpload'));
        
    }

    public function uploadBuktiPembayaran(Request $request, $id)
    {
    
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


         $rental = Rental::findOrFail($id);

         if ($request->hasFile('bukti_pembayaran')) {
            // Upload file ke direktori storage/app/public/bukti_pembayaran
            $path = $request->file('bukti_pembayaran');
            $path->storeAs('public/bukti_pembayaran', $path->hashName());
     
             // Simpan path file ke database
             $rental->bukti_pembayaran = $path->hashName();
             $rental->save();
         }
        

        Session::flash('success', 'Berhasil Mengubah Data');
        
         //redirect to index
         return redirect()->back()->with(['success' => 'bukti pembayaran berhasil di upload !!!']);

        
    }

    function editProfile($id)
    {
        $user = User::find($id);

        return view('frontend.profile', ['user' => $user]);
    }
    
    public function updateProfile(Request $request, $id)
    {
    
        $this->validate($request, [
            'fullname' => 'required|min:5',
            'jenis_kelamin' => 'required',
            'nomor_wa' => 'required|min:10|max:14',
            'alamat' => 'required|max:255',
            'gambar' => 'required|image|file',
        ], [
            
            'fullname.required' => 'Full Name wajib diisi',
            'fullname.min' => 'Full Name minimal 5 karakter',
            'jenis_kelamin.required' => 'jenis kelamin wajib diisi',
            'nomor_wa.required' => 'nomor wa wajib diisi',
            'nomor_wa.min' => 'nomor wa minimal 10 angka',
            'nomor_wa.max' => 'nomor wa maximal 14 angka',
            'alamat.required' => 'alamat wajib diisi',
            'alamat.max' => 'alamat maximal 255 karakter',
            'gambar.required' => 'Gambar wajib di upload',
            'gambar.image' => 'Gambar yang di upload harus image',
            'gambar.file' => 'Gambar harus berupa file',
        ]);

         //get post by ID
         $user = User::find($id);

         //check if image is uploaded
         if ($request->hasFile('gambar')) {
 
              //upload new image
              $gambar = $request->file('gambar');
              $gambar->storeAs('public/account', $gambar->hashName());
    
             //delete old image
             if($user->gambar_file){
                Storage::disk('public')->delete('account/'. $user->gambar);
             }
             //Storage::delete('public/barang'.$data->gambar);
 
             //update post with new image
             $user->update([
                'fullname'      => $request->fullname,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nomor_wa'      => $request->nomor_wa,
                'alamat'        => $request->alamat,
                'gambar'        => $gambar->hashName()

             ]);
            }
        

        Session::flash('success', 'Berhasil Mengubah Data');
        
         //redirect to index
         return redirect()->back()->with(['success' => 'Data Berhasil Diubah!']);

        
    }


}
