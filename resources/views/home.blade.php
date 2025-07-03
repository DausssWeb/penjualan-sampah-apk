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
                <div class="col-md-4"><strong>Plastik Botol</strong><br><span class="harga-sampah">Rp 3.000</span> <small>per kg</small></div>
                <div class="col-md-4"><strong>Kaleng</strong><br><span class="harga-sampah">Rp 4.000</span> <small>per kg</small></div>
                <div class="col-md-4"><strong>Logam</strong><br><span class="harga-sampah">Rp 5.000</span> <small>per kg</small></div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4"><strong>Kertas</strong><br><span class="harga-sampah">Rp 2.500</span> <small>per kg</small></div>
                <div class="col-md-4"><strong>Kardus</strong><br><span class="harga-sampah">Rp 2.000</span> <small>per kg</small></div>
                <div class="col-md-4"><strong>Botol Kaca</strong><br><span class="harga-sampah">Rp 1.500</span> <small>per kg</small></div>
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
