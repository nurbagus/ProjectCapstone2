<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index()
    {
        $response = Http::withToken(
            session('token')
        )->get(
            'http://localhost:5000/api/users'
        );

        $users = $response->json();

        return view(
            'users.index',
            compact('users')
        );
    }

    public function create()
{
    return view('users.create');
}

public function store(Request $request)
{

    Http::withToken(
        session('token')
    )->post(
        'http://localhost:5000/api/users',
        [
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role
        ]
    );

    return redirect('/users');

}

public function edit($id)
{

    $response = Http::withToken(
        session('token')
    )->get(
        'http://localhost:5000/api/users'
    );

    $users = $response->json();

    $user = collect($users)
        ->firstWhere('id',$id);

    return view(
        'users.edit',
        compact('user')
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
        "http://localhost:5000/api/users/$id",
        [
            'nama'=>$request->nama,
            'email'=>$request->email,
            'role'=>$request->role
        ]
    );

    return redirect('/users');

}

public function destroy($id)
{

    Http::withToken(
        session('token')
    )->delete(
        "http://localhost:5000/api/users/$id"
    );

    return redirect('/users');

}

}