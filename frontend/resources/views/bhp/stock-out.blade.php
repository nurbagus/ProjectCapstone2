@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-danger text-white">
            <h3 class="card-title mb-0">Stok Keluar</h3>
        </div>

        <div class="card-body">

            <form method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <input
                        type="number"
                        name="jumlah"
                        class="form-control"
                        placeholder="Masukkan jumlah stok yang keluar"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <input
                        type="text"
                        name="keterangan"
                        class="form-control"
                        placeholder="Keterangan (opsional)">
                </div>

                <button type="submit" class="btn btn-danger">
                    Kurangi Stok
                </button>

            </form>

        </div>
    </div>

</div>

@endsection