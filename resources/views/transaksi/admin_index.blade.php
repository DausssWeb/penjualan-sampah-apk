@extends('layouts.mantis')

@section('content')
<div class="container mt-4">
    <div class="card-header">
        <h3 class="card-title">Data Transaksi</h3>
    </div>
    <div class="card-body">
            <style>
                .table-striped-green tbody tr:nth-of-type(odd) {
                    background-color: #d4edda; /* hijau muda Bootstrap */
                }
                .table-striped-green tbody tr:nth-of-type(even) {
                    background-color: #f8f9fa; /* abu-abu terang (putih kehijauan) */
                }
            </style>
            <table class="table table-bordered">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nomor Transaksi</th>
                        <th>Nama User</th>
                        <th>Jenis Sampah</th>
                        <th>Berat (kg)</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $key => $transaksi)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>{{ $transaksi->nomor_transaksi }}</td>
                        <td>{{ $transaksi->user->name ?? '-' }}</td>
                        <td>{{ $transaksi->harga->jenis_sampah ?? '-' }}</td>
                        <td class="text-center">{{ $transaksi->berat }}</td>
                        <td>Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
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
                            <form action="{{ route('transaksi.updateStatus', $transaksi->id) }}" method="POST" class="d-flex gap-1">
                                @csrf
                                @method('PUT')
                                <div class="input-group">
                                    <select name="status" class="form-select form-select-sm">
                                        <option value="Selesai" {{ $transaksi->status == 'Selesai' ? 'selected' : '' }}>Diterima</option>
                                        <option value="Ditolak" {{ $transaksi->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                    <select name="pembayaran" class="form-select form-select-sm">
                                        <option value="Sudah Dibayar" {{ $transaksi->pembayaran == 'Sudah Dibayar' ? 'selected' : '' }}>Sudah Dibayar</option>
                                        <option value="Belum Dibayar" {{ $transaksi->pembayaran == 'Belum Dibayar' ? 'selected' : '' }}>Belum Dibayar</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-success">Update</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted">Belum ada transaksi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
    </div>
</div>
@endsection
