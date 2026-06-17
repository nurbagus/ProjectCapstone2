<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProcurementController extends Controller
{
    public function index()
{
    $response = Http::withToken(
        session('token')
    )->get(
        'http://localhost:5000/api/drafts'
    );

    $drafts = $response->json();

    return view(
        'drafts.index',
        compact('drafts')
    );
}

public function create()
{
    return view('drafts.create');
}

public function store(Request $request)
{
    Http::withToken(
        session('token')
    )->post(
        'http://localhost:5000/api/drafts',
        [
            'judul' =>
                $request->judul,

            'tahun' =>
                $request->tahun
        ]
    );

    return redirect('/drafts');
}

public function items($id)
{
    // Ambil draft
    $response = Http::withToken(session('token'))
        ->get("http://localhost:5000/api/drafts/$id");

    $draft = $response->json();

    if (!$draft) {
        abort(404, 'Draft tidak ditemukan');
    }

    // Ambil items draft
    $itemsResponse = Http::withToken(session('token'))
        ->get("http://localhost:5000/api/drafts/$id/items");

    $items = $itemsResponse->json();

    // Tambahkan items ke draft supaya Blade bisa loop
    $draft['items'] = $items;

    return view('drafts.items', compact('draft'));
}

public function storeItem(
    Request $request,
    $id
)
{
    Http::withToken(
        session('token')
    )->post(
        "http://localhost:5000/api/drafts/$id/items",
        [
            'nama_barang' =>
                $request->nama_barang,

            'jumlah' =>
                $request->jumlah,

            'harga_satuan' =>
                $request->harga,

            'link_pembelian' =>
                $request->link_pembelian
        ]
    );

    return redirect(
        "/drafts/$id/items"
    );
}

public function edit($id)
{
    $response = Http::withToken(session('token'))
        ->get("http://localhost:5000/api/drafts/$id");

    $draft = $response->json();

    if (!$draft || $response->failed()) {
        abort(404, 'Draft tidak ditemukan');
    }

    if (!in_array($draft['status'], ['draft', 'submitted'])) {
        return redirect('/drafts')
            ->with('error', 'Draft ini tidak bisa diedit.');
    }

    return view('drafts.edit', compact('draft'));
}

public function update(Request $request, $id)
{
    $response = Http::withToken(session('token'))
        ->put("http://localhost:5000/api/drafts/$id", [
            'judul' => $request->judul,
            'tahun' => $request->tahun,
        ]);

    if ($response->failed()) {
        return back()
            ->withInput()
            ->with('error', 'Gagal menyimpan perubahan.');
    }

    return redirect('/drafts')
        ->with('success', 'Draft berhasil diperbarui.');
}

public function destroyDraft($id)
{
    $response = Http::withToken(session('token'))
        ->delete("http://localhost:5000/api/drafts/$id");

    if ($response->failed()) {
        return back()->with('error', 'Gagal menghapus draft.');
    }

    return redirect('/drafts')
        ->with('success', 'Draft berhasil dihapus.');
}

public function submitDraft($id)
{
    $response = Http::withToken(session('token'))
        ->post("http://localhost:5000/api/drafts/$id/submit");

    if ($response->successful()) {
        return redirect('/drafts')->with('success', 'Draft berhasil disubmit');
    } else {
        return redirect('/drafts')->with('error', 'Gagal submit draft: '.$response->body());
    }
}

public function editItem($item_id)
{
    $response = Http::withToken(session('token'))
        ->get("http://localhost:5000/api/items/$item_id");

    $item = $response->json();

    if (!$item) {
        abort(404, 'Item tidak ditemukan');
    }

    return view('drafts.edit-item', compact('item'));
}

public function updateItem(Request $request, $item_id)
{
    Http::withToken(session('token'))
        ->put("http://localhost:5000/api/items/$item_id", [
            'nama_barang'    => $request->nama_barang,
            'jumlah'         => $request->jumlah,
            'harga_satuan'   => $request->harga_satuan,
            'link_pembelian' => $request->link_pembelian
        ]);

    // Ambil draft_id untuk redirect balik ke halaman items
    $itemResponse = Http::withToken(session('token'))
        ->get("http://localhost:5000/api/items/$item_id");

    $item = $itemResponse->json();

    return redirect("/drafts/{$item['draft_id']}/items");
}

public function deleteItem($item_id)
{
    // Ambil item dulu untuk dapat draft_id sebelum dihapus
    $itemResponse = Http::withToken(session('token'))
        ->get("http://localhost:5000/api/items/$item_id");

    $item = $itemResponse->json();
    $draft_id = $item['draft_id'];

    Http::withToken(session('token'))
        ->delete("http://localhost:5000/api/items/$item_id");

    return redirect("/drafts/$draft_id/items");
}
}

