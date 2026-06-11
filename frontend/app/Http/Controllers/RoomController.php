<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RoomController extends Controller
{
    public function index()
{
    $response = Http::withToken(
        session('token')
    )->get(
        'http://localhost:5000/api/rooms'
    );

    $rooms = $response->json();

    return view(
        'rooms.index',
        compact('rooms')
    );
}

public function create()
{
    return view('rooms.create');
}

public function store(Request $request)
{
    Http::withToken(
        session('token')
    )->post(
        'http://localhost:5000/api/rooms',
        [
            'nama_ruangan' =>
                $request->nama_ruangan,

            'lokasi' =>
                $request->lokasi,

            'keterangan' =>
                $request->keterangan
        ]
    );

    return redirect('/rooms');
}

public function edit($id)
{
    $response = Http::withToken(
        session('token')
    )->get(
        'http://localhost:5000/api/rooms'
    );

    $rooms = $response->json();

    $room = collect($rooms)
        ->firstWhere('id', $id);

    return view(
        'rooms.edit',
        compact('room')
    );
}

public function update(
    Request $request,
    $id
)
{
    Http::withToken(
        session('token')
    )->put(
        "http://localhost:5000/api/rooms/$id",
        [
            'nama_ruangan' =>
                $request->nama_ruangan,

            'lokasi' =>
                $request->lokasi,

            'keterangan' =>
                $request->keterangan
        ]
    );

    return redirect('/rooms');
}

public function destroy($id)
{
    Http::withToken(
        session('token')
    )->delete(
        "http://localhost:5000/api/rooms/$id"
    );

    return redirect('/rooms');
}
}