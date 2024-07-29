<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        \Log::debug("Show UserController Index");
        $users = User::all();
        return view('users.index', compact('users'));
    }
}
