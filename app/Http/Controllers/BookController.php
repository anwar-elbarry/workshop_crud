<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

 /**
 * @OA\Info(title="Car Rentel API", version="1.0.0")
 */


class BookController extends Controller
{

    /**
 * @OA\Get(
 *     path="/api/books",
 *     summary="Get all books",
 *     tags={"Books"},
 *     @OA\Response(response="200", description="Success")
 * )
 */
    public function index(){
        return Book::all();
    }

    /**
 * @OA\Get(
 *     path="/api/books/{id}",
 *     summary="Get a book by ID",
 *     tags={"Books"},
 *     @OA\Parameter(name="id", in="path", required=true, description="ID of the book", @OA\Schema(type="integer")),
 *     @OA\Response(response="200", description="Success"),
 *     @OA\Response(response="404", description="Book not found")
 * )
 */
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
