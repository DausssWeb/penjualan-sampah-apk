@extends('layouts.mantis')

@section('content')
    <div class="card-header">
        <h3 class="card-title">Data Transaksi</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pengguna</th>
                    <th>Jenis sampah</th>
                    <th>Berat</th>
                    <th>Total Harga</th>
                    <th>Tanggal Transaksi</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($users as $index => $user) --}}
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                {{-- @endforeach --}}
            </tbody>
        </table>
    </div>
@endsection
