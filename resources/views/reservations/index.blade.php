@extends('layouts.app')

@section('content')
    <h1>Seznam rezervací</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Kniha</th>
                <th>Uživatel</th>
                <th>Datum rezervace</th>
                <th>Akce</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->book->title }}</td>
                    <td>{{ $reservation->user->name }}</td>
                    <td>{{ $reservation->reservation_date }}</td>
                    <td>
                        <a href="{{ route('reservations.show', $reservation->id) }}" class="btn btn-info btn-sm">Zobrazit</a>
                        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST"
                            style="display:inline;">
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
