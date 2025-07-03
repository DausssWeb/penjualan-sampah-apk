<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function index()
    {
        $user = Auth::user();
        $profile = $user->profile;

        return view('profile.index', compact('user', 'profile'));
    }

    /**
     * Show the form for creating a new profile.
     */
    public function create()
    {
        $user = Auth::user();

        // Kalau sudah ada profile, langsung redirect ke edit
        if ($user->profile) {
            return redirect()->route('profile.edit', $user->profile->id);
        }

        return view('profile.create', compact('user'));
    }

    /**
     * Store a newly created profile.
     */
    public function store(Request $request)
    {
       $request->validate([
            'name' => 'required|string|max:255',
            'no_telp' => 'required|string',
            'alamat' => 'required|string',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'no_telp.required' => 'Nomor telepon wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
        ]);

        $user = Auth::user();
        $user->update(['name' => $request->name]);

        $user->profile()->create([
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        Alert::success('Berhasil', 'Profil berhasil disimpan');
        return redirect()->route('profile.index');
    }

    /**
     * Show the form for editing the profile.
     */
    public function edit($id)
    {
        $user = Auth::user();
        $profile = $user->profile;

        if (!$profile || $profile->id != $id) {
            abort(404);
        }

        return view('profile.edit', compact('user', 'profile'));
    }

    /**
     * Update the profile.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'no_telp' => 'required|string',
            'alamat' => 'required|string',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'no_telp.required' => 'Nomor telepon wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
        ]);

        $user = Auth::user();
        $user->update(['name' => $request->name]);

        $profile = $user->profile;

        if ($profile && $profile->id == $id) {
            $profile->update([
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
            ]);
        } else {
            abort(404);
        }

        Alert::success('Berhasil', 'Profil berhasil diperbarui');
        return redirect()->route('profile.index');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy($id)
    {
        // optional: bisa isi kalau mau hapus profile
    }
}
