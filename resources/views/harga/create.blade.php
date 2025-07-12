@extends('layouts.mantis')

@section('content')
    <div class="container mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mb-1">Form Harga</h3>
            <div>
                <a href="{{ route('harga.index') }}" class="btn btn-success">Kembali</a>
            </div>
        </div>
        <div class="card-body">
        <form action="{{ route('harga.store') }}" method="POST" class="card shadow p-4">
        @csrf
        <div class="mb-3">
            <label for="jenis_sampah">Jenis Sampah</label>
            <input type="text" name="jenis_sampah" id="jenis_sampah" 
            value="{{ old('jenis_sampah') }}" 
            class="form-control @error('jenis_sampah') is-invalid @enderror" autofocus>
        @error('jenis_sampah')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        </div>

        <div class="mb-3">
            <label for="hargaPerKg">Harga Per Kg</label>
            <input type="number" name="harga" id="harga" 
            value="{{ old('harga') }}" 
            class="form-control @error('harga') is-invalid @enderror">
        @error('harga')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror    
</div>

        <div class="my-2 d-flex justify-content-end">
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
        </form>
    </div>
</div>
@endsection