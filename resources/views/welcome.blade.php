@extends('layouts.app')
<div class="mb-3">
    <a href="{{ route('welcome') }}" class="btn btn-primary">Domů</a>
    <a href="{{ route('login') }}" class="btn btn-secondary">Přihlásit se</a>
</div>
@section('content')
    <div class="container">
        <!-- Vítejte -->
        <h1>Vítejte v knihovně!</h1>
        <p>Prozkoumejte naše knihy, autory a rezervace. Přihlaste se pro plný přístup.</p>
    </div>
@endsection
