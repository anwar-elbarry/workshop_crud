<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index(){
        return Book::all();
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
}
