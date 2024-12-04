<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Vyhledávání knih (pokud existuje dotaz)
        $query = $request->input('query');
        $books = Book::query();

        if ($query) {
            $books = $books->where('title', 'LIKE', "%$query%")
                ->orWhereHas('author', function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%$query%");
                });
        }

        // Načtení dostupných knih nebo výsledků hledání
        $books = $books->where('available', true)->orderBy('created_at', 'desc')->get();

        // Načtení historie rezervací pro přihlášeného uživatele
        $reservations = Reservation::where('user_id', Auth::id())
            ->with('book')
            ->latest('reserved_at')
            ->get();

        // Předání dat do view
        return view('dashboard', [
            'books' => $books,
            'reservations' => $reservations,
            'query' => $query,
        ]);



    }

    public function reserveBook($bookId)
{
    // Najdeme knihu podle ID
    $book = Book::findOrFail($bookId);

    // Pokud kniha není dostupná, neumožníme rezervaci
    if (!$book->available) {
        return back()->with('error', 'Kniha není dostupná.');
    }

    // Vytvoříme novou rezervaci pro přihlášeného uživatele
    $reservation = Reservation::create([
        'user_id' => Auth::id(), // ID přihlášeného uživatele
        'book_id' => $bookId, // ID knihy, kterou rezervujeme
        'reserved_at' => now(), // Aktuální datum a čas rezervace
    ]);

    // Změníme dostupnost knihy na nedostupnou
    $book->update(['available' => false]);

    // Přesměrujeme zpět s potvrzením
    return back()->with('success', 'Kniha byla úspěšně rezervována.');
}



public function reservationHistory()
{
    $reservations = Reservation::where('user_id', Auth::id())
        ->with('book') // Zajistíme načtení knihy, která byla rezervována
        ->orderBy('reserved_at', 'desc')
        ->get();

    return view('dashboard', compact('reservations'));
}

}
