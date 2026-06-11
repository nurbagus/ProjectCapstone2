@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">Maintenance #{{ $maintenance['id'] }}</h3>
        </div>
        <div class="card-body">

            <p><strong>Tanggal:</strong> {{ $maintenance['tanggal'] }}</p>
            <p><strong>Kondisi Sebelum:</strong> {{ $maintenance['kondisi_sebelum'] }}</p>
            <p><strong>Kondisi Sesudah:</strong> {{ $maintenance['kondisi_sesudah'] }}</p>
            <p><strong>Catatan:</strong> {{ $maintenance['catatan'] }}</p>

        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h3 class="card-title mb-0">BHP Digunakan</h3>
        </div>
        <div class="card-body">
            @if(count($maintenance['materials']) > 0)
                <ul class="list-group">
                    @foreach($maintenance['materials'] as $item)
                        <li class="list-group-item">
                            {{ $item['nama_barang'] }} – {{ $item['jumlah'] }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">Tidak ada BHP yang digunakan.</p>
            @endif
        </div>
    </div>

</div>

@endsection