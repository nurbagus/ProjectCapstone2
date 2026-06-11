@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">Tambah Maintenance</h3>
        </div>
        <div class="card-body">

            <form method="POST" action="/maintenance/store">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Pilih Inventaris</label>
                    <select name="inventory_id" class="form-select" required>
                        <option value="" selected disabled>Pilih Inventaris</option>
                        @foreach($inventories as $inv)
                            <option value="{{ $inv['id'] }}">
                                {{ $inv['kode_inventaris'] }} - {{ $inv['nama_barang'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kondisi Sebelum</label>
                    <input type="text" name="kondisi_sebelum" class="form-control" placeholder="Kondisi Sebelum" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kondisi Sesudah</label>
                    <input type="text" name="kondisi_sesudah" class="form-control" placeholder="Kondisi Sesudah" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Catatan</label>
                    <textarea name="catatan" class="form-control" placeholder="Catatan" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pilih BHP</label>
                    <select name="bhp_id" class="form-select">
                        <option value="" selected disabled>Pilih BHP</option>
                        @foreach($bhp as $item)
                            <option value="{{ $item['id'] }}">
                                {{ $item['nama_barang'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah BHP</label>
                    <input type="number" name="jumlah" class="form-control" placeholder="Jumlah BHP">
                </div>

                <button type="submit" class="btn btn-success">
                    Simpan
                </button>

            </form>

        </div>
    </div>

</div>

@endsection