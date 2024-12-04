@extends('layouts.app')

@section('content')
    <div class="mb-3">
        <a href="{{ route('dashboard') }}" class="btn btn-primary">Domů</a>
    </div>

    @auth
        <div class="mt-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger">Odhlásit se</button>
            </form>
        </div>
    @endauth

    <header class="dashboard-header">
        @auth
            <h1>Vítejte, {{ Auth::user()->name }}!</h1>
            <p class="welcome-message">Registrovaní uživatelé mohou vyhledávat knihy, rezervovat je a sledovat historii.</p>
        @endauth
    </header>

    <main class="dashboard-content">
        <!-- Vyhledávací formulář -->
        <section class="search-section">
            <form method="GET" action="{{ route('dashboard') }}" class="search-form">
                <input type="text" name="query" value="{{ old('query', $query ?? '') }}"
                    placeholder="Vyhledat knihu nebo autora" class="form-control" required>
                <button type="submit" class="btn btn-primary">Hledat</button>
                <!-- Tlačítko pro vyčištění hledání -->
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Vyčistit</a>
            </form>
        </section>

        <h2>Dostupné knihy</h2>
        <div class="row">
            @foreach ($books as $book)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">Autor: {{ $book->author->name ?? 'Neznámý autor' }}</p>
                            <p class="card-text"><strong>Dostupnost:</strong>
                                {{ $book->available ? 'Dostupná' : 'Rezervovaná' }}</p>
                            @if ($book->available)
                                <form method="POST" action="{{ route('dashboard.reserve', $book->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Rezervovat</button>
                                </form>
                            @else
                                <button class="btn btn-secondary" disabled>Rezervovaná</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <h2>Vaše rezervace:</h2>
        @if ($reservations->isEmpty())
            <p>Nemáte žádné aktivní rezervace.</p>
        @else
            <ul>
                @foreach ($reservations as $reservation)
                    <li>
                        Kniha: {{ $reservation->book->title }} <br>
                        Datum rezervace:
                        {{ $reservation->reserved_at ? $reservation->reserved_at->format('d.m.Y') : 'Neznámé' }}
                        <!-- Tlačítko pro smazání rezervace -->
                        <form method="POST" action="{{ route('dashboard.cancelReservation', $reservation->id) }}"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Smazat</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif

        <h2>Historie rezervací</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Název knihy</th>
                    <th>Datum rezervace</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->book->title }}</td>
                        <td>
                            {{-- Ošetření, zda 'reserved_at' není null --}}
                            {{ $reservation->reserved_at ? $reservation->reserved_at->format('d.m.Y H:i') : 'Datum není k dispozici' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
@endsection
