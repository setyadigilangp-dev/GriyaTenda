<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    function users()
    {
        $data = ModelsUser::all();
        return view('data_user.users', ['data' => $data]);
    }

    function edit($id)
    {
        $user = ModelsUser::find($id);

        return view('data_user.edit_user', ['user' => $user]);
    }

    public function update(Request $request, $id)
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
         $user = ModelsUser::find($id);

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
