@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h3 class="card-title mb-0">Tambah BHP</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="/bhp/store">
                @csrf

                <div class="mb-3">
                    <label for="nama_barang" class="form-label">Nama Barang</label>
                    <input type="text" name="nama_barang" id="nama_barang" class="form-control" placeholder="Nama Barang" required>
                </div>

                <div class="mb-3">
                    <label for="stok" class="form-label">Stok Awal</label>
                    <input type="number" name="stok" id="stok" class="form-control" placeholder="Stok Awal" required>
                </div>

                <div class="mb-3">
                    <label for="satuan" class="form-label">Satuan</label>
                    <input type="text" name="satuan" id="satuan" class="form-control" placeholder="Satuan" required>
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control" placeholder="Harga" required>
                </div>

                <div class="mb-3">
                    <label for="minimal_stok" class="form-label">Minimal Stok</label>
                    <input type="number" name="minimal_stok" id="minimal_stok" class="form-control" placeholder="Minimal Stok" required>
                </div>

                <button type="submit" class="btn btn-success">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>

@endsection