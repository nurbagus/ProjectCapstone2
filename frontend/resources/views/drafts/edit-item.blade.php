@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h3 class="card-title mb-0">Edit Item</h3>
        </div>

        <div class="card-body">

            <form method="POST" action="/drafts/items/{{ $item['id'] }}/update">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Barang</label>
                    <input
                        type="text"
                        name="nama_barang"
                        class="form-control"
                        value="{{ $item['nama_barang'] }}"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <input
                        type="number"
                        name="jumlah"
                        class="form-control"
                        value="{{ $item['jumlah'] }}"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga Satuan</label>
                    <input
                        type="number"
                        name="harga_satuan"
                        class="form-control"
                        value="{{ $item['harga_satuan'] }}"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Link Pembelian</label>
                    <input
                        type="text"
                        name="link_pembelian"
                        class="form-control"
                        value="{{ $item['link_pembelian'] ?? '' }}"
                        placeholder="Link Pembelian (opsional)">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        Simpan
                    </button>
                    <a href="/drafts/{{ $item['draft_id'] }}" class="btn btn-secondary">
                        Batal
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection