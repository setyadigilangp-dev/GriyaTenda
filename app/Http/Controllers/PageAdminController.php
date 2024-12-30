<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class PageAdminController extends Controller
{
    /**
     * Display dashboard page
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        return view('pointakses.admin.index');
    }

    /**
     * Display data tranksaksi page
     *
     * @return \Illuminate\View\View
     */
    public function data_pesanan()
    {
        return view('data_pesanan.pesanan');
    }
    
}
