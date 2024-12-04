@extends('layouts.app')

@section('content')
    <h1>Přidat knihu</h1>

    <form action="{{ route('admin.books.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Název knihy</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label for="author_id" class="form-label">Autor</label>
            <select class="form-control" id="author_id" name="author_id" required>
                <option value="">Vyberte autora</option>
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                        {{ $author->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="text" class="form-control" id="isbn" name="isbn" value="{{ old('isbn') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Uložit knihu</button>
    </form>
@endsection
