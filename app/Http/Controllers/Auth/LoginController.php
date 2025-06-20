<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Custom response saat login gagal
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // Email belum terdaftar
            throw ValidationException::withMessages([
                'email' => ['Email belum terdaftar.'],
            ]);
        }

        if (!Hash::check($request->password, $user->password)) {
            // Password salah
            throw ValidationException::withMessages([
                'password' => ['Password salah.'],
            ]);
        }

        // Pesan fallback jika login gagal tanpa sebab spesifik (jarang terjadi)
        throw ValidationException::withMessages([
            $this->username() => ['Email atau password salah.'],
        ]);
    }
}
