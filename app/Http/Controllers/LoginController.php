<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Zobrazit přihlašovací formulář.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        return view('auth.login');
    }
}
