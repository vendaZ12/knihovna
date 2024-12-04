@extends('layouts.app')
<div class="mb-3">
    <a href="{{ route('admin') }}" class="btn btn-secondary">Domů</a>
    <a href="{{ route('books.index') }}" class="btn btn-primary">Seznam knih</a>
    <a href="{{ route('authors.index') }}" class="btn btn-secondary">Seznam autorů</a>
</div>
@auth
    <div class="mt-3">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Odhlásit se</button>
        </form>
    </div>
@endauth
@section('content')
    <h1>Seznam knih</h1>
    <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">Přidat knihu</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Název</th>
                <th>Autor</th>
                <th>Dostupnost</th>
                <th>Akce</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($latestBooks as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author->name ?? 'Neznámý autor' }}</td>
                    <td>{{ $book->available ? 'Dostupná' : 'Rezervovaná' }}</td>
                    <td>
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">Upravit</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Smazat</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
