<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    /**
     * Tampilkan daftar transaksi (user & admin)
     */
    public function index(Request $request)
    {
        $query = Transaksi::with('user');

        // Filter untuk non-admin
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

    public function create()
    {
        return view('transaksi.create');
    }


    /**
     * Simpan transaksi baru
     */
    public function store(Request $request)
    {
        // buat tanggal batas untuk validasi sampai 1 tahun ke depan
        $maxDate = Carbon::now()->addYear()->format('d/m/Y H:i');

        // validasi
        $request->validate([
            'jenis_sampah' => 'required|string',
            'berat' => 'required|numeric|min:0.1',
            'foto_sampah' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            //jika ingin bersifat opsional tapi tetep validasi ketika ada file, pakai:
            // 'foto_sampah' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'alamat' => 'required|string',
            //after:now dan before untuk membatasi rentang waktu
            'waktu_penjemputan' => 'required|date|after:now|before:' . $maxDate,
        ], [
            'jenis_sampah.required' => 'Jenis sampah harus diisi.',
            'berat.required' => 'Berat harus diisi.',
            'berat.numeric' => 'Berat harus berupa angka.',
            'berat.min' => 'Berat minimal 0.1 kg.',
            'foto_sampah.required' => 'Foto sampah harus di upload.',
            'foto_sampah.image' => 'File sampah harus berupa gambar.',
            'foto_sampah.mimes' => 'Format foto sampah harus JPEG, PNG, atau JPG.',
            'foto_sampah.max' => 'Ukuran foto sampah maksimal 5 MB.',
            'alamat.required' => 'Alamat harus diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'waktu_penjemputan.required' => 'Waktu penjemputan harus diisi.',
            'waktu_penjemputan.date' => 'Waktu penjemputan harus berupa tanggal yang valid.',
            'waktu_penjemputan.after' => 'Waktu penjemputan harus dalam tahun sekarang.',
            'waktu_penjemputan.before' => 'Waktu penjemputan maksimal 1 tahun ke depan.',
        ]);

        // Upload foto
        //pake try catch jika ada error
        $fotoPath = null;
        if ($request->hasFile('foto_sampah')) {
            try {
                $fotoPath = $request->file('foto_sampah')->store('sampah', 'public');
            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['foto_sampah' => 'Gagal mengupload foto. Silakan coba lagi.']);
            }
        }

        // Hitung harga
        $hargaSampah = [
            'Plastik Botol' => 3000,
            'Kaleng' => 4000,
            'Kertas' => 2500,
            'Botol Kaca' => 1500,
            'Kardus' => 2000,
            'Logam' => 5000,
        ];

        $hargaPerKg = $hargaSampah[$request->jenis_sampah] ?? 0;
        $totalHarga = $request->berat * $hargaPerKg;

        // Simpan
        try {
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
    } catch (\Exception $e) {
        //hapus foto jika gagal di simpan di database
        if ($fotoPath) {
            Storage::disk('public')->delete($fotoPath);
        }
        return redirect()->back()
            ->withInput()
            ->withErrors(['error' => 'Gagal menyimpan transaksi. Silakan coba lagi.']);
        }   
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

    public function myTransaction() {
        $transaksi = Transaksi::where('user_id', Auth::id())->get();
        return response()->json($transaksi);
    }
}