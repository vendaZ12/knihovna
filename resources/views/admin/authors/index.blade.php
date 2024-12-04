@extends('layouts.app')
<div class="mb-3">
    <a href="{{ route('admin') }}" class="btn btn-secondary">Domů</a>
    <a href="{{ route('books.index') }}" class="btn btn-secondary">Seznam knih</a>
    <a href="{{ route('authors.index') }}" class="btn btn-primary">Seznam autorů</a>
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
    <h1>Seznam autorů</h1>
    <a href="{{ route('authors.create') }}" class="btn btn-primary mb-3">Přidat autora</a>

    <table class="table">
        <thead>
            <tr>
                <th>Jméno autora</th>
                <th>Akce</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($authors as $author)
                <tr>
                    <td>{{ $author->name }}</td>
                    <td>
                        <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-warning btn-sm">Upravit</a>
                        <form action="{{ route('authors.destroy', $author->id) }}" method="POST" style="display:inline;">
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
