@php $book = $book ?? null; @endphp

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" name="title" class="form-control"
               value="{{ old('title', $book->title ?? '') }}" required>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Author <span class="text-danger">*</span></label>
        <input type="text" name="author" class="form-control"
               value="{{ old('author', $book->author ?? '') }}" required>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">ISBN <span class="text-danger">*</span></label>
        <input type="text" name="isbn" class="form-control"
               value="{{ old('isbn', $book->isbn ?? '') }}" required>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Publisher</label>
        <input type="text" name="publisher" class="form-control"
               value="{{ old('publisher', $book->publisher ?? '') }}">
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Published Year</label>
        <input type="number" name="published_year" class="form-control" min="1000" max="{{ date('Y') + 1 }}"
               value="{{ old('published_year', $book->published_year ?? '') }}">
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Category</label>
        <input type="text" name="category" class="form-control"
               value="{{ old('category', $book->category ?? '') }}">
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Quantity <span class="text-danger">*</span></label>
        <input type="number" name="quantity" class="form-control" min="0"
               value="{{ old('quantity', $book->quantity ?? 1) }}" required>
    </div>

    <div class="col-12 mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="4">{{ old('description', $book->description ?? '') }}</textarea>
    </div>
</div>
