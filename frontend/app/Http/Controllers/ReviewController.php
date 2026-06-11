<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class ReviewController extends Controller
{
   public function index()
{
    $draftsResponse = Http::withToken(session('token'))
        ->get('http://localhost:5000/api/drafts-review');

    $drafts = $draftsResponse->json() ?? [];

    $historyResponse = Http::withToken(session('token'))
        ->get('http://localhost:5000/api/drafts-history');

    $histories = $historyResponse->json() ?? [];

    return view('reviews.index', compact('drafts', 'histories'));
}

public function history()
{
    $response = Http::withToken(session('token'))
        ->get('http://localhost:5000/api/drafts-history');

    $histories = $response->json();

    return view('reviews.index', compact('drafts', 'histories'));
}

public function detail($id)
{
    $response = Http::withToken(session('token'))
        ->get("http://localhost:5000/api/drafts/$id");

    $draft = $response->json();

    // ambil items dari endpoint lain (kalau ada)
    $itemsResponse = Http::withToken(session('token'))
        ->get("http://localhost:5000/api/drafts/$id/items");

    $draft['items'] = $itemsResponse->json() ?? [];

    return view('reviews.detail', compact('draft'));
}

public function approve($id)
{
    Http::withToken(
        session('token')
    )->put(
        "http://localhost:5000/api/items/$id/approve"
    );

    return back();
}

public function reject($id)
{
    Http::withToken(
        session('token')
    )->put(
        "http://localhost:5000/api/items/$id/reject"
    );

    return back();
}


public function finalize($id)
{
    Http::withToken(
        session('token')
    )->put(
        "http://localhost:5000/api/drafts/$id/finalize"
    );

    return redirect('/reviews');
}
}

