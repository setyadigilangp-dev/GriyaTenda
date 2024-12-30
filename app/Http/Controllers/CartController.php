<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Barang;
use App\Models\Metopem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function calculateTotal(Request $request)
    {
        $user_id = Auth::id();
        $cartItems = Cart::with('barang') // Menggunakan relasi barang
                        ->where('user_id', $user_id)
                        ->get();
    
        // Log data keranjang untuk debugging
        Log::info('Cart items:', $cartItems->toArray());
    
        // Ambil tanggal dari request
        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = Carbon::parse($request->input('end_date'));
    
        // Hitung jumlah hari (minimal 1 hari)
        $totalDays = $endDate->diffInDays($startDate) ?: 1;
    
        // Hitung total harga
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            // Akses harga dari relasi barang
            $totalPrice += $item->barang->harga_sewa * $item->jumlah * $totalDays;
        }
    
        Log::info('Total price:', [$totalPrice]);
    
        return response()->json([
            'totalPrice' => $totalPrice
        ]);
    }
    

    public function showcart(Request $request)
    {
        $metopem = Metopem::all();
        $userId = Auth::id();
        $cart = Cart::with('barang')->where('user_id', $userId)->get();

        return view('frontend.cart', ['cart' => $cart, 'metopem' => $metopem]);
    }


    public function cart(Request $request)
    {
        // Validasi request
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Ambil user_id dan data produk
        $user_id = Auth::id();
        $barang = Barang::findOrFail($request->product_id);

        // Cek stok produk apakah mencukupi
        if ($barang->stok < $request->jumlah) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi. Stok yang tersedia: ' . $barang->stok);
        }

        // Ambil data keranjang jika sudah ada produk
        $keranjangItem = Cart::where('user_id', $user_id)
                            ->where('product_id', $barang->id)
                            ->first();

        if ($keranjangItem) {
            // Jika produk sudah ada di keranjang, tambahkan jumlah
            if ($barang->stok >= ($keranjangItem->jumlah + $request->jumlah)) {
                $keranjangItem->jumlah += $request->jumlah;
                $keranjangItem->save();

               
            } else {
                return redirect()->back()->with('error', 'Stok tidak mencukupi untuk menambahkan lebih banyak produk ke keranjang.');
            }
        } else {
            // Jika belum ada, tambahkan produk baru ke keranjang
            Cart::create([
                'user_id' => $user_id,
                'product_id' => $barang->id,
                'jumlah' => $request->jumlah,
            ]);

           
        }

        return redirect()->back()->with('message', 'Produk berhasil ditambahkan ke keranjang');
    }

    public function addSpecificProductToCart(Request $request, $id)
    {
        // Ambil data user
        $user_id = Auth::id();

        // Cari produk berdasarkan ID
        $product = Barang::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        // Validasi stok
        if ($product->stok <= 0) {
            return redirect()->back()->with('error', 'Stok produk habis.');
        }

        // Cek jika produk sudah ada di keranjang
        $cartItem = Cart::where('user_id', $user_id)
                        ->where('product_id', $product->id)
                        ->first();

        if ($cartItem) {
            // Jika sudah ada, tambahkan jumlah
            $cartItem->jumlah += 1;
            $cartItem->save();
        } else {
            // Jika belum ada, tambahkan entri baru ke keranjang
            Cart::create([
                'user_id' => $user_id,
                'product_id' => $product->id,
                'jumlah' => 1,
            ]);
        }


        return redirect()->route('home_client')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }



    public function tambah_jml($id)
    {
        $cartItem = Cart::findOrFail($id);
        $product = Barang::findOrFail($cartItem->product_id);

        if ($product->stok > 0) {
            $cartItem->jumlah += 1; // Tambah jumlah di keranjang
            $cartItem->save();

            return redirect()->back()->with('success', 'Jumlah produk berhasil ditambahkan.');
        }

        return redirect()->back()->with('error', 'Stok tidak mencukupi.');
    }

    public function kurang_jml($id)
    {
        $cartItem = Cart::findOrFail($id);
        $product = Barang::findOrFail($cartItem->product_id);

        if ($cartItem->jumlah > 1) {
            $cartItem->jumlah -= 1; // Kurangi jumlah di keranjang
            $cartItem->save();

        

            return redirect()->back()->with('success', 'Jumlah produk berhasil dikurangi.');
        }else {
            // Jika jumlah 1 atau lebih kecil, hapus item dari keranjang
            
            $cartItem->delete();
        }

        return redirect()->back()->with('error', 'Jumlah produk di keranjang kosong.');
    }

        function hapuscart(Request $request)
    {
        
        cart::where('id', $request->id)->delete();

        Session::flash('success', 'Berhasil Hapus Data');

        return redirect()->back();
    }


}
