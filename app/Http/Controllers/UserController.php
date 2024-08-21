<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {   
        $users = User::limit(9)->get();
        return view('users',['users'=> $users]);
    }

    public function store(Request $req)
    {
        $validated = $req->validate([
            'name' => 'required',
            'email'=> 'required|email',
            'password'=> 'required'
        ]);

        $created = User::create([
            'name'=> $validated['name'],
            'email'=> $validated['email'],
            'password' => $validated['password']
        ]);

        if($created):
            $message = "O usuario foi criado com sucesso";
            return redirect('/')->with('message',$message);
        endif;
        return redirect('/');
        
    }
}
