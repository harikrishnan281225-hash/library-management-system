@extends('layouts.app')

@section('title', 'All Books')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Book Catalog</h3>
        <form method="GET" action="{{ route('books.index') }}" class="d-flex" style="max-width: 320px;">
            <input type="text" name="search" value="{{ $search }}" class="form-control form-control-sm me-2"
                   placeholder="Search title, author, ISBN...">
            <button class="btn btn-outline-primary btn-sm" type="submit">Search</button>
        </form>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>ISBN</th>
                        <th>Category</th>
                        <th>Qty</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->isbn }}</td>
                            <td>{{ $book->category ?? '—' }}</td>
                            <td>
                                <span class="badge {{ $book->quantity > 0 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $book->quantity }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-outline-secondary">View</a>
                                <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Delete this book?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No books found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $books->links() }}
    </div>
@endsection
