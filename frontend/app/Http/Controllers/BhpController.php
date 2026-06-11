<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BhpController extends Controller
{
    public function index()
{
    $bhp = Http::withToken(
        session('token')
    )->get(
        'http://localhost:5000/api/bhp'
    )->json();

    return view(
        'bhp.index',
        compact('bhp')
    );
}

public function create()
{
    return view('bhp.create');
}

public function store(Request $request)
{
    Http::withToken(
        session('token')
    )->post(
        'http://localhost:5000/api/bhp',
        [
            'nama_barang' =>
                $request->nama_barang,

            'stok' =>
                $request->stok,

            'satuan' =>
                $request->satuan,

            'harga' =>
                $request->harga,

            'minimal_stok' =>
                $request->minimal_stok
        ]
    );

    return redirect('/bhp');
}

public function stockInForm($id)
{
    return view(
        'bhp.stock-in',
        compact('id')
    );
}

public function stockIn(
    Request $request,
    $id
)
{
    Http::withToken(
        session('token')
    )->put(
        "http://localhost:5000/api/bhp/$id/in",
        [
            'jumlah' =>
                $request->jumlah,

            'keterangan' =>
                $request->keterangan
        ]
    );

    return redirect('/bhp');
}

public function stockOutForm($id)
{
    return view(
        'bhp.stock-out',
        compact('id')
    );
}

public function stockOut(
    Request $request,
    $id
)
{
    Http::withToken(
        session('token')
    )->put(
        "http://localhost:5000/api/bhp/$id/out",
        [
            'jumlah' =>
                $request->jumlah,

            'keterangan' =>
                $request->keterangan
        ]
    );

    return redirect('/bhp');
}

public function lowStock()
{
    $items = Http::withToken(
        session('token')
    )->get(
        'http://localhost:5000/api/bhp/low-stock'
    )->json();

    return view(
        'bhp.low-stock',
        compact('items')
    );
}
}