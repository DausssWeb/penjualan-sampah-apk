<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        $transaksis = $query->orderBy('created_at', 'desc')->get();

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
<<<<<<< HEAD
        $maxDate = Carbon::now()->addYear()->format('Y-m-d H:i');

        $validator = \Validator::make($request->all(), [
            'harga_id' => 'required|exists:hargas,id',
            'berat' => 'required|numeric|min:0.1',
            'foto_sampah' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'alamat' => 'required|string|max:500',
            'waktu_penjemputan' => 'required|date|after:now|before:' . $maxDate,
=======
        $request->validate([
            'jenis_sampah' => 'required|string',
            'berat' => 'required|numeric|min:0.1',
            'foto_sampah' => 'required|image|max:5120',
            'alamat' => 'required|string',
            'waktu_penjemputan' => 'required|date|after:now|before:' . date('Y-12-31 23:59:59', strtotime('+1 year')),
>>>>>>> c2356d9ed6a90697f400ab4693d9d9d542b56243
        ], [
            'harga_id.required' => 'Jenis sampah harus dipilih.',
            'harga_id.exists' => 'Jenis sampah tidak valid.',
            'berat.required' => 'Berat harus diisi.',
            'berat.numeric' => 'Berat harus berupa angka.',
            'berat.min' => 'Berat minimal 0.1 kg.',
            'foto_sampah.required' => 'Foto sampah harus diisi.',
            'foto_sampah.image' => 'Foto sampah harus berupa gambar.',
            'foto_sampah.max' => 'Ukuran foto sampah maksimal 5 MB.',
            'alamat.required' => 'Alamat harus diisi.',
<<<<<<< HEAD
            'waktu_penjemputan.required' => 'Waktu penjemputan harus diisi.',
            'waktu_penjemputan.date' => 'Format waktu penjemputan tidak valid.',
            'waktu_penjemputan.after' => 'Waktu penjemputan harus setelah sekarang.',
            'waktu_penjemputan.before' => 'Waktu penjemputan maksimal 1 tahun ke depan.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

=======
            'alamat.string' => 'Alamat harus berupa teks.',
            'waktu_penjemputan.required' => 'Waktu penjemputan harus diisi.',
            'waktu_penjemputan.date' => 'Waktu penjemputan harus berupa tanggal.',
            'waktu_penjemputan.after' => 'Waktu penjemputan tidak boleh di masa lalu.',
            'waktu_penjemputan.before' => 'Waktu penjemputan maksimal hingga akhir tahun depan.',
        ]);

>>>>>>> c2356d9ed6a90697f400ab4693d9d9d542b56243
        // Upload foto
        $fotoPath = null;
        if ($request->hasFile('foto_sampah')) {
            $fotoPath = $request->file('foto_sampah')->store('sampah', 'public');
        }

        // Hitung harga total
        $harga = Harga::findOrFail($request->harga_id);
        $totalHarga = $request->berat * $harga->hargaPerKg;

<<<<<<< HEAD
        // Simpan transaksi
        try {
            Transaksi::create([
                'user_id' => Auth::id(),
                'nomor_transaksi' => 'TRX-' . strtoupper(uniqid()),
                'harga_id' => $harga->id,
                'berat' => $request->berat,
                'foto_sampah' => $fotoPath,
                'alamat' => $request->alamat,
                'waktu_penjemputan' => $request->waktu_penjemputan,
                'total_harga' => $totalHarga,
                'status' => 'Menunggu Konfirmasi',
                'pembayaran' => 'Belum Dibayar',
            ]);

            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diajukan!');
        } catch (\Exception $e) {
            if ($fotoPath) {
                Storage::disk('public')->delete($fotoPath);
            }

            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal menyimpan transaksi. Silakan coba lagi.']);
        }
=======
        $hargaPerKg = $hargaSampah[$request->jenis_sampah] ?? 0;
        $totalHarga = $request->berat * $hargaPerKg;

        // Simpan
        Transaksi::create([
            'user_id' => Auth::id(),
            'nomor_transaksi' => Transaksi::nomorTransaksi(),
            'jenis_sampah' => $request->jenis_sampah,
            'berat' => $request->berat,
            'foto_sampah' => $fotoPath,
            'alamat' => $request->alamat,
            'waktu_penjemputan' => $request->waktu_penjemputan,
            'total_harga' => $totalHarga,
            'status' => 'Menunggu Konfirmasi',
            'pembayaran' => 'Belum Dibayar',
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diajukan!');
>>>>>>> c2356d9ed6a90697f400ab4693d9d9d542b56243
    }

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

    /**
     * API data transaksi user
     */
    public function myTransaction()
    {
        $transaksi = Transaksi::where('user_id', Auth::id())->get();
        return response()->json($transaksi);
    }
}
