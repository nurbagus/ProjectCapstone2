<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        
        $stats = Http::withToken(
            session('token')
        )->get(
            'http://localhost:5000/api/dashboard'
        )->json();

        

        return view(
            'dashboard',
            compact('stats')
        );
    }
}