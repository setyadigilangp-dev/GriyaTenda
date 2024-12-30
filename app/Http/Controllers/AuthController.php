<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Mail\AuthMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    function index()
    {
        return view('halaman_auth/login');
    }
    function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            if (Auth::user()->email_verified_at != null) {
                if (Auth::user()->role === 'admin') {
                    return redirect()->route('dashboard')->with('success', 'Halo Admin , Anda berhasil login');
                } else if (Auth::user()->role === 'user') {

                    $cart = Cart::where('user_id', Auth::user())->get();

                    return redirect()->route('home_client', compact('cart'))->with('success', 'Berhasil login');
                }
            } else {
                Auth::logout();
                return redirect()->route('auth')->withErrors('Akun anda belum Aktif. Harap Verifikasi terlebih dahulu');
            }
        } else {
            return redirect()->route('auth')->withErrors('Email atau password salah');
        }
    }
    function create()
    {
        return view('halaman_auth/register');
    }
    function register(Request $request)
    {
        $str = Str::random(100);

        $request->validate([
            
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6',
            'fullname' => 'required|min:5',
            'jenis_kelamin' => 'required',
            'nomor_wa' => 'required|min:10|max:14',
            'alamat' => 'required|max:255',
            'gambar' => 'required|image|file',
        ], [
            
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email telah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
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

        $gambar_file = $request->file('gambar');
        $gambar_ekstensi = $gambar_file->extension();
        $nama_gambar = date('ymdhis') . "." . $gambar_ekstensi;
        $gambar_file->move(public_path('picture/accounts'), $nama_gambar);

        $inforegister = [
            
            'email' => $request->email,
            'password' => $request->password,
            'fullname' => $request->fullname,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nomor_wa' => $request->nomor_wa,
            'alamat' => $request->alamat,
            'gambar' => $nama_gambar,
            'verify_key' => $str
        ];

        User::create($inforegister);

        $details = [
            'nama' => $inforegister['fullname'],
            'jenis_kelamin' => $inforegister['jenis_kelamin'],
            'nomor_wa' => $inforegister['nomor_wa'],
            'alamat' => $inforegister['alamat'],
            'role' => 'user',
            'datetime' => date('Y-m-d H:i:s'),
            'website' => 'Griya Tenda Adventure - Registration',
            'url' => 'http://' . request()->getHttpHost() . "/" . "verify/" . $inforegister['verify_key'],
        ];

        Mail::to($inforegister['email'])->send(new AuthMail($details));

        return redirect()->route('auth')->with('success', 'Link verifikasi telah dikirim ke email anda. Cek email untuk melakukan verifikasi');
    }
    function verify($verify_key)
    {
        $keyCheck = User::select('verify_key')
            ->where('verify_key', $verify_key)
            ->exists();

        if ($keyCheck) {
            $user = User::where('verify_key', $verify_key)->update(['email_verified_at' => date('Y-m-d H:i:s')]);

            return redirect()->route('auth')->with('success', 'Verifikasi berhasil. akun anda sudah aktif.');
        } else {
            return redirect()->route('auth')->withErrors('Keys tidak valid. pastikan telah melakukan register')->withInput();
        }
    }
    function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function showForgotForm()
    {
        return view('halaman_auth.forgotPass');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetForm(Request $request, $token)
    {
        return view('halaman_auth.resetPass', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('auth')->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}
