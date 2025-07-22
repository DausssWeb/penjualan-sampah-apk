@extends('layouts.mantis')

@section('content')
<div class="container mt-4">
    <div class="card-header">
        <h3 class="mb-1">Aktivitas</h3>
    </div>
    <div class="card-body">
        <!-- Tambahkan wrapper responsive di sini -->
        <div class="table-responsive">
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
                        <th>Aksi</th>
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
                        <td>
                            @if($transaksi->pembayaran == 'Sudah Dibayar')
                                <span class="badge bg-primary">Sudah Dibayar</span>
                            @else
                                <span class="badge bg-secondary">Belum Dibayar</span>
                            @endif
                        </td>
                        <td>
                            @if($transaksi->status == 'Menunggu Konfirmasi')
                            <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan transaksi ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Batal</button>
                            </form>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">Belum ada aktivitas transaksi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- END table-responsive -->
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

                    let csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    let aksi = '-';
                    if (transaksi.status === 'Menunggu Konfirmasi') {
                        aksi = `
                            <form action="/transaksi/${transaksi.id}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan transaksi ini?')">
                                <input type="hidden" name="_token" value="${csrf}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-sm btn-danger">Batal</button>
                            </form>
                        `;
                    }



                    rows += `
                        <tr>
                            <td>${transaksi.nomor_transaksi}</td>
                            <td>${tanggal}</td>
                            <td>${waktu}</td>
                            <td>${transaksi.harga?.jenis_sampah ?? '-'}</td>
                            <td>${parseFloat(transaksi.berat).toFixed(1)} kg</td>
                            <td>Rp ${parseInt(transaksi.total_harga).toLocaleString('id-ID')}</td>
                            <td>${statusBadge}</td>
                            <td>${pembayaranBadge}</td>
                            <td>${aksi}</td>
                        </tr>
                    `;
                });
            } else {
                rows = `
                    <tr>
                        <td colspan="9" class="text-center">Belum ada aktivitas transaksi.</td>
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
