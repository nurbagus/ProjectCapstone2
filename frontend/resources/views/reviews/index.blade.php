@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2 class="mb-3">Review Draft Pengadaan</h2>

    {{-- Tabel Draft Aktif --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white">
            <h3 class="card-title mb-0">Daftar Draft</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($drafts as $draft)
                    <tr>
                        <td>{{ $draft['judul'] }}</td>
                        <td>
                            @php
                                $status = $draft['status'];
                                $badge = 'secondary';
                                if ($status == 'draft') $badge = 'warning';
                                elseif ($status == 'submitted') $badge = 'info';
                                elseif ($status == 'review') $badge = 'primary';
                            @endphp
                            <span class="badge bg-{{ $badge }}">{{ ucfirst($status) }}</span>
                        </td>
                        <td>
                            @if($draft['status'] != 'locked')
                                <a href="/reviews/{{ $draft['id'] }}" class="btn btn-info btn-sm">
                                    Review
                                </a>
                            @else
                                <span class="text-muted">Tidak bisa direview</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Tidak ada draft aktif</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tabel History --}}
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h3 class="card-title mb-0">History Draft</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-secondary">
                    <tr>
                        <th>Judul</th>
                        <th>Dibuat Oleh</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($histories as $history)
                    <tr>
                        <td>{{ $history['judul'] }}</td>
                        <td>{{ $history['nama'] }}</td>
                        <td>
                            @php
                                $status = $history['status'];
                                $badge = $status == 'locked' ? 'dark' : 'success';
                            @endphp
                            <span class="badge bg-{{ $badge }}">{{ ucfirst($status) }}</span>
                        </td>
                        <td>
                            <a href="/reviews/{{ $history['id'] }}" class="btn btn-secondary btn-sm">
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada history</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection