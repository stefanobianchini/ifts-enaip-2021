<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function getBooks() {
        //Leggere tutti i record della tabella books
        $books = Book::get();
        return response()->json($books, 200);
    }

    public function getSingleBook($id) {
        $book = Book::findOrFail($id);
        return response()->json($book, 200);
    }

    public function createBook(Request $request) {
        //Validare l'input
        $validator = Validator::make($request->all(),[
            'title' => 'required|max:255',
            'abstract' => 'required|max:1000',
            'author' => 'required|max:255',
            'pages' => 'required|integer'
        ]);
        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }
        //Inserire il record
        $book = new Book();
        $book->title = $request->input('title');
        $book->abstract = $request->input('abstract');
        $book->author = $request->input('author');
        $book->pages = $request->input('pages');
        $book->save();

        //Emettere una risposta
        return response()->json($book, 201);
    }

    public function deleteBook($id) {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json(null, 204);
    }
}
