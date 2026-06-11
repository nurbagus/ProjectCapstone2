@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2 class="mb-3">Stok Menipis</h2>

    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h3 class="card-title mb-0">Daftar Barang Stok Menipis</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Barang</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr @if($item['stok'] <= 5) class="table-danger" @endif>
                        <td>{{ $item['nama_barang'] }}</td>
                        <td>{{ $item['stok'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection