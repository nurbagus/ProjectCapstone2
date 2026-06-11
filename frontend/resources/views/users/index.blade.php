@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data User</h2>
        <a href="/users/create" class="btn btn-primary btn-sm">
            + Tambah User
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h3 class="card-title mb-0">Daftar User</h3>
        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                        @if($user['id'] != 2) {{-- id 2 biasanya super admin --}}
                        <tr>
                            <td>{{ $user['id'] }}</td>
                            <td>{{ $user['nama'] }}</td>
                            <td>{{ $user['email'] }}</td>
                            <td>
                                @php
                                    $roleBadge = 'secondary';
                                    if($user['role']=='kepala_lab') $roleBadge='warning';
                                    elseif($user['role']=='kaprodi') $roleBadge='info';
                                    elseif($user['role']=='staf_admin') $roleBadge='primary';
                                    elseif($user['role']=='staf_lab') $roleBadge='success';
                                @endphp
                                <span class="badge bg-{{ $roleBadge }}">
                                    {{ ucfirst(str_replace('_',' ',$user['role'])) }}
                                </span>
                            </td>
                            <td>
                                <a href="/users/edit/{{ $user['id'] }}" class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <a href="/users/delete/{{ $user['id'] }}" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin ingin menghapus user ini?')">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

</div>

@endsection