<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // Zobrazení seznamu rezervací pro aktuálního uživatele
    public function index()
    {
        $reservations = Reservation::with('book') // Načteme knihy s rezervacemi
            ->where('user_id', Auth::id()) // Načteme rezervace pro přihlášeného uživatele
            ->get();

        return view('reservations.index', compact('reservations'));
    }

    // Formulář pro přidání nové rezervace (rezervace knihy pro aktuálního uživatele)
    public function create()
    {
        $books = Book::where('available', true)->get(); // Pouze dostupné knihy
        return view('reservations.create', compact('books'));
    }

    // Uložení nové rezervace pro aktuálně přihlášeného uživatele
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        // Zajišťujeme, že rezervace bude přiřazena k přihlášenému uživateli
        $reservation = Reservation::create([
            'book_id' => $request->book_id,
            'user_id' => Auth::id(), // Automatické přiřazení přihlášeného uživatele
            'reserved_at' => now(),
        ]);

        // Nastavení knihy jako nedostupné
        $book = Book::findOrFail($request->book_id);
        $book->update(['available' => false]);

        return redirect()->route('reservations.index')->with('success', 'Rezervace byla úspěšně vytvořena.');
    }

    // Zobrazení detailu rezervace
    public function show($id)
    {
        $reservation = Reservation::with('book')->findOrFail($id);
        return view('reservations.show', compact('reservation'));
    }

    // Formulář pro úpravu rezervace (tato část se může hodit, pokud chcete uživatelům umožnit upravit rezervace)
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        $books = Book::all();
        return view('reservations.edit', compact('reservation', 'books'));
    }

    // Uložení změn rezervace
    public function update(Request $request, $id)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->update($request->all());

        return redirect()->route('reservations.index')->with('success', 'Rezervace byla upravena.');
    }

    // Smazání rezervace
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $book = $reservation->book;

        // Vrácení knihy jako dostupné
        $book->update(['available' => true]);

        // Smazání rezervace
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Rezervace byla smazána.');
    }

    public function cancel($reservationId)
{
    $reservation = Reservation::findOrFail($reservationId);
    $reservation->delete();

    return redirect()->route('dashboard')->with('status', 'Rezervace byla úspěšně zrušena.');
}
}
