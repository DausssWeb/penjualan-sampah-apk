<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use Illuminate\Http\Request;

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
       'harga' => 'required|numeric',
    ], [
        'jenis_sampah.required' => 'Jenis sampah harus diisi.',
        'harga.required' => 'Harga per kg harus diisi.',
        'harga.numeric' => 'Harga per kg harus berupa angka.',
    ]);

    Harga::create([
        'jenis_sampah' => $request->jenis_sampah,
        'hargaPerKg' => $request->harga
    ]);

    return redirect()->route('harga.index')->with('success', 'Harga berhasil ditambahkan');
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
            'harga' => 'required|numeric',
        ], [
            'jenis_sampah.required' => 'Jenis sampah harus diisi.',
            'harga.required' => 'Harga per kg harus diisi.',
            'harga.numeric' => 'Harga per kg harus berupa angka.',
        ]);

        $harga->update([
        'jenis_sampah' => $request->jenis_sampah,
        'hargaPerKg' => $request->harga,
        ]);

    return redirect()->route('harga.index')->with('success', 'Harga berhasil diperbarui');
    }

    public function destroy(String $id)
    {
        Harga::destroy($id);
        return redirect()->route('harga.index');
    }
}
