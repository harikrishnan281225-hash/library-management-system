@extends('layouts.app')

@section('title', 'Edit Book')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Edit Book — {{ $book->title }}</h4>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('books.update', $book) }}">
                @csrf
                @method('PUT')
                @include('books._form')

                <button type="submit" class="btn btn-primary">Update Book</button>
                <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
