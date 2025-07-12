@extends('layouts.mantis')

@section('content')
<div class="container mt-4">
        <div class="card-header">
            <h3 class="mb-1">Form Jual Sampah</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('transaksi.store') }}" method="POST" enctype="multipart/form-data" class="card shadow p-4">
                @csrf

                <div class="mb-3">
                    <label for="jenis_sampah" class="form-label">Jenis Sampah</label>
                    <select name="jenis_sampah" id="jenis_sampah" class="form-control @error('jenis_sampah') is-invalid @enderror">
                        <option value="">Pilih jenis sampah</option>
                        <option value="Plastik Botol" {{ old('jenis_sampah') == 'Plastik Botol' ? 'selected' : '' }}>Plastik Botol</option>
                        <option value="Kaleng" {{ old('jenis_sampah') == 'Kaleng' ? 'selected' : '' }}>Kaleng</option>
                        <option value="Kertas" {{ old('jenis_sampah') == 'Kertas' ? 'selected' : '' }}>Kertas</option>
                        <option value="Botol Kaca" {{ old('jenis_sampah') == 'Botol Kaca' ? 'selected' : '' }}>Botol Kaca</option>
                        <option value="Kardus" {{ old('jenis_sampah') == 'Kardus' ? 'selected' : '' }}>Kardus</option>
                        <option value="Logam" {{ old('jenis_sampah') == 'Logam' ? 'selected' : '' }}>Logam</option>
                    </select>
                    @error('jenis_sampah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror 
                </div>

                <div class="mb-3">
                    <label for="berat" class="form-label">Berat (kg)</label>
                    <input type="number" step="0.01" name="berat" id="berat" class="form-control @error('berat') is-invalid @enderror" value="{{ old('berat') }}" placeholder="Masukkan berat sampah (kg)">
                    @error('berat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="foto_sampah" class="form-label">Foto Sampah</label>
                    <input type="file" name="foto_sampah" id="foto_sampah" class="form-control @error('foto_sampah') is-invalid @enderror" accept="image/*">
                    @error('foto_sampah')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukan Alamat Lengkap">{{ old('alamat') }}</textarea>
                    @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="waktu_penjemputan" class="form-label">Waktu Penjemputan</label>
                    <input type="datetime-local" name="waktu_penjemputan" id="waktu_penjemputan" class="form-control @error('waktu_penjemputan') is-invalid @enderror" value="{{ old('waktu_penjemputan') }}" min="{{ date('Y-m-d\TH:i') }}" max="{{ date('Y-12-31\T23:59', strtotime('+1 year')) }}">
                    @error('waktu_penjemputan')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Ajukan</button>
            </form>
        </div>
</div>
@endsection