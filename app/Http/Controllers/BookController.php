<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index(){
        return Book::all();
    }
    public function show(string $id){
        $book = Book::findOrFail($id);
        return response()->json(['book' => $book]);
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

            $book = Book::create([
                'name' => $request->name,
                'author' => $request->author,
                'description' => $request->description
            ]);
      
        return response()->json(['book' => $book]);
    }
    public function update(Request $request, Book $book){
        $request->validate([
            'name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $book->name = $request->name;
        $book->author = $request->author;
        $book->description = $request->description;
        $book->save();

        return response()->json(['book' => $book]);
    }
    public function destroy(Book $book){
        $book->delete();
        return response()->noContent();
    }
}
