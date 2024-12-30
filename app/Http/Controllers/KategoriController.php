<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Kategori as ModelsKategori;

class KategoriController extends Controller
{

    function kategori()
    {
        $data = ModelsKategori::all();
        return view('data_kategori.kategori', ['data' => $data]);
    }

    function tambahkategori()
    {
        return view('data_kategori.tambah_kategori');
    }

    function edit($id)
    {
        $data = ModelsKategori::find($id);

        return view('data_kategori.edit_kategori', ['data' => $data]);
    }

    function create(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|max:255',
        ], [
            'nama_kategori.required' => 'Nama Wajib Di isi',
            'nama_kategori.max' => 'Nama wajib maximal 255 huruf',
        ]);

        ModelsKategori::insert([
            'nama_kategori' => $request->nama_kategori,
        ]);

        Session::flash('success', 'Data berhasil ditambahkan');

        return redirect('kategori')->with('success', 'Berhasil Menambahkan Data');
    }

    function update(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|max:255',
        ], [
            'nama_kategori.required' => 'Nama Wajib Di isi',
            'nama_kategori.max' => 'Nama wajib maximal 255 huruf',
        ]);

        $kategori = ModelsKategori::find($request->id);

        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();

        Session::flash('success', 'Berhasil Mengubah Data');

        return redirect('kategori');
    }

    function hapus(Request $request)
    {
        
        ModelsKategori::where('id', $request->id)->delete();

        Session::flash('success', 'Berhasil Hapus Data');

        return redirect('kategori');
    }

  
}
