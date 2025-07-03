<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $profile = $user->profile;

        return view('profile.index', compact('user', 'profile'));
    }

    public function create()
    {
        $user = Auth::user();

        // Kalau sudah punya profile, redirect ke edit
        if ($user->profile) {
            return redirect()->route('profile.edit', $user->profile->id);
        }

        return view('profile.create', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'no_telp' => 'required|string',
            'alamat' => 'required|string',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'no_telp.required' => 'Nomor telepon wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
        ]);

        $user = Auth::user();
        $user->update(['name' => $request->name]); // ✅ update User, bukan Profile

        $profile = Profile::create([
            'user_id' => $user->id, // ✅ pakai ID user yang login
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);
        Alert::success('Berhasil', 'Profil berhasil disimpan');
        return redirect()->route('profile.index');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $profile = Profile::find($id);

        if (!$profile || $profile->user_id != $user->id) {
            abort(404);
        }

        return view('profile.edit', compact('user', 'profile'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'no_telp' => 'required|string',
            'alamat' => 'required|string',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'no_telp.required' => 'Nomor telepon wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
        ]);

        $user = Auth::user();
        $profile = Profile::find($id);

        if (!$profile || $profile->user_id != $user->id) {
            abort(404);
        }

        $user->update(['name' => $request->name]);

        $profile->update([
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        Alert::success('Berhasil', 'Profil berhasil diperbarui');
        return redirect()->route('profile.index');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $profile = Profile::find($id);

        if (!$profile || $profile->user_id != $user->id) {
            abort(404);
        }

        $profile->delete();

        Alert::success('Berhasil', 'Profil berhasil dihapus');
        return redirect()->route('profile.index');
    }
}
