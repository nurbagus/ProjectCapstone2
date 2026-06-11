@extends('layouts.app')

@section('content')

<!-- Bootstrap CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Tambah Inventaris</h5>
                </div>

                <div class="card-body">

                    <form method="POST" action="/inventories/store">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" placeholder="Nama Barang">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" placeholder="Jumlah">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="number" name="harga" class="form-control" placeholder="Harga">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ruangan</label>
                            <select name="room_id" class="form-select">
                                @foreach($rooms as $room)
                                    <option value="{{ $room['id'] }}">
                                        {{ $room['nama_ruangan'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Pembelian</label>
                            <input type="date" name="tanggal_pembelian" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Penerimaan</label>
                            <input type="date" name="tanggal_penerimaan" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            Simpan
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection