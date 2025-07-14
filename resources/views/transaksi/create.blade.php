@extends('layouts.mantis')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h4 class="mb-0">Form Jual Sampah</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('transaksi.store') }}" method="POST" class="p-3">
                @csrf

                {{-- Jenis Sampah --}}
                <div class="mb-3">
                    <label for="harga_id" class="form-label">Jenis Sampah</label>
                    <select name="harga_id" id="harga_id" class="form-control @error('harga_id') is-invalid @enderror">
                        <option value="">Pilih jenis sampah</option>
                        @foreach ($hargas as $harga)
                            <option value="{{ $harga->id }}" {{ old('harga_id') == $harga->id ? 'selected' : '' }}>
                                {{ $harga->jenis_sampah }}
                            </option>
                        @endforeach
                    </select>
                    @error('harga_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Berat --}}
                <div class="mb-3">
                    <label for="berat" class="form-label">Berat (kg)</label>
                    <input type="number" step="0.1" name="berat" id="berat" class="form-control @error('berat') is-invalid @enderror" value="{{ old('berat') }}" placeholder="Contoh: 1.5">
                    @error('berat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Upload Foto --}}
                <div class="mb-3">
                    <label for="foto_sampah_temp" class="form-label">Foto Sampah</label>
                    <input type="file" name="foto_sampah_temp" id="foto_sampah_temp" accept="image/*" class="form-control">
                    <input type="hidden" name="foto_sampah" id="foto_sampah" value="{{ old('foto_sampah') }}">
                    <div class="form-text">Jenis: jpeg, png, jpg, gif. Maks 5MB.</div>

                    {{-- Preview Foto --}}
                    <div id="foto-preview" class="mt-2" style="display: none;">
                        <img id="preview-image" src="" alt="Preview Foto" class="img-thumbnail" style="max-height: 200px;">
                    </div>

                    {{-- File sebelumnya jika gagal --}}
                    @if(old('foto_sampah'))
                        <div class="alert alert-info mt-2 p-2">
                            File sebelumnya: <strong>{{ old('foto_sampah') }}</strong>
                        </div>
                    @endif

                    @error('foto_sampah')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Alamat --}}
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat Penjemputan</label>
                    <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror" maxlength="500">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Waktu Penjemputan --}}
                <div class="mb-3">
                    <label for="waktu_penjemputan" class="form-label">Waktu Penjemputan</label>
                    <input type="datetime-local" name="waktu_penjemputan" id="waktu_penjemputan" class="form-control @error('waktu_penjemputan') is-invalid @enderror" value="{{ old('waktu_penjemputan') }}">
                    @error('waktu_penjemputan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol --}}
                <button type="submit" class="btn btn-success w-100">Ajukan Penjualan</button>
            </form>
        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Set batas waktu penjemputan (min: sekarang+1 jam, max: 2 tahun)
    const waktuInput = document.getElementById('waktu_penjemputan');
    const now = new Date();
    now.setHours(now.getHours() + 1);
    const minTime = now.toISOString().slice(0, 16);
    const maxTime = new Date(new Date().setFullYear(new Date().getFullYear() + 2)).toISOString().slice(0, 16);
    waktuInput.min = minTime;
    waktuInput.max = maxTime;
});

// Upload foto via AJAX
document.getElementById('foto_sampah_temp').addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (!file) return;

    if (file.size > 5 * 1024 * 1024) {
        alert('Ukuran maksimal 5MB');
        return;
    }

    const allowed = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
    if (!allowed.includes(file.type)) {
        alert('Format tidak didukung!');
        return;
    }

    const formData = new FormData();
    formData.append('foto_sampah', file);

    fetch("{{ route('transaksi.upload-foto') }}", {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            document.getElementById('foto_sampah').value = data.path;

            // Tampilkan preview
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('preview-image').src = e.target.result;
                document.getElementById('foto-preview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            alert(data.message || 'Upload gagal');
        }
    })
    .catch(err => {
        console.error(err);
        alert('Terjadi kesalahan saat upload.');
    });
});
</script>
@endsection
