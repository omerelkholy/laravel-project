<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function index(Request $request)
    {
        if($request->filled('search')){
            $users = User::search($request->search)->get();
        }else{
            $users = User::all();
        }
        return view('users.index', compact('users'));
    }
}
