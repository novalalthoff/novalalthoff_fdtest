<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        $data = [
            'title' => "User",
            'header' => "Registered User",
            'route' => "user",
            'users' => $users,
        ];

        return view('user.index', $data);
    }
}
