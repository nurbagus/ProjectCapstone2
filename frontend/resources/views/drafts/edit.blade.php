@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Edit Draft Pengadaan</h2>
        <a href="/drafts" class="btn btn-secondary btn-sm">← Kembali</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h3 class="card-title mb-0">Form Edit Draft</h3>
        </div>

        <div class="card-body">

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/drafts/{{ $draft['id'] }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="judul" class="form-label fw-semibold">Judul</label>
                    <input 
                        type="text" 
                        name="judul" 
                        id="judul"
                        class="form-control @error('judul') is-invalid @enderror"
                        value="{{ old('judul', $draft['judul']) }}"
                        required
                    >
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tahun" class="form-label fw-semibold">Tahun</label>
                    <input 
                        type="number" 
                        name="tahun" 
                        id="tahun"
                        class="form-control @error('tahun') is-invalid @enderror"
                        value="{{ old('tahun', $draft['tahun']) }}"
                        min="2000"
                        max="2099"
                        required
                    >
                    @error('tahun')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="keterangan" class="form-label fw-semibold">Keterangan</label>
                    <textarea 
                        name="keterangan" 
                        id="keterangan"
                        class="form-control @error('keterangan') is-invalid @enderror"
                        rows="4"
                    >{{ old('keterangan', $draft['keterangan'] ?? '') }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        Simpan Perubahan
                    </button>
                    <a href="/drafts" class="btn btn-outline-secondary">Batal</a>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection