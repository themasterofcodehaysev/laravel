<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\BookResource;
use Exception;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Book::list();
        $users = BookResource::collection($users);
        return response()->json(['success' => true, 'data' => $users], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'genre' => 'required|max:255',
            'published_year' => 'required|date|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors()], 400);
        };
        $user = new Book();
        try {
            $user = Book::create($request->all());
            return response()->json(["message" => "Book create has been successful", "data" => $user]);
        } catch (Exception $error) {
            return response()->json([ "message" => "Book create is unsuccessful", "error" => $error], 400);
        };
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
{
    $validatedData = $request->validate([
        'title' => 'required|string',
        'author' => 'required|string',
        'genre' => 'required|string',
        'published_year' => 'required|date',
    ]);

    try {
        $book->update($validatedData);
        return response()->json(["message" => "Book update has been successful", "data" => $book], 200);
    } catch (Exception $error) {
        return response()->json(["message" => "Book update is unsuccessful", "error" => $error->getMessage()], 400);
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $id = $book->id;
        try {
            Book::destroy($id);
            return response()->json([ "message" => "Book is deleted","data" => $book], 200);
        } catch (Exception $error) {
            return response()->json([ "message" => "Book delete is unsuccessful", "error" => $error], 400);
        }
    }
}
