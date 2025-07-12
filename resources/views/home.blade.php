{{-- @extends('layouts.mantis')

@section('content')
<div class="card-header">{{ __('Dashboard') }}</div>
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        {{ __('You are logged in!') }}
    </div>
</div>
@endsection --}}
@extends('layouts.mantis')

@section('content')
<div class="container-fluid">
    <div class="p-4">
        <div class="welcome-box p-3 rounded">
            <h3>Selamat Datang {{ auth()->user()->name }}!</h3>
        </div>
        <p class="mt-3">
            Mari bersama-sama menjaga lingkungan dengan mendaur ulang sampah dan mendapatkan penghasilan tambahan. Setiap sampah yang anda jual berkontribusi untuk lingkungan yang jauh lebih baik!
        </p>
        <h5>Berikut harga sampah saat ini:</h5>
        <div class="bg-light p-3 rounded">
            <div class="row">
                @foreach ($hargas as $item)
                    <div class="col-md-4"><strong>{{ $item->jenis_sampah }}</strong><br><span class="harga-sampah">Rp {{ number_format($item->hargaPerKg) }}</span> <small>per kg</small></div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
.welcome-box {
    background-color: #4ade80; /* Sama dengan navbar-green & sidebar-green */
    color: white;
}

.harga-sampah {
    color: #4ade80; /* Sama dengan navbar-green & sidebar-green */
    font-weight: bold;
}
</style>

@endsection
