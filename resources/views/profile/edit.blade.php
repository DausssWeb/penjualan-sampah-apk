@extends('layouts.blank')

@section('content')
<div class="container mt-4">
    <div class="card">
    <div class="card-header">
        <h3 class="mb-1">Edit Profil</h3>
    </div>
    <div class="card-body">
    <form action="{{ route('profile.update', $profile->id) }}" method="POST" class="card shadow p-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" id="name"
                value="{{ old('name', $user->name) }}"
                class="form-control @error('name') is-invalid @enderror"
                placeholder="Masukkan nama lengkap">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" class="form-control" value="{{ $user->email }}" readonly>
        </div>

        <div class="mb-3">
            <label for="no_telp" class="form-label">No Telepon</label>
            <input type="text" name="no_telp" id="no_telp"
                value="{{ old('no_telp', $profile->no_telp) }}"
                class="form-control @error('no_telp') is-invalid @enderror"
                placeholder="Masukkan nomor telepon">
            @error('no_telp')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" id="alamat"
                class="form-control @error('alamat') is-invalid @enderror"
                placeholder="Masukkan alamat lengkap"
                rows="3">{{ old('alamat', $profile->alamat) }}</textarea>
            @error('alamat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-end">
            <a href="{{ route('profile.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Perbarui Profil</button>
        </div>
    </form>
    </div>
    </div>
</div>
@endsection
