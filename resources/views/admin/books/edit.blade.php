@extends('layouts.app')

@section('content')
    <h1>Upravit knihu</h1>

    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Název knihy</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $book->title) }}"
                required>
        </div>

        <div class="mb-3">
            <label for="author_id" class="form-label">Autor</label>
            <select class="form-control" id="author_id" name="author_id" required>
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}"
                        {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>{{ $author->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="text" class="form-control" id="isbn" name="isbn" value="{{ old('isbn', $book->isbn) }}"
                required>
        </div>

        <button type="submit" class="btn btn-primary">Uložit změny</button>
    </form>
@endsection
