@extends('layouts.mantis')

@section('content')
    <div class="card-header">
        <h3 class="card-title">Harga Sampah</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Sampah</th>
                    <th>Harga per kg</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($users as $index => $user) --}}
                    <tr>
                        {{-- <td>{{ $index + 1 }}</td> --}}
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                {{-- @endforeach --}}
            </tbody>
        </table>
    </div>
@endsection
