<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('name')) $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($request->name) . '%']);
        if ($request->filled('email')) $query->whereRaw('LOWER(email) LIKE ?', ['%' . strtolower($request->email) . '%']);
        if ($request->filled('is_verified')) {
            if ($request->is_verified == 1) {
                $query->whereNotNull('email_verified_at');
            } else {
                $query->whereNull('email_verified_at');
            }
        }

        $users = $query->latest()->get();

        $data = [
            'title' => "User",
            'header' => "Registered User",
            'route' => "user",
            'users' => $users,
        ];

        return view('user.index', $data);
    }
}
