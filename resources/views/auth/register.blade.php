@extends('layouts.app')
<div class="mb-3">
    <a href="{{ route('welcome') }}" class="btn btn-secondary">Domů</a>
    <a href="{{ route('login') }}" class="btn btn-secondary">Přihlásit se</a>
    <a href="{{ route('register') }}" class="btn btn-primary">Registrovat se</a>
</div>
@section('content')
    <div class="container" style="max-width: 600px; margin: 50px auto;">
        <h2 class="text-center">Registrace</h2>

        <!-- Zobrazení chyb -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulář -->
        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="name">Jméno</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                    required>
            </div>

            <div class="form-group mb-3">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                    required>
            </div>

            <div class="form-group mb-3">
                <label for="password">Heslo</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="form-group mb-3">
                <label for="password_confirmation">Potvrzení hesla</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                    required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Registrovat</button>
        </form>
    </div>
@endsection