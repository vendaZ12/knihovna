<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ReservationController;
use App\Models\Book;
use App\Models\Author;
use App\Http\Controllers\Auth\CustomLoginController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


require __DIR__.'/auth.php';


Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/login', [CustomLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [CustomLoginController::class, 'login'])->name('login.perform');

Route::get('/admin', function () {
    return view('admin');
})->middleware('auth')->name('admin');


Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    Route::resource('books', BookController::class);
    Route::resource('authors', AuthorController::class);
    Route::resource('reservations', ReservationController::class);

});


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/search', [DashboardController::class, 'searchBooks'])->name('dashboard.search');
Route::post('/dashboard/reserve/{book}', [DashboardController::class, 'reserveBook'])->name('dashboard.reserve');
Route::get('/dashboard/history', [DashboardController::class, 'reservationHistory'])->name('dashboard.history');

Route::delete('/cancel-reservation/{reservation}', [ReservationController::class, 'cancel'])->name('dashboard.cancelReservation');
