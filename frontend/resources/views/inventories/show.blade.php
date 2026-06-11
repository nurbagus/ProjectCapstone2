@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">{{ $inventory['nama_barang'] }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Kode:</strong> {{ $inventory['kode_inventaris'] }}</p>
            <p><strong>Kondisi:</strong> {{ $inventory['kondisi'] }}</p>

            @if(!empty($inventory['foto']))
                <div class="mb-3">
                    <img src="http://localhost:5000/uploads/inventory/{{ $inventory['foto'] }}"
                         class="img-fluid rounded"
                         style="max-width: 300px;"
                         alt="{{ $inventory['nama_barang'] }}">
                </div>
            @endif

            <hr>

            <form method="POST" action="/inventories/{{ $inventory['id'] }}/upload" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="foto" class="form-label">Upload Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">
                    Upload Foto
                </button>
            </form>
        </div>
    </div>
</div>

@endsection