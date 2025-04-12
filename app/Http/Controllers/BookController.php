<?php

namespace App\Http\Controllers;

use App\Models\BookModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index()
    {
        $books = BookModel::where('user_id', Auth::user()->id)->latest()->get();

        $data = [
            'title' => "Book",
            'header' => "Book Management",
            'route' => "book",
            'books' => $books,
        ];

        return view('book.index', $data);
    }

    public function storeRules(Array $request)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'author' => 'max:255',
            'description' => 'max:255',
            'thumbnail' => 'image|mimes:jpeg,png,jpg|max:2048'
        ];
        $messages = [
            'title.required' => 'Book Title still empty!'
        ];
        return Validator::make($request, $rules, $messages);
    }

    public function store(Request $request)
    {
        $validator = $this->storeRules($request->all());

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()]);
        }

        DB::beginTransaction();
        try {
            $thumbnail = null;
            $thumbnail_path = null;
            $file = $request->file('thumbnail');
            if ($file) {
                $thumbnail = $file->hashName();
                $thumbnail_path = $request->file('thumbnail')->storeAs(
                    'books',
                    $thumbnail,
                    'public'
                );
            }

            $save = BookModel::create([
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'author' => $request->author,
                'description' => $request->description,
                'thumbnail' => $thumbnail,
                'thumbnail_path' => $thumbnail_path,
                'rating' => $request->rating
            ]);

            if ($save) {
                DB::commit();
                return response()->json(['status' => true, 'message' => "New book created successfully!", 'url' => "/book"]);
            } else {
                return response()->json(['status' => false, 'message' => "Failed to create data!"]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $book = BookModel::find($id);

        $data = [
            'title' => "Book",
            'header' => "Book Management",
            'route' => "book",
            'book' => $book,
        ];

        return view('book.show', $data);
    }

    public function update($id, Request $request)
    {
        DB::beginTransaction();
        try {
            $book = BookModel::find($id);
            $book->user_id = Auth::user()->id;
            $book->title = $request->title;
            $book->author = isset($request->author) ? $request->author : null;
            $book->description = isset($request->description) ? $request->description : null;
            $book->rating = isset($request->rating) ? $request->rating : null;

            $thumbnail = $book->thumbnail;
            $thumbnail_path = $book->thumbnail_path;
            $file = $request->file('thumbnail');
            if ($file) {
                if (isset($book->thumbnail_path) && $file->getClientOriginalName() != $book->thumbnail) {
                    if (Storage::disk('public')->exists($book->thumbnail_path)) {
                        Storage::disk('public')->delete($book->thumbnail_path);
                    }
                }

                $thumbnail = $file->hashName();
                $thumbnail_path = $request->file('thumbnail')->storeAs(
                    'books',
                    $thumbnail,
                    'public'
                );
            }

            $book->thumbnail = $thumbnail;
            $book->thumbnail_path = $thumbnail_path;
            $save = $book->save();

            if ($save) {
                DB::commit();
                return response()->json(['status' => true, 'message' => "{$book->title} successfully updated!", 'url' => "/book"]);
            } else {
                return response()->json(['status' => false, 'message' => "Failed to update data!"]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $book = BookModel::find($id);
            $destroy = $book->delete();

            if (isset($book->thumbnail_path) && Storage::disk('public')->exists($book->thumbnail_path)) {
                Storage::disk('public')->delete($book->thumbnail_path);
            }

            if ($destroy) {
                DB::commit();
                return response()->json(['status' => true, 'message' => "{$book->title} successfully deleted!", 'url' => "/book"]);
            } else {
                return response()->json(['status' => false, 'message' => "Failed to delete data!"]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}
