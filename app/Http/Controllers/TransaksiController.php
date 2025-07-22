<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller
{
    /**
     * Tampilkan daftar transaksi (user & admin)
     */
    public function index(Request $request)
    {
        $query = Transaksi::with('user', 'harga');

        if (Auth::user()->role_id != 1) {
            $query->where('user_id', Auth::id());
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('pembayaran') && $request->pembayaran != '') {
            $query->where('pembayaran', $request->pembayaran);
        }

        $transaksis = $query->orderBy('created_at', 'asc')->get();

        if (Auth::user()->role_id == 1) {
            return view('transaksi.admin_index', compact('transaksis'));
        }

        return view('transaksi.index', compact('transaksis'));
    }

    /**
     * Form create
     */
    public function create()
    {
        $hargas = Harga::all();
        return view('transaksi.create', compact('hargas'));
    }

    /**
     * Simpan transaksi baru
     */
    public function store(Request $request)
    {
        $maxDate = Carbon::now()->addYears(2)->format('Y-m-d H:i');

        $validator = \Validator::make($request->all(), [
            'harga_id' => 'required|exists:hargas,id',
            'berat' => 'required|numeric|min:0.1',
            'foto_sampah' => 'required|string|max:5120',
            'alamat' => 'required|string|max:500',
            'waktu_penjemputan' => 'required|date|after:now|before:' . $maxDate,
        ], [
            'harga_id.required' => 'Jenis sampah harus dipilih.',
            'harga_id.exists' => 'Jenis sampah tidak valid.',
            'berat.required' => 'Berat harus diisi.',
            'berat.numeric' => 'Berat harus berupa angka.',
            'berat.min' => 'Berat minimal 0.1 kg.',
            'foto_sampah.required' => 'Foto sampah harus diupload.',
            'foto_sampah.string' => 'File harus berupa gambar.',
            'foto_sampah.max' => 'Ukuran foto maksimal 5 MB.',
            'alamat.required' => 'Alamat harus diisi.',
            'waktu_penjemputan.required' => 'Waktu penjemputan harus diisi.',
            'waktu_penjemputan.date' => 'Format waktu penjemputan tidak valid.',
            'waktu_penjemputan.after' => 'Waktu penjemputan harus setelah waktu sekarang.',
            'waktu_penjemputan.before' => 'Waktu penjemputan tidak boleh lebih dari 2 tahun dari sekarang.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Upload foto
        $fotoPath = $request->input('foto_sampah'); // bukan dari file
        if ($request->hasFile('foto_sampah')) {
            $fotoPath = $request->file('foto_sampah')->store('sampah', 'public');
        }

        // Hitung harga total
        $harga = Harga::findOrFail($request->harga_id);
        $totalHarga = $request->berat * $harga->hargaPerKg;

        // Simpan transaksi
        try {
            Transaksi::create([
                'user_id' => Auth::id(),
                'nomor_transaksi' => Transaksi::nomorTransaksi(),
                'harga_id' => $harga->id,
                'berat' => $request->berat,
                'foto_sampah' => $fotoPath,
                'alamat' => $request->alamat,
                'waktu_penjemputan' => $request->waktu_penjemputan,
                'total_harga' => $totalHarga,
                'status' => 'Menunggu Konfirmasi',
                'pembayaran' => 'Belum Dibayar',
            ]);

            Alert::success('Berhasil', 'Transaksi berhasil diajukan!');
            return redirect()->route('transaksi.index');
        } catch (\Exception $e) {
            if ($fotoPath) {
                Storage::disk('public')->delete($fotoPath);
            }

            Alert::error('Gagal', 'Gagal menyimpan transaksi. Silakan coba lagi.');
            return redirect()->back()->withInput();
        }
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        // Hapus file foto jika ada
        if ($transaksi->foto_sampah && Storage::disk('public')->exists($transaksi->foto_sampah)) {
            Storage::disk('public')->delete($transaksi->foto_sampah);
        }

        // Admin boleh hapus apa saja
        if (Auth::user()->role_id == 1) {
            $transaksi->delete();
            Alert::success('Berhasil', 'Transaksi berhasil dihapus.');
            return redirect()->back();
        }

        // User hanya bisa hapus transaksi miliknya yang belum diproses
        if ($transaksi->user_id == Auth::id() && $transaksi->status == 'Menunggu Konfirmasi') {
            $transaksi->delete();
            Alert::success('Berhasil', 'Transaksi berhasil dibatalkan.');
            return redirect()->route('transaksi.index');
        }

        // Jika tidak memenuhi kondisi
        Alert::error('Gagal', 'Kamu tidak memiliki izin menghapus transaksi ini.');
        return redirect()->back();
    }


    public function uploadFoto(Request $request)
    {
        $request->validate([
            'foto_sampah' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $userId = Auth::id();
        $timestamp = now()->format('YmdHis'); // Misal: 20250722103045
        $extension = $request->file('foto_sampah')->getClientOriginalExtension();

        $fileName = 'foto_sampah-' . $userId . '-' . $timestamp . '.' . $extension;

        // Simpan ke storage/app/public/sampah/
        $path = $request->file('foto_sampah')->storeAs('sampah', $fileName, 'public');

        return response()->json([
            'status' => 'success',
            'path' => $path,
            'filename' => $fileName
        ]);
    }

    // public function uploadFoto(Request $request)
    // {
    //     $request->validate([
    //         'foto_sampah' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
    //     ]);

    //     $path = $request->file('foto_sampah')->store('sampah', 'public');

    //     return response()->json([
    //         'status' => 'success',
    //         'path' => $path,
    //     ]);
    // }


    /**
     * Admin update status & pembayaran
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
            'pembayaran' => 'required|string',
        ]);

        $transaksi = Transaksi::findOrFail($id);

        $transaksi->update([
            'status' => $request->status,
            'pembayaran' => $request->pembayaran,
        ]);

        return redirect()->back()->with('success', 'Status transaksi berhasil diperbarui.');
    }

    // Transaksi user
    public function myTransaction()
    {
        $transaksi = Transaksi::with('harga')  // <-- tambahkan relasi
            ->where('user_id', Auth::id())
            ->get();
        return response()->json($transaksi);
    }

    // Transaksi admin
    public function getJson()
    {
        $transaksis = \App\Models\Transaksi::with(['user', 'harga'])
            ->orderBy('created_at', 'desc') // desc asc
            ->get();

        return response()->json($transaksis);
    }




}
