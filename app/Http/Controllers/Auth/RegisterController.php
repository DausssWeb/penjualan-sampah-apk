<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
{
    return Validator::make($data, [
        'name' => [
            'required',
            'string',
            'min:3',
            'max:255',
            'regex:/^[a-zA-Z\s]+$/',
            'unique:users,name' // validasi nama unik
        ],
        'role_id' =>['required', 'string'],
        'email' => [
            'required',
            'string',
            'email',
            'max:255',
            'unique:users,email' // validasi email unik
        ],
        'password' => [
            'required',
            'string',
            'min:8',
            'max:100',
            'confirmed'
        ],
    ], [
        // ✅ Pesan error kustom
        'name.required' => 'Nama wajib diisi.',
        'name.string' => 'Nama harus berupa teks.',
        'name.min' => 'Nama minimal harus terdiri dari 3 karakter.',
        'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
        'name.regex' => 'Nama hanya boleh mengandung huruf dan spasi.',
        'name.unique' => 'Nama ini sudah terdaftar.',

        'role.required' => 'Role wajib diisi.',
        'role.string' => 'Role harus berupa teks.',

        'email.required' => 'Email wajib diisi.',
        'email.string' => 'Email harus berupa teks.',
        'email.email' => 'Format email tidak valid.',
        'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
        'email.unique' => 'Email ini sudah terdaftar.',

        'password.required' => 'Password wajib diisi.',
        'password.string' => 'Password harus berupa teks.',
        'password.min' => 'Password minimal terdiri dari 8 karakter.',
        'password.max' => 'Password maksimal 100 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.'
    ]);
}

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'role_id' => $data['role_id'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
