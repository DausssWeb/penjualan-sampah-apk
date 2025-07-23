@extends('layouts.mantis')

@section('content')
<div class="container mt-4">
    <div class="card-header">
        <h3 class="card-title">Data Transaksi</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nomor Transaksi</th>
                        <th>Nama User</th>
                        <th>Alamat Penjemputan</th>
                        <th>Waktu Penjemputan</th>
                        <th>Jenis Sampah</th>
                        <th>Berat (kg)</th>
                        <th>Total Harga</th>
                        <th>Foto</th>
                        <th>Status</th>
                        <th>Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="transaksi-body">
                    <!-- Data AJAX akan ditampilkan di sini -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Foto -->
<div class="modal fade" id="fotoModal" tabindex="-1" aria-labelledby="fotoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="fotoModalLabel">Foto Sampah</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body text-center">
        <img id="fotoModalImg" src="" alt="Foto Sampah" class="img-fluid rounded">
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
<script>
    function renderRow(transaksi, index) {
        let statusBadge = transaksi.status === 'Selesai'
            ? '<span class="badge bg-success">Diterima</span>'
            : (transaksi.status === 'Ditolak'
                ? '<span class="badge bg-danger">Ditolak</span>'
                : '<span class="badge bg-warning text-dark">Menunggu Konfirmasi</span>');

        let pembayaranBadge = transaksi.pembayaran === 'Sudah Dibayar'
            ? '<span class="badge bg-primary">Sudah Dibayar</span>'
            : '<span class="badge bg-secondary">Belum Dibayar</span>';

        let waktu = transaksi.waktu_penjemputan ?? '-';

        return `
            <tr data-id="${transaksi.id}">
                <td class="text-center">${index + 1}</td>
                <td>${transaksi.nomor_transaksi}</td>
                <td>${transaksi.user.name}</td>
                <td>${transaksi.alamat ?? '-'}</td>
                <td>${waktu}</td>
                <td>${transaksi.harga.jenis_sampah}</td>
                <td class="text-center">${transaksi.berat}</td>
                <td>Rp${Number(transaksi.total_harga).toLocaleString('id-ID')}</td>
                <td class="text-center">
                    ${transaksi.foto_sampah 
                        ? `<button class="btn btn-sm btn-info" onclick="showFotoModal('/storage/${transaksi.foto_sampah}')">
                            <i class="ti ti-eye">Lihat</i> 
                           </button>`
                        : '<span class="text-muted">Tidak ada</span>'
                    }
                </td>
                <td id="status-${transaksi.id}">${statusBadge}</td>
                <td id="pembayaran-${transaksi.id}">${pembayaranBadge}</td>
                <td>
                    <div class="d-flex gap-1">
                        <form action="/transaksi/${transaksi.id}/update-status" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PUT">
                            <div class="input-group">
                                <select name="status" class="form-select form-select-sm">
                                    <option value="Selesai" ${transaksi.status === 'Selesai' ? 'selected' : ''}>Diterima</option>
                                    <option value="Ditolak" ${transaksi.status === 'Ditolak' ? 'selected' : ''}>Ditolak</option>
                                </select>
                                <select name="pembayaran" class="form-select form-select-sm">
                                    <option value="Sudah Dibayar" ${transaksi.pembayaran === 'Sudah Dibayar' ? 'selected' : ''}>Sudah Dibayar</option>
                                    <option value="Belum Dibayar" ${transaksi.pembayaran === 'Belum Dibayar' ? 'selected' : ''}>Belum Dibayar</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-success">Update</button>
                            </div>
                        </form>
                        <form action="/transaksi/${transaksi.id}" method="POST" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
        `;
    }

    function refreshTransaksiTable() {
        $.ajax({
            type: "GET",
            url: "{{ route('admin.transaksi.json') }}",
            success: function (response) {
                let html = '';
                if (response.length === 0) {
                    html = `
                        <tr>
                            <td colspan="12" class="text-center text-muted">Belum ada aktivitas transaksi.</td>
                        </tr>
                    `;
                } else {
                    response.forEach((transaksi, index) => {
                        html += renderRow(transaksi, index);
                    });
                }
                $('#transaksi-body').html(html);
            },
            error: function (xhr) {
                console.error('Gagal mengambil data transaksi:', xhr.responseText);
            }
        });
    }

    function showFotoModal(imgUrl) {
        $('#fotoModalImg').attr('src', imgUrl);
        const fotoModal = new bootstrap.Modal(document.getElementById('fotoModal'));
        fotoModal.show();
    }

    $(document).ready(function () {
        refreshTransaksiTable(); // initial load
        setInterval(refreshTransaksiTable, 5000); 
    });
</script>
@endpush
