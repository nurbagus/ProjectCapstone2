@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">Tambah Ruangan</h3>
        </div>

        <div class="card-body">

            <form method="POST" action="/rooms/store">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Ruangan</label>
                    <input
                        type="text"
                        name="nama_ruangan"
                        class="form-control"
                        placeholder="Nama Ruangan"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input
                        type="text"
                        name="lokasi"
                        class="form-control"
                        placeholder="Lokasi"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea
                        name="keterangan"
                        class="form-control"
                        rows="3"
                        placeholder="Keterangan (opsional)"></textarea>
                </div>

                <button type="submit" class="btn btn-success">
                    Simpan
                </button>

            </form>

        </div>
    </div>

</div>

@endsection