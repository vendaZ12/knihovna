@extends('layouts.app')

@section('content')
    <h1>Přidat autora</h1>

    <form action="{{ route('authors.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Jméno autora</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Uložit autora</button>
    </form>
@endsection
