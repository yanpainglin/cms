<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(){
        return view('users.index')->with('users', User::all());
    }

    public function admin(User $id){
        $id -> role = 'admin';
        $id->save();
        return back();
    }

    public function writer(User $id){
        $id -> role = 'writer';
        $id->save();
        return back();
    }
}
