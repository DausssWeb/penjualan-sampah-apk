@extends('layouts.mantis')

@section('content')
    <div class="card-header">
        <h3 class="card-title">Data Pengguna</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role?->role_name }}</td>
                        <td><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#roleModal{{ $user->id }}">
                                Ganti Role
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@foreach ($users as $user)
<!-- Modal Ganti Role -->
<div class="modal fade" id="roleModal{{ $user->id }}" tabindex="-1" aria-labelledby="roleModalLabel{{ $user->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="roleModalLabel{{ $user->id }}">Ganti Role</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="my-2 text-center text-secondary">Mengganti Role dapat merubah hak akses dari user, klik Ganti Role untuk melanjutkan perintah ini</p>
        <form action="{{ route('users.update-role', $user->id) }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <div>
                <label for="role_id_{{ $user->id }}">Tentukan Role Akses</label>
                <select name="role_id" id="role_id_{{ $user->id }}" class="form-control">
                    <option value="">Pilih Role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary mt-2 w-100">Ganti Role</button>
            </div>
        </form>
      </div>      
    </div>
  </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="deleteModalLabel{{ $user->id }}">Hapus Data Pengguna</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-center text-secondary">Apakah Anda yakin ingin menghapus pengguna <strong>{{ $user->name }}</strong>? Tindakan ini tidak dapat dibatalkan.</p>
        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="d-grid">
                <button type="submit" class="btn btn-danger">Hapus</button>
                <button type="button" class="btn btn-secondary mt-2" data-bs-dismiss="modal">Batal</button>
            </div>
        </form>
      </div>      
    </div>
  </div>
</div>
@endforeach

{{-- @foreach ($users as $user)
    <!-- Modal -->
<div class="modal fade" id="roleModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ganti Role</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="my-2 text-center text-secondary">Mengganti Role dapat merubah hak akses dari user, klik Ganti Role untuk melanjutkan perintah ini</p>
        <form action="{{ route('users.update-role', $user->id) }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <div>
                <label for="role_id">Tentukan Role Akses</label>
                <select name="role_id" id="role_id" class="form-control">
                    <option value="">Pilih Role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary mt-2 w-100">Ganti Role</button>
            </div>
        </form>
      </div>      
    </div>
  </div>
</div>
<div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Data Pengguna</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="my-2 text-center text-secondary">Mengganti Role dapat merubah hak akses dari user, klik Ganti Role untuk melanjutkan perintah ini</p>
        <form action="{{ route('users.update-role', $user->id) }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <div>
                <label for="role_id">Tentukan Role Akses</label>
                <select name="role_id" id="role_id" class="form-control">
                    <option value="">Pilih Role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary mt-2 w-100">Ganti Role</button>
            </div>
        </form>
      </div>      
    </div>
  </div>
</div>
@endforeach --}}
@endsection
