<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function getBooks() {
        //Leggere tutti i record della tabella books
        $books = Book::orderBy('title')->get();
        return response()->json($books, 200);
    }

    public function getSingleBook($id) {
        $book = Book::with('author')->findOrFail($id);
        return response()->json($book, 200);
    }

    public function createBook(Request $request) {
        //Validare l'input
        $validator = Validator::make($request->all(),[
            'title' => 'required|max:255',
            'abstract' => 'required|max:1000',
            'author_id' => 'required|exists:authors,id',
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
        $book->author_id = $request->input('author_id');
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

    public function updateBook(Request $request, $id) {
        $book = Book::findOrFail($id);

        //Validare
        $validator = Validator::make($request->all(),[
            'title' => 'required|max:255',
            'abstract' => 'required|max:1000',
            'author_id' => 'required|exists:authors,id',
            'pages' => 'required|integer'
        ]);
        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        //Salvare
        $book->title = $request->input('title');
        $book->abstract = $request->input('abstract');
        $book->author_id = $request->input('author_id');
        $book->pages = $request->input('pages');
        $book->save();

        //Rispondere
        return response()->json($book, 200);
    }

    public function partialUpdateBook(Request $request, $id) {
        $book = Book::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'title' => 'sometimes|required|max:255',
            'abstract' => 'sometimes|required|max:1000',
            'author_id' => 'sometimes|required|exists:authors,id',
            'pages' => 'sometimes|required|integer'
        ]);
        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        if($request->has('title')) {
            $book->title = $request->input('title');
        }
        if($request->has('abstract')) {
            $book->abstract = $request->input('abstract');
        }
        if($request->has('author_id')) {
            $book->author_id = $request->input('author_id');
        }
        if($request->has('pages')) {
            $book->pages = $request->input('pages');
        }
        $book->save();

        return response()->json($book,200);

    }

}
