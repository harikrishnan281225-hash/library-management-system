@extends('layouts.app')

@section('title', $book->title)

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <h4 class="card-title mb-0">{{ $book->title }}</h4>
                <span class="badge {{ $book->quantity > 0 ? 'bg-success' : 'bg-danger' }}">
                    {{ $book->quantity > 0 ? 'Available' : 'Out of stock' }}
                </span>
            </div>

            <table class="table table-borderless w-auto">
                <tr>
                    <th class="pe-4">Author</th>
                    <td>{{ $book->author }}</td>
                </tr>
                <tr>
                    <th class="pe-4">ISBN</th>
                    <td>{{ $book->isbn }}</td>
                </tr>
                <tr>
                    <th class="pe-4">Publisher</th>
                    <td>{{ $book->publisher ?? '—' }}</td>
                </tr>
                <tr>
                    <th class="pe-4">Published Year</th>
                    <td>{{ $book->published_year ?? '—' }}</td>
                </tr>
                <tr>
                    <th class="pe-4">Category</th>
                    <td>{{ $book->category ?? '—' }}</td>
                </tr>
                <tr>
                    <th class="pe-4">Quantity</th>
                    <td>{{ $book->quantity }}</td>
                </tr>
            </table>

            @if ($book->description)
                <hr>
                <p class="mb-0">{{ $book->description }}</p>
            @endif

            <div class="mt-4">
                <a href="{{ route('books.edit', $book) }}" class="btn btn-primary">Edit</a>
                <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">Back to list</a>
            </div>
        </div>
    </div>
@endsection
