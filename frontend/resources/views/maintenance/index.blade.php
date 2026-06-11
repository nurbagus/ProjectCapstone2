@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Maintenance</h2>

        <a href="/maintenance/create" class="btn btn-primary btn-sm">
            + Tambah Maintenance
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h3 class="card-title mb-0">Daftar Maintenance</h3>
        </div>
        <div class="card-body table-responsive">

            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Barang</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($maintenances as $m)
                    <tr>
                        <td>{{ $m['nama_barang'] }}</td>
                        <td>{{ $m['tanggal'] }}</td>
                        <td>
                            <a href="/maintenance/{{ $m['id'] }}" class="btn btn-info btn-sm">
                                Detail
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