@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2 class="mb-3">Item Draft: {{ $draft['judul'] }}</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">Tambah Item Draft</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="/drafts/{{ $draft['id'] }}/items/store">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" placeholder="Nama Barang" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" placeholder="Jumlah" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga Satuan</label>
                    <input type="number" name="harga" class="form-control" placeholder="Harga" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Link Pembelian</label>
                    <input type="text" name="link_pembelian" class="form-control" placeholder="Link Pembelian (opsional)">
                </div>

                <button type="submit" class="btn btn-success">
                    Tambah Item
                </button>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h3 class="card-title mb-0">Daftar Item</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($draft['items'] as $item)
                    <tr>
                        <td>{{ $item['nama_barang'] }}</td>
                        <td>{{ $item['jumlah'] }}</td>
                        <td>Rp {{ number_format($item['harga_satuan'], 0, ',', '.') }}</td>
                        <td>
                            @if($draft['status'] == 'draft')
                                <a href="/drafts/items/{{ $item['id'] }}/edit"
                                   class="btn btn-warning btn-sm me-1">
                                    Edit
                                </a>
                                <form action="/drafts/items/{{ $item['id'] }}/delete"
                                      method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus item ini?')">
                                        Hapus
                                    </button>
                                </form>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @if($draft['status'] == 'draft')
            <div class="mt-3">
                <form action="/drafts/{{ $draft['id'] }}/submit" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success"
                        onclick="return confirm('Submit draft ini ke Kaprodi?')">
                        Submit Draft
                    </button>
                </form>
            </div>
            @endif

        </div>
    </div>

</div>

@endsection