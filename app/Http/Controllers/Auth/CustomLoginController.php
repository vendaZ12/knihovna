<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validace vstupu
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Kontrola administrátorských práv
            if ($user->role === 'admin') {
                return redirect()->route('admin');
            } else {
                return redirect()->route('dashboard'); // nebo jiná cesta pro běžné uživatele
            }
        } else {
            return back()->withErrors(['message' => 'Neplatné přihlašovací údaje'])->withInput();
        }
    }
}
