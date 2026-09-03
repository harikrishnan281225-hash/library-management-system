<?php

//Book Controller for library management - handles CRUD for books

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Display a listing of the books.
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');

        $books = Book::when($search, function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('author', 'like', "%{$search}%")
                      ->orWhere('isbn', 'like', "%{$search}%");
            })
            ->orderBy('title')
            ->paginate(10)
            ->withQueryString();

        return view('books.index', compact('books', 'search'));
    }

    /**
     * Show the form for creating a new book.
     */
    public function create(): View
    {
        return view('books.create');
    }

    /**
     * Store a newly created book in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateBook($request);

        Book::create($validated);

        return redirect()
            ->route('books.index')
            ->with('success', 'Book added successfully.');
    }

    /**
     * Display the specified book.
     */
    public function show(Book $book): View
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified book.
     */
    public function edit(Book $book): View
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified book in storage.
     */
    public function update(Request $request, Book $book): RedirectResponse
    {
        $validated = $this->validateBook($request, $book->id);

        $book->update($validated);

        return redirect()
            ->route('books.index')
            ->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified book from storage.
     */
    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();

        return redirect()
            ->route('books.index')
            ->with('success', 'Book deleted successfully.');
    }

    /**
     * Shared validation rules for store & update.
     */
    private function validateBook(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'title'           => 'required|string|max:255',
            'author'          => 'required|string|max:255',
            'isbn'            => 'required|string|max:20|unique:books,isbn' . ($ignoreId ? ",{$ignoreId}" : ''),
            'publisher'       => 'nullable|string|max:255',
            'published_year'  => 'nullable|digits:4|integer|min:1000|max:' . (date('Y') + 1),
            'category'        => 'nullable|string|max:100',
            'quantity'        => 'required|integer|min:0',
            'description'     => 'nullable|string',
        ]);
    }
}
