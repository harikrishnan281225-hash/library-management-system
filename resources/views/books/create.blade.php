@extends('layouts.app')

@section('title', 'Add Book')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Add New Book</h4>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('books.store') }}">
                @csrf
                @include('books._form')

                <button type="submit" class="btn btn-primary">Save Book</button>
                <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
