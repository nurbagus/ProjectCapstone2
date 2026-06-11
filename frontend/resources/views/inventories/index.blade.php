@extends('layouts.app')

@section('content')

<div class="container">
    <h2 class="mb-3">Data Inventaris</h2>

    <a href="/inventories/create" class="btn btn-primary mb-3">
        Tambah Inventaris
    </a>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">Data Inventaris</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Kondisi</th>
                        <th>Ruangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inventories as $item)
                    <tr>
                        <td>{{ $item['kode_inventaris'] }}</td>
                        <td>{{ $item['nama_barang'] }}</td>
                        <td>{{ $item['kondisi'] }}</td>
                        <td>{{ $item['nama_ruangan'] }}</td>
                        <td>
                            <a href="/inventories/{{ $item['id'] }}" class="btn btn-info btn-sm">
                                Detail
                            </a>
                            
                            <form action="/inventories/{{ $item['id'] }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection