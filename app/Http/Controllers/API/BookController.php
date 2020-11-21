<?php

namespace App\Http\Controllers\API;

use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::paginate(20);
        return response()->json(['data' => $books], 200);
    }

    public function store(Request $request)
    {
        $book = new Book();
        $book->name = $request->name;
        $book->author = $request->author;
        $book->quantity = $request->quantity;
        $book->date = Carbon::parse($request->date);
        $book->save();
        return response()->json(['data' => $book], 200);
    }

    public function show(Book $book)
    {
        if ($book) {
            return response()->json(['data' => Book::find($book)], 200);
        }
    }

    public function update(Book $book, Request $request)
    {
        if ($book) {
            $book->name = $request->name;
            $book->author = $request->author;
            $book->quantity = $request->quantity;
            $book->date = Carbon::parse($request->date);
            $book->save();
            return response()->json(['data' => $book], 200);
        }
    }

    public function destroy(Book $book)
    {
        if ($book) {
            $book->delete();
            return response()->json(['data' => true], 200);
        }
    }
}
