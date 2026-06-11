@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Draft Pengadaan</h2>

        <a href="/drafts/create" class="btn btn-primary btn-sm">
            + Buat Draft
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h3 class="card-title mb-0">Daftar Draft Pengadaan</h3>
        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        
                        <th>Judul</th>
                        <th>Tahun</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($drafts as $draft)
                    <tr>
                        <td>{{ $draft['judul'] }}</td>
                        <td>{{ $draft['tahun'] }}</td>
                        <td>
                            <span class="badge 
                                @if($draft['status'] == 'draft') bg-warning
                                @elseif($draft['status'] == 'submitted') bg-info
                                @elseif($draft['status'] == 'approved') bg-success
                                @elseif($draft['status'] == 'review') bg-secondary
                                @elseif($draft['status'] == 'locked') bg-dark
                                @else bg-secondary
                                @endif">
                                {{ ucfirst($draft['status']) }}
                            </span>
                        </td>

                        <td>
                            {{-- Hanya bisa kelola item jika status draft atau submitted --}}
                            @if(in_array($draft['status'], ['draft', 'submitted']))
                                <a href="/drafts/{{ $draft['id'] }}/items" class="btn btn-info btn-sm">
                                    Kelola Item
                                </a>
                            @else
                                <span class="text-muted">Tidak bisa kelola</span>
                            @endif

                            {{-- Tombol submit hanya muncul untuk draft --}}
                            @if($draft['status'] == 'draft')
                                <form action="/drafts/{{ $draft['id'] }}/submit" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm"
                                        onclick="return confirm('Submit draft ini?')">
                                        Submit
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection