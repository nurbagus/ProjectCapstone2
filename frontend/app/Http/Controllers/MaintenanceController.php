<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MaintenanceController extends Controller
{
    public function index()
{
    $maintenances = Http::withToken(
        session('token')
    )->get(
        'http://localhost:5000/api/maintenance'
    )->json();

    return view(
        'maintenance.index',
        compact('maintenances')
    );
}

public function create()
{
    $inventories = Http::withToken(
        session('token')
    )->get(
        'http://localhost:5000/api/inventories'
    )->json();

    $bhp = Http::withToken(
        session('token')
    )->get(
        'http://localhost:5000/api/bhp'
    )->json();

    return view(
        'maintenance.create',
        compact(
            'inventories',
            'bhp'
        )
    );
}

public function store(Request $request)
{
    Http::withToken(
        session('token')
    )->post(
        'http://localhost:5000/api/maintenance',
        [
            'inventory_id' =>
                $request->inventory_id,

            'tanggal' =>
                $request->tanggal,

            'kondisi_sebelum' =>
                $request->kondisi_sebelum,

            'kondisi_sesudah' =>
                $request->kondisi_sesudah,

            'catatan' =>
                $request->catatan,

            'materials' => [

                [
                    'bhp_id' =>
                        $request->bhp_id,

                    'jumlah' =>
                        $request->jumlah
                ]

            ]
        ]
    );

    return redirect('/maintenance');
}

public function show($id)
{
    $maintenance = Http::withToken(
        session('token')
    )->get(
        "http://localhost:5000/api/maintenance/$id"
    )->json();

    return view(
        'maintenance.show',
        compact('maintenance')
    );
}
}

