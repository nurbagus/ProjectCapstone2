<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InventoryController extends Controller
{
    public function index()
{
    $response = Http::withToken(
        session('token')
    )->get(
        'http://localhost:5000/api/inventories'
    );

    $inventories =
        $response->json();

    return view(
        'inventories.index',
        compact('inventories')
    );
}

public function create()
{
    $rooms = Http::withToken(
        session('token')
    )->get(
        'http://localhost:5000/api/rooms'
    )->json();

    // dd($rooms);

    return view(
        'inventories.create',
        compact('rooms')
    );
}

public function store(Request $request)
{
    Http::withToken(
        session('token')
    )->post(
        'http://localhost:5000/api/inventories',
        [
            'nama_barang' =>
                $request->nama_barang,

            'jumlah' =>
                $request->jumlah,

            'harga_satuan' =>
                $request->harga,

            'room_id' =>
                $request->room_id,

            'tanggal_pembelian' =>
                $request->tanggal_pembelian,

            'tanggal_penerimaan' =>
                $request->tanggal_penerimaan
        ]
    );

    return redirect('/inventories');
}

public function show($id)
{
    $inventory = Http::withToken(
        session('token')
    )->get(
        "http://localhost:5000/api/inventories/$id"
    )->json();

    return view(
        'inventories.show',
        compact('inventory')
    );
}

public function uploadPhoto(
    Request $request,
    $id
)
{
    Http::withToken(
        session('token')
    )
    ->attach(
        'foto',
        fopen(
            $request->file('foto')
            ->getRealPath(),
            'r'
        ),
        $request->file('foto')
        ->getClientOriginalName()
    )
    ->post(
        "http://localhost:5000/api/inventories/$id/upload"
    );

    return back();
}
}