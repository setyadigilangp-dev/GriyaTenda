<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{

    function showQuestion()
    {
        $data = Question::all();
        return view('data_question.question', ['data' => $data]);
    }

    function detailQuestion($id)
    {
        $data = Question::find($id);

        return view('data_question.detail_question', ['data' => $data]);
    }


    function question(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email',
            'nomor_wa' => 'required|min:10|max:14',
            'judul' => 'required|max:255',
            'pesan' => 'required|max:255',
        ], [
            'nama.required' => 'Nama Wajib Di isi',
            'nama.max' => 'Nama wajib maximal 255 huruf',
            'email.required' => 'Email Wajib Di isi',
            'nomor_wa.required' => 'nomor wa wajib diisi',
            'nomor_wa.min' => 'nomor wa minimal 10 angka',
            'nomor_wa.max' => 'nomor wa maximal 14 angka',
            'judul.required' => 'judul Wajib Di isi',
            'judul.max' => 'judul wajib maximal 255 huruf',
            'pesan.required' => 'pesan Wajib Di isi',
            'pesan.max' => 'pesan wajib maximal 255 huruf',
        ]);

        Question::insert([
            'nama' => $request->nama,
            'email' => $request->email,
            'nomor_wa' => $request->nomor_wa,
            'judul' => $request->judul,
            'pesan' => $request->pesan,
        ]);

        Session::flash('success', 'Data berhasil ditambahkan');

        return redirect('kontak')->with('success', 'Berhasil Menambahkan Data');
    }

    function hapus(Request $request)
    {
        
        Question::where('id', $request->id)->delete();

        Session::flash('success', 'Berhasil Hapus Data');

        return redirect('showQuestion');
    }

  
}
