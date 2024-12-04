@extends('layouts.app')
<!-- Odkazy na knihy a další možnosti -->
<div class="mb-3">
    <a href="{{ route('admin') }}" class="btn btn-primary">Domů</a>
    <a href="{{ route('books.index') }}" class="btn btn-secondary">Seznam knih</a>
    <a href="{{ route('authors.index') }}" class="btn btn-secondary">Seznam autorů</a>
</div>
<!-- Tlačítko pro odhlášení -->
@auth
    <div class="mt-3">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Odhlásit se</button>
        </form>
    </div>
@endauth
@section('content')
    <div class="container">


        <h1>Správa Knihovny</h1>
        <p>Administrátorská část pro správu knih a autorů.</p>

    </div>
@endsection
