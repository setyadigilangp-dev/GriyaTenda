<?php

use App\Http\Controllers\kontak;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\MetopemController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\PageAdminController;
use App\Http\Controllers\TranksaksiController;
use App\Http\Controllers\PageFrontendController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Halaman depan
Route::view('/', 'halaman_depan/dashboard');


// Middleware untuk Guest (Belum Login)
Route::middleware(['guest'])->group(function () {
    Route::get('/sesi', [AuthController::class, 'index'])->name('auth');
    Route::post('/sesi', [AuthController::class, 'login']);
    Route::get('/reg', [AuthController::class, 'create'])->name('registrasi');
    Route::post('/reg', [AuthController::class, 'register']);
    Route::get('/verify/{verify_key}', [AuthController::class, 'verify']);
    Route::get('/forgot-password', [AuthController::class, 'showForgotForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
    // Kontak Kami
    Route::get('kontak_depan', [PageFrontendController::class, 'kontak_depan'])->name('kontak_depan');
    Route::post('question', [PageFrontendController::class, 'question'])->name('question');

    // Tentang Kami
    Route::get('tentangkami_depan', [PageFrontendController::class, 'tentangkami_depan'])->name('tentangkami_depan');
});

// Middleware untuk User yang sudah login
Route::middleware(['auth'])->group(function () {

    // Halaman Dashboard untuk User
    Route::get('/user', [ClientController::class, 'index'])->name('user')->middleware('userAkses:user');

    // Halaman untuk Admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('userAkses:admin');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Routes Admin hanya bisa diakses oleh admin
    Route::middleware('userAkses:admin')->group(function () {

        Route::get('dashboard', [PageAdminController::class, 'dashboard'])->name('dashboard');

        // Barang routes
        Route::get('barang', [BarangController::class, 'barang'])->name('barang');
        Route::get('tambahbarang', [BarangController::class, 'tambahbarang'])->name('tambahbarang');
        Route::post('create_barang', [BarangController::class, 'create']);
        Route::get('barang_edit/{id}', [BarangController::class, 'edit']);
        Route::post('update_barang/{id}', [BarangController::class, 'update'])->name('update_barang');
        Route::post('barang_hapus/{id}', [BarangController::class, 'hapus']);

        // Kategori routes
        Route::get('kategori', [KategoriController::class, 'kategori'])->name('kategori');
        Route::get('tambahkategori', [KategoriController::class, 'tambahkategori'])->name('tambahkategori');
        Route::post('create_kategori', [KategoriController::class, 'create']);
        Route::get('kategori_edit/{id}', [KategoriController::class, 'edit']);
        Route::post('update_kategori', [KategoriController::class, 'update']);
        Route::post('kategori_hapus/{id}', [KategoriController::class, 'hapus']);

        // Metode pembayaran routes
        Route::get('metopem', [MetopemController::class, 'metopem'])->name('metopem');
        Route::get('tambahmetopem', [MetopemController::class, 'tambahmetopem'])->name('tambahmetopem');
        Route::post('create_metopem', [MetopemController::class, 'create']);
        Route::get('metopem_edit/{id}', [MetopemController::class, 'edit']);
        Route::post('update_metopem', [MetopemController::class, 'update']);
        Route::post('metopem_hapus/{id}', [MetopemController::class, 'hapus']);

        // Users management
        Route::get('users', [UserController::class, 'users'])->name('users');
        Route::get('edit_user/{id}', [UserController::class, 'edit']);
        Route::post('update_user/{id}', [UserController::class, 'update'])->name('update_user');

        // Transaksi routes
        Route::get('data_tranksaksi', [TranksaksiController::class, 'data_tranksaksi'])->name('data_tranksaksi');
        Route::get('/tranksaksi/{id}/detail', [TranksaksiController::class, 'showTranksaksiDetail'])->name('tranksaksi.detail');
        Route::get('editStatus/{id}', [TranksaksiController::class, 'editStatus']);
        Route::put('/transaksi/{id}/update-status', [TranksaksiController::class, 'updateStatus'])->name('transaksi.updateStatus');

        //Question routes
        Route::get('showQuestion', [QuestionController::class, 'showQuestion'])->name('showQuestion');
        Route::get('detailQuestion/{id}', [QuestionController::class, 'detailQuestion']);
    });

    // Routes User hanya bisa diakses oleh user
    Route::middleware('userAkses:user')->group(function () {

        // Halaman Dashboard untuk Client
        Route::get('home_client', function () {
            return view('frontend.dashboard'); // Pastikan view sesuai dengan struktur folder
        })->name('home_client');

        // Sewa halaman
        Route::get('sewa', [PageFrontendController::class, 'sewa'])->name('sewa');
        
        // Kontak Kami
        Route::get('kontak', [PageFrontendController::class, 'kontak'])->name('kontak');
        Route::post('question', [QuestionController::class, 'question'])->name('question');

        // Tentang Kami
        Route::get('tentangkami', [PageFrontendController::class, 'tentangkami'])->name('tentangkami');

        // Cart routes
        Route::post('cart', [CartController::class, 'cart'])->name('cart');
        Route::get('showcart', [CartController::class, 'showcart'])->name('showcart');
        Route::post('tambah_jml/{id}', [CartController::class, 'tambah_jml'])->name('tambah_jml');
        Route::post('kurang_jml/{id}', [CartController::class, 'kurang_jml'])->name('kurang_jml');
        Route::get('total', [CartController::class, 'showcart'])->name('total');
        Route::post('hapuscart/{id}', [CartController::class, 'hapuscart'])->name('hapuscart');
        Route::post('/cart/add-specific/{id}', [CartController::class, 'addSpecificProductToCart'])->name('cart.add.specific');

        // Rental routes
        Route::post('rental', [RentalController::class, 'rental'])->name('rental');
        Route::get('data_pesanan', [PageFrontendController::class, 'data_pesanan'])->name('data_pesanan');
        Route::post('/calculate-total', [CartController::class, 'calculateTotal']);
        Route::get('/rental/{id}/detail', [PageFrontendController::class, 'showRentalDetail'])->name('rental.detail');
        Route::post('/rental/{id}/upload-bukti', [PageFrontendController::class, 'uploadBuktiPembayaran'])->name('rental.uploadBukti');

        // Edit Profile
        Route::get('editProfile/{id}', [PageFrontendController::class, 'editProfile']);
        Route::post('updateProfile/{id}', [PageFrontendController::class, 'updateProfile'])->name('updateProfile');
    });
});




