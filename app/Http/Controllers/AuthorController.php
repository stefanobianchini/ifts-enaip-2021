<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function getAuthors() {
        //leggo tutti i record della tabella authors
        $authors = Author::get();
        return response()->json($authors, 200);
    }

    public function getSingleAuthor($id) {
        $author = Author::findOrFail($id);
        return response()->json($author, 200);
    }

    public function createAuthor(Request $request) {
        //Validazione
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'rating' => 'nullable|integer'
        ]);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        //Salvataggio
        $author = new Author();
        $author->name = $request->input('name');
        $author->surname = $request->input('surname');
        $author->rating = $request->input('rating');
        $author->save();

        //Risposta
        return response()->json($author, 201);
    }

    public function deleteAuthor($id) {
        $author = Author::findOrFail($id);
        $author->delete();

        return response()->json(null, 204);
    }

    public function updateAuthor(Request $request, $id) {
        $author = Author::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'rating' => 'nullable|integer'
        ]);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        $author->name = $request->input('name');
        $author->surname = $request->input('surname');
        $author->rating = $request->input('rating');
        $author->save();

        return response()->json($author, 200);
    }

    public function partialUpdateAuthor(Request $request, $id) {
        $author = Author::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|max:255',
            'surname' => 'sometimes|required|max:255',
            'rating' => 'sometimes|nullable|integer'
        ]);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }
        if($request->has('name')) {
            $author->name = $request->input('name');
        }
        if($request->has('surname')) {
            $author->surname = $request->input('surname');
        }
        if($request->has('rating')) {
            $author->rating = $request->input('rating');
        }
        $author->save();

        return response()->json($author, 200);

    }
}
