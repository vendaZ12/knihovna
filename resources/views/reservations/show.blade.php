@extends('layouts.app')

@section('content')
    <h1>Rezervace pro {{ $reservation->book->title }}</h1>
    <p><strong>Uživatel:</strong> {{ $reservation->user->name }}</p>
    <p><strong>Datum rezervace:</strong> {{ $reservation->reservation_date }}</p>

    <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Zpět na seznam rezervací</a>
@endsection
