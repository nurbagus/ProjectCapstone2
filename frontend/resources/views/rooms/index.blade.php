@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Ruangan</h2>

        <a href="/rooms/create" class="btn btn-primary btn-sm">
            + Tambah Ruangan
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h3 class="card-title mb-0">Daftar Ruangan</h3>
        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nama Ruangan</th>
                        <th>Lokasi</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($rooms as $room)
                    <tr>
                        <td>{{ $room['nama_ruangan'] }}</td>
                        <td>{{ $room['lokasi'] }}</td>
                        <td>{{ $room['keterangan'] }}</td>
                        <td>
                            <a href="/rooms/edit/{{ $room['id'] }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <a href="/rooms/delete/{{ $room['id'] }}" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Yakin ingin menghapus ruangan ini?')">
                                Hapus
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection