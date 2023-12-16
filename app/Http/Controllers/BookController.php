<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::orderBy("updated_at", "desc")
        ->orderBy("created_at", "desc")
        ->get();

        return view('Book',['books' => $books]);
    }

    public function store(Request $request ) {
        $fields = $request->validate([
            'title'=> 'required | string',
            'author'=> 'required | string',
            'genre'=> 'required | string',
            'publish_date' => 'required | date',
            'status'=> 'required | string',
        ]);

        Book::create($fields);
        return redirect('/books');
    }

    public function destroy(Book $book) {
        $book->checkouts->each(function ($checkouts) {
            $checkouts->delete();
        });

        $book->delete();
    }

    public function update(Request $request, Book $book) {
        $fields = $request->validate([
            'title'=> 'required | string',
            'author'=> 'required | string',
            'genre'=> 'required | string',
            'publish_date' => 'required | date',
            'status'=> 'required | string',
        ]);

        $book->update($fields);
    }

    public function view($book) {
        $books = Book::find($book);

        return response()->json($books);
    }
}
