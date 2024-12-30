<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Metopem as ModelsMetopem;

class MetopemController extends Controller
{

    function metopem()
    {
        $data = ModelsMetopem::all();
        return view('data_metode_bayar.metopem', ['data' => $data]);
    }

    function tambahmetopem()
    {
        return view('data_metode_bayar.tambah_metopem');
    }

    function edit($id)
    {
        $data = ModelsMetopem::find($id);

        return view('data_metode_bayar.edit_metopem', ['data' => $data]);
    }

    function create(Request $request)
    {
        $request->validate([
            'metode_bayar' => 'required|max:255',
            'no_rekening' => 'required|max:255',
            'atas_nama' => 'required|max:255',
        ], [
            'metode_bayar.required' => 'Nama Wajib Di isi',
            'metode_bayar.max' => 'Nama wajib maximal 255 huruf',
            'no_rekening.required' => 'Nama Wajib Di isi',
            'no_rekening.max' => 'Nama wajib maximal 255 huruf',
            'atas_nama.required' => 'Nama Wajib Di isi',
            'atas_nama.max' => 'Nama wajib maximal 255 huruf',
        ]);

        ModelsMetopem::insert([
            'metode_bayar' => $request->metode_bayar,
            'no_rekening' => $request->no_rekening,
            'atas_nama' => $request->atas_nama,
        ]);

        Session::flash('success', 'Data berhasil ditambahkan');

        return redirect('metopem')->with('success', 'Berhasil Menambahkan Data');
    }

    function update(Request $request)
    {
        $request->validate([
            'metode_bayar' => 'required|max:255',
            'no_rekening' => 'required|max:255',
            'atas_nama' => 'required|max:255',
        ], [
            'metode_bayar.required' => 'Nama Wajib Di isi',
            'metode_bayar.max' => 'Nama wajib maximal 255 huruf',
            'no_rekening.required' => 'Nama Wajib Di isi',
            'no_rekening.max' => 'Nama wajib maximal 255 huruf',
            'atas_nama.required' => 'Nama Wajib Di isi',
            'atas_nama.max' => 'Nama wajib maximal 255 huruf',
        ]);

        $metopem = ModelsMetopem::find($request->id);

        $metopem->metode_bayar = $request->metode_bayar;
        $metopem->no_rekening = $request->no_rekening;
        $metopem->atas_nama = $request->atas_nama;
        $metopem->save();

        Session::flash('success', 'Berhasil Mengubah Data');

        return redirect('metopem');
    }

    function hapus(Request $request)
    {
        
        ModelsMetopem::where('id', $request->id)->delete();

        Session::flash('success', 'Berhasil Hapus Data');

        return redirect('metopem');
    }

  
}
