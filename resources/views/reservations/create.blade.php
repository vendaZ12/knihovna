@extends('layouts.app')

@section('content')
    <h1>Přidat rezervaci</h1>

    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="book_id" class="form-label">Kniha</label>
            <select class="form-control" id="book_id" name="book_id" required>
                @foreach ($books as $book)
                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="user_id" class="form-label">Uživatel</label>
            <select class="form-control" id="user_id" name="user_id" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="reservation_date" class="form-label">Datum rezervace</label>
            <input type="date" class="form-control" id="reservation_date" name="reservation_date" required>
        </div>

        <button type="submit" class="btn btn-primary">Uložit rezervaci</button>
    </form>
@endsection
