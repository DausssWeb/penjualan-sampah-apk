<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HargaController extends Controller
{
    public function index()
    {
        $harga = Harga::all();
        return view('harga.index', compact('harga'));
    }

    public function create()
    {
        return view('harga.create');
    }

    public function store(Request $request)
    {  
    $request->validate([
       'jenis_sampah' => 'required',
       'harga' => 'required|numeric|min:1',
    ], [
        'jenis_sampah.required' => 'Jenis sampah harus diisi.',
        'harga.required' => 'Harga per kg harus diisi.',
        'harga.numeric' => 'Harga per kg harus berupa angka.',
        'harga.min' => 'Harga per kg tidak boleh negatif.'
    ]);

    Harga::create([
        'jenis_sampah' => $request->jenis_sampah,
        'hargaPerKg' => $request->harga
    ]);

    Alert::success('Berhasil', 'Harga berhasil ditambahkan!');
    return redirect()->route('harga.index');
    }

    public function edit(String $id)
    {
        $harga = Harga::find($id);
        return view('harga.edit', compact('harga'));
    }

    public function update(Request $request, Harga $harga)
    {
        $request->validate([
            'jenis_sampah' => 'required',
            'harga' => 'required|numeric|min:1',
        ], [
            'jenis_sampah.required' => 'Jenis sampah harus diisi.',
            'harga.required' => 'Harga per kg harus diisi.',
            'harga.numeric' => 'Harga per kg harus berupa angka.',
            'harga.min' => 'Harga per kg tidak boleh negatif.'
        ]);

        $harga->update([
        'jenis_sampah' => $request->jenis_sampah,
        'hargaPerKg' => $request->harga,
        ]);

        Alert::success('Berhasil', 'Harga berhasil diperbarui!');
        return redirect()->route('harga.index');
    }

    public function destroy(String $id)
    {
        Harga::destroy($id);
        Alert::success('Berhasil', 'Harga berhasil dihapus!');
        return redirect()->route('harga.index');
    }
}
