@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">Buat Draft Pengadaan</h3>
        </div>

        <div class="card-body">

            <form method="POST" action="/drafts/store">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Judul Draft</label>
                    <input
                        type="text"
                        name="judul"
                        class="form-control"
                        placeholder="Masukkan judul draft"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tahun</label>
                    <input
                        type="number"
                        name="tahun"
                        value="2026"
                        class="form-control"
                        required>
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan Draft
                </button>

            </form>

        </div>
    </div>

</div>

@endsection