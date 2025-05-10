<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\VenueController;
use Illuminate\Support\Facades\Auth;

// Home/Landing Page
Route::get('/', function () {
    return redirect()->route('matches.index');
});

// Public Routes - accessible to all users
Route::get('/matches', [MatchController::class, 'index'])->name('matches.index');
Route::get('/matches/{match}', [MatchController::class, 'show'])->name('matches.show');

// Authentication Routes (provided by Laravel)
// Auth::routes();

// Protected Routes - require authentication
Route::middleware(['auth'])->group(function () {
    // User dashboard

    // Ticket management routes
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/matches/{match}/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/matches/{match}/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::patch('/tickets/{ticket}/cancel', [TicketController::class, 'cancelReservation'])->name('tickets.cancel');
    Route::post('/tickets/{ticket}/payment', [TicketController::class, 'processPayment'])->name('tickets.payment');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Admin dashboard
    Route::get('/', function () {
        return redirect()->route('admin.matches.index');
    });

    // Match management
    Route::get('/matches', [MatchController::class, 'adminIndex'])->name('matches.index');
    Route::get('/matches/create', [MatchController::class, 'create'])->name('matches.create');
    Route::post('/matches', [MatchController::class, 'store'])->name('matches.store');
    Route::get('/matches/{match}/edit', [MatchController::class, 'edit'])->name('matches.edit');
    Route::put('/matches/{match}', [MatchController::class, 'update'])->name('matches.update');
    Route::delete('/matches/{match}', [MatchController::class, 'destroy'])->name('matches.destroy');

    // // Team management
    Route::resource('teams', TeamController::class);

    // // Venue management
    Route::resource('venues', VenueController::class);

    // Ticket reports and management
    Route::get('/tickets', [TicketController::class, 'adminIndex'])->name('tickets.index');
    Route::get('/tickets/{ticket}', [TicketController::class, 'adminShow'])->name('tickets.show');
    Route::patch('/tickets/{ticket}/status', [TicketController::class, 'updateStatus'])->name('tickets.status');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
