@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2 class="mb-3">Review Draft: {{ $draft['judul'] }}</h2>

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h3 class="card-title mb-0">Daftar Item Draft</h3>
        </div>
        <div class="card-body table-responsive">

            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($draft['items'] as $item)
                    <tr>
                        <td>{{ $item['nama_barang'] }}</td>
                        <td>{{ $item['jumlah'] }}</td>
                        <td>Rp {{ number_format($item['harga_satuan'], 0, ',', '.') }}</td>
                        <td>
                            @php
                                $status = $item['status_review'];
                                $badge = 'secondary';
                                if ($status == 'pending') $badge = 'warning';
                                elseif ($status == 'approved') $badge = 'success';
                                elseif ($status == 'rejected') $badge = 'danger';
                            @endphp
                            <span class="badge bg-{{ $badge }}">{{ ucfirst($status) }}</span>
                        </td>
                        <td>
                            @if($item['status_review'] == 'pending')
                                <a href="/reviews/item/{{ $item['id'] }}/approve" 
                                   class="btn btn-success btn-sm me-1"
                                   onclick="return confirm('Approve item ini?')">
                                   Approve
                                </a>
                                <a href="/reviews/item/{{ $item['id'] }}/reject" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Reject item ini?')">
                                   Reject
                                </a>
                            @else
                                <span class="text-muted">Sudah {{ $status }}</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-3">
                <a href="/reviews/draft/{{ $draft['id'] }}/finalize" 
                   class="btn btn-primary"
                   onclick="return confirm('Finalisasi draft ini? Semua item harus sudah di-approve/reject.')">
                   Finalisasi Draft
                </a>
            </div>

        </div>
    </div>

</div>

@endsection