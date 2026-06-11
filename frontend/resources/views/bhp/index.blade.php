@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Barang Habis Pakai</h2>
        <div>
            <a href="/bhp/create" class="btn btn-primary btn-sm">Tambah BHP</a>
            <a href="/bhp/low-stock" class="btn btn-warning btn-sm">Low Stock</a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h3 class="card-title mb-0">Daftar BHP</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nama</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bhp as $item)
                    <tr>
                        <td>{{ $item['nama_barang'] }}</td>
                        <td>{{ $item['stok'] }}</td>
                        <td>{{ $item['satuan'] }}</td>
                        <td>
                            {{-- <a href="/bhp/{{ $item['id'] }}/stock-in" class="btn btn-success btn-sm">
                                Stok Masuk
                            </a>
                            <a href="/bhp/{{ $item['id'] }}/stock-out" class="btn btn-danger btn-sm">
                                Stok Keluar
                            </a> --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection