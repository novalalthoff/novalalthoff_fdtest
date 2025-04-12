<?php

namespace App\Http\Controllers;

use App\Models\BookModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function landing(Request $request)
    {
        $query = BookModel::query();

        if ($request->filled('author')) $query->whereRaw('LOWER(author) LIKE ?', ['%' . strtolower($request->author) . '%']);
        if ($request->filled('created_at')) $query->whereDate('created_at', $request->created_at);
        if ($request->filled('rating')) $query->where('rating', $request->rating);

        $books = $query->latest()->get();

        $title = null;
        if (Auth::check()) {
            $title = explode(" ", Auth::user()->name)[0] . "!";
        }

        $data = [
            'title' => $title,
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
