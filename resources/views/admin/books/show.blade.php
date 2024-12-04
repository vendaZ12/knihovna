@extends('layouts.app')

@section('content')
    <h1>{{ $book->title }}</h1>
    <p><strong>Autor:</strong> {{ $book->author->name }}</p>
    <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
    <p><strong>Dostupnost:</strong> {{ $book->available ? 'Dostupná' : 'Rezervovaná' }}</p>

    <a href="{{ route('books.index') }}" class="btn btn-secondary">Zpět na seznam knih</a>
@endsection
