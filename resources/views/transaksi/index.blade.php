@extends('layouts.mantis')

@section('content')
<div class="container mt-4">
        <div class="card-header">
            <h3 class="mb-1">Aktivitas</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No Transaksi</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Jenis Sampah</th>
                        <th>Berat</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Pembayaran</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $transaksi)
                    <tr>
                        <td>{{ $transaksi->nomor_transaksi }}</td>
                        <td>{{ \Carbon\Carbon::parse($transaksi->waktu_penjemputan)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($transaksi->waktu_penjemputan)->format('H:i') }}</td>
                        <td>{{ $transaksi->jenis_sampah }}</td>
                        <td>{{ $transaksi->berat }} kg</td>
                        <td>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                        <td>
                            @if($transaksi->status == 'Selesai')
                                <span class="badge bg-success">Diterima</span>
                            @elseif($transaksi->status == 'Ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                            @else
                                <span class="badge bg-warning text-dark">Menunggu Konfirmasi</span>
                            @endif
                        </td>
                        <td><span class="badge bg-secondary">{{ $transaksi->pembayaran }}</span></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada aktivitas transaksi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
</div>
@endsection
