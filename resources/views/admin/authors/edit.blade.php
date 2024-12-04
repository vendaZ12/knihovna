@extends('layouts.app')

@section('content')
    <h1>Upravit autora</h1>

    <form action="{{ route('authors.update', $author->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Jméno autora</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $author->name) }}"
                required>
        </div>

        <button type="submit" class="btn btn-primary">Uložit změny</button>
    </form>
@endsection
