<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{

    $response = Http::post(
        'http://localhost:5000/api/login',
        [
            'email' =>
                $request->email,

            'password' =>
                $request->password
        ]
    );

    if(!$response->successful())
    {
        return back()
            ->with('error',
            'Login gagal');
    }

    $data =
        $response->json();

    session([
        'token' =>
            $data['token'],

        'user' =>
            $data['user']
    ]);

    return redirect('/dashboard');
}

public function logout()
{
    session()->flush();

    return redirect('/login');
}


}