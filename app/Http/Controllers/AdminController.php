<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Ukáže administrátorský dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = Book::all();
        return view('admin', compact('products'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function edit($id)
    {
        $product = Book::findOrFail($id);
        return view('admin.edit', compact('product'));
    }

    public function destroy($id)
    {
        $product = Book::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Produkt byl úspěšně smazán.');
    }
}
