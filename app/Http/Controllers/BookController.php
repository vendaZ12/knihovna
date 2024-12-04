<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Zobrazení seznamu knih
    public function index()
    {
        $latestBooks = Book::with('author')->get();
        return view('admin.books.index', compact('latestBooks'));
    }

    // Formulář pro přidání nové knihy
    public function create()
    {
        $authors = Author::all(); // Seznam autorů pro výběr v dropdownu
        return view('admin.books.create', compact('authors'));
    }

    // Uložení nové knihy
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author_id' => 'required|exists:authors,id',
            'isbn' => 'required|unique:books',
        ]);

        Book::create($request->all());
        return redirect()->route('admin.books.index')->with('success', 'Kniha byla přidána.');
    }

    // Zobrazení detailu knihy
    public function show($id)
    {
        $book = Book::with('author')->findOrFail($id);
        return view('admin.books.show', compact('book'));
    }

    // Formulář pro úpravu knihy
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $authors = Author::all(); // Seznam autorů pro výběr
        return view('admin.books.edit', compact('book', 'authors'));
    }

    // Uložení změn knihy
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'author_id' => 'required|exists:authors,id',
            'isbn' => 'required|unique:books,isbn,' . $id,
        ]);

        $book = Book::findOrFail($id);
        $book->update($request->all());
        return redirect()->route('admin.books.index')->with('success', 'Kniha byla upravena.');
    }

    // Smazání knihy
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Kniha byla smazána.');
    }
}
