<?php

namespace App\Http\Controllers;

use App\Models\BookModel;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function landing()
    {
        $books = BookModel::latest()->get();

        $data = [
            'title' => "Book",
            'header' => "Book Management",
            'route' => "book",
            'books' => $books,
        ];

        return view('landing', $data);
    }

    public function index()
    {
        $user = Auth::user();

        $data = [
            'title' => explode(" ", $user->name)[0] . "!",
            'header' => "User Details",
            'user' => $user
        ];

        return view('home.index', $data);
    }
}
