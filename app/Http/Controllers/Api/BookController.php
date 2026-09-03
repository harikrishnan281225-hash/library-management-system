<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    /**
     * GET /api/books
     * Display a listing of the books. Supports search.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $books = Book::when($search, function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('author', 'like', "%{$search}%")
                      ->orWhere('isbn', 'like', "%{$search}%");
            })
            ->orderBy('title')
            ->paginate(10);

        return response()->json($books, Response::HTTP_OK);
    }

    /**
     * POST /api/books
     * Store a newly created book in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'           => 'required|string|max:255',
            'author'          => 'required|string|max:255',
            'isbn'            => 'required|string|max:20|unique:books,isbn',
            'publisher'       => 'nullable|string|max:255',
            'published_year'  => 'nullable|digits:4|integer|min:1000|max:' . (date('Y') + 1),
            'category'        => 'nullable|string|max:100',
            'quantity'        => 'required|integer|min:0',
            'description'     => 'nullable|string',
        ]);

        $book = Book::create($validated);

        return response()->json([
            'message' => 'Book created successfully',
            'data' => $book
        ], Response::HTTP_CREATED);
    }

    /**
     * GET /api/books/{id}
     * Display the specified book.
     */
    public function show(Book $book)
    {
        return response()->json($book, Response::HTTP_OK);
    }

    /**
     * PUT/PATCH /api/books/{id}
     * Update the specified book in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title'           => 'sometimes|required|string|max:255',
            'author'          => 'sometimes|required|string|max:255',
            'isbn'            => 'sometimes|required|string|max:20|unique:books,isbn,' . $book->id,
            'publisher'       => 'nullable|string|max:255',
            'published_year'  => 'nullable|digits:4|integer|min:1000|max:' . (date('Y') + 1),
            'category'        => 'nullable|string|max:100',
            'quantity'        => 'sometimes|required|integer|min:0',
            'description'     => 'nullable|string',
        ]);

        $book->update($validated);

        return response()->json([
            'message' => 'Book updated successfully',
            'data' => $book
        ], Response::HTTP_OK);
    }

    /**
     * DELETE /api/books/{id}
     * Remove the specified book from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json([
            'message' => 'Book deleted successfully'
        ], Response::HTTP_OK);
    }
}