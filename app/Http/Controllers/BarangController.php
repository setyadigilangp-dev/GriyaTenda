<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Barang as ModelsBarang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Kategori as ModelsKategori;

class BarangController extends Controller
{
    function barang()
    {
        $data = ModelsBarang::all();
        $kategori = ModelsKategori::get(['id','nama_kategori']);
        
        return view('data_barang.barangs',['kategori' => $kategori, 'data' => $data]);

    }
    
    function tambahbarang()
    {
        $kategori = ModelsKategori::all();
        return view('data_barang.tambah_barang', ['kategori' => $kategori]);
    }

    function edit($id)
    {
        $data = ModelsBarang::find($id);
        $kategori = ModelsKategori::get(['id','nama_kategori']);

        return view('data_barang.edit_barang', ['kategori' => $kategori, 'data' => $data]);
    }

    function create(Request $request)
    {

        $request->validate([
            'nama_barang'   => 'required|max:255',
            'categories_id' => 'required',
            'stok'          => 'required',
            'harga_sewa'    => 'required|min:4',
            'denda_rusak'   => 'required|min:4',
            'denda_hilang'  => 'required|min:4',
            'gambar'        => 'required|image|file',
        ], [
            'nama_barang.required'      => 'Nama Wajib Di isi',
            'nama_barang.max'           => 'Nama wajib maximal 255 huruf',
            'categories_id.required'    => 'kategori wajib di pilih',
            'stok.required'             => 'stok wajib di isi',
            'harga_sewa.required'       => 'harga sewa wajib di isi',
            'harga_sewa.min'            => 'harga sewa wajib minimal 4 angka',
            'denda_rusak.required'      => 'harga sewa wajib di isi',
            'denda_rusak.min'           => 'harga sewa wajib minimal 4 angka',
            'denda_hilang.required'     => 'harga sewa wajib di isi',
            'denda_hilang.min'          => 'harga sewa wajib minimal 4 angka',
            'gambar.required'           => 'Gambar wajib di upload',
            'gambar.image'              => 'Gambar yang di upload harus image',
            'gambar.file'               => 'Gambar harus berupa file',
        ]);

        $gambar = $request->file('gambar');
        $gambar->storeAs('public/barang', $gambar->hashName());
        

        ModelsBarang::create([
            'nama_barang'       => $request->nama_barang,
            'categories_id'     => $request->categories_id,
            'stok'              => $request->stok,
            'harga_sewa'        => $request->harga_sewa,
            'denda_rusak'       => $request->denda_rusak,
            'denda_hilang'      => $request->denda_hilang,
            'gambar'            => $gambar->hashName()
        ]);

        return redirect()->route('barang')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
    
        $this->validate($request, [
            'nama_barang'   => 'required|max:255',
            'categories_id' => 'required',
            'stok'          => 'required',
            'harga_sewa'    => 'required|min:4',
            'denda_rusak'   => 'required|min:4',
            'denda_hilang'  => 'required|min:4',
            'gambar'        => 'image|file',
        ], [
            'nama_barang.required'      => 'Nama Wajib Di isi',
            'nama_barang.max'           => 'Nama wajib maximal 255 huruf',
            'categories_id.required'    => 'kategori wajib di pilih',
            'stok.required'             => 'stok wajib di isi',
            'harga_sewa.required'       => 'harga sewa wajib di isi',
            'harga_sewa.min'            => 'harga sewa wajib minimal 4 angka',
            'denda_rusak.required'      => 'harga sewa wajib di isi',
            'denda_rusak.min'           => 'harga sewa wajib minimal 4 angka',
            'denda_hilang.required'     => 'harga sewa wajib di isi',
            'denda_hilang.min'          => 'harga sewa wajib minimal 4 angka',
            'gambar.image'              => 'Gambar yang di upload harus image',
            'gambar.file'               => 'Gambar harus berupa file',
        ]);


         //get post by ID
         $data = ModelsBarang::find($id);

         //check if image is uploaded
         if ($request->hasFile('gambar')) {
 
             //upload new image
             $gambar = $request->file('gambar');
             $gambar->storeAs('public/barang', $gambar->hashName());
 
             //delete old image
             if($data->gambar){
                Storage::disk('public')->delete('barang/'. $data->gambar);
             }
             //Storage::delete('public/barang'.$data->gambar);
 
             //update post with new image
             $data->update([
                'nama_barang'   => $request->nama_barang,
                'categories_id' => $request->categories_id,
                'stok'          => $request->stok,
                'harga_sewa'    => $request->harga_sewa,
                'denda_rusak'   => $request->denda_rusak,
                'denda_hilang'  => $request->denda_hilang,
                'gambar'        => $gambar->hashName()
             ]);
            }
        

        Session::flash('success', 'Berhasil Mengubah Data');
        
         //redirect to index
         return redirect()->route('barang')->with(['success' => 'Data Berhasil Diubah!']);

        
    }

    function hapus(Request $request)
    {
        
        ModelsBarang::where('id', $request->id)->delete();

        Session::flash('success', 'Berhasil Hapus Data');

        return redirect('barang');
    }

  
}

