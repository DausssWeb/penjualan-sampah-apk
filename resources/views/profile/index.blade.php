@extends('layouts.mantis')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="mb-4">Profil Saya</h3>

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="mb-2">
                        <strong>Nama:</strong> {{ $user->name }}
                    </div>
                    <div class="mb-2">
                        <strong>Email:</strong> {{ $user->email }}
                    </div>
                    <div class="mb-2">
                        <strong>No Telepon:</strong> {{ $profile->no_telp ?? '-' }}
                    </div>
                    <div class="mb-2">
                        <strong>Alamat:</strong> {{ $profile->alamat ?? '-' }}
                    </div>
                </div>
                <div class="card-footer text-end">
                    @if ($profile)
                        <a href="{{ route('profile.edit', $profile->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit Profil
                        </a>
                    @else
                        <a href="{{ route('profile.create') }}" class="btn btn-success">
                            <i class="fas fa-edit"></i> Ubah Profil
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
