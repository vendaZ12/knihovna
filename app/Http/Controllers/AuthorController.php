<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // Zobrazení seznamu autorů
    public function index()
    {
        $authors = Author::all();
        return view('admin.authors.index', compact('authors'));
    }

    // Formulář pro přidání nového autora
    public function create()
    {
        return view('admin.authors.create');
    }

    // Uložení nového autora
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:authors,name',
        ]);

        Author::create($request->all());
        return redirect()->route('admin.authors.index')->with('success', 'Autor byl přidán.');
    }

    // Zobrazení detailu autora
    public function show($id)
    {
        $author = Author::findOrFail($id);
        return view('admin.authors.show', compact('author'));
    }

    // Formulář pro úpravu autora
    public function edit($id)
    {
        $author = Author::findOrFail($id);
        return view('admin.authors.edit', compact('author'));
    }

    // Uložení změn autora
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:authors,name,' . $id,
        ]);

        $author = Author::findOrFail($id);
        $author->update($request->all());
        return redirect()->route('admin.authors.index')->with('success', 'Autor byl upraven.');
    }

    // Smazání autora
    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();
        return redirect()->route('admin.authors.index')->with('success', 'Autor byl smazán.');
    }
}
