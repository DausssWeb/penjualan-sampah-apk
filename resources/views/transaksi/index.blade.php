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
                        <td>{{ $transaksi->harga->jenis_sampah ?? '-' }}</td>
                        <td>{{ number_format($transaksi->berat,1,'.') }} kg</td>
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
                        <td>@if($transaksi->pembayaran == 'Sudah Dibayar')
                                <span class="badge bg-primary">Sudah Dibayar</span>
                            @else
                                <span class="badge bg-secondary">Belum Dibayar</span>
                            @endif
                        </td>
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
@push('js')
    <script>

function getTransaksi() {
    $.ajax({
        type: "GET",
        url: "/my-transaksi",
        success: function (response) {
            let rows = '';

            if(response.length > 0) {
                response.forEach(function(transaksi) {
                    let tanggal = new Date(transaksi.waktu_penjemputan).toLocaleDateString('id-ID');
                    let waktu = new Date(transaksi.waktu_penjemputan).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

                    let statusBadge = '';
                    if (transaksi.status === 'Selesai') {
                        statusBadge = '<span class="badge bg-success">Diterima</span>';
                    } else if (transaksi.status === 'Ditolak') {
                        statusBadge = '<span class="badge bg-danger">Ditolak</span>';
                    } else {
                        statusBadge = '<span class="badge bg-warning text-dark">Menunggu Konfirmasi</span>';
                    }

                    let pembayaranBadge = '';
                    if (transaksi.pembayaran === 'Sudah Dibayar') {
                        pembayaranBadge = '<span class="badge bg-primary">Sudah Dibayar</span>';
                    } else {
                        pembayaranBadge = '<span class="badge bg-secondary">Belum Dibayar</span>';
                    }

                    rows += `
                        <tr>
                            <td>${transaksi.nomor_transaksi}</td>
                            <td>${tanggal}</td>
                            <td>${waktu}</td>
                            <td>${transaksi.harga?.jenis_sampah ?? '-'}</td>
                            <td>${transaksi.berat} kg</td>
                            <td>Rp ${parseInt(transaksi.total_harga).toLocaleString('id-ID')}</td>
                            <td>${statusBadge}</td>
                            <td>${pembayaranBadge}</td>
                        </tr>
                    `;
                });
            } else {
                rows = `
                    <tr>
                        <td colspan="8" class="text-center">Belum ada aktivitas transaksi.</td>
                    </tr>
                `;
            }

            $('tbody').html(rows);
        }
    });
}

        $(document).ready(function () {

            
            setInterval(() => {
                getTransaksi();
                
            }, 1000);
        });
    </script>
@endpush
@endsection
