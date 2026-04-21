<?php

use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');

Route::get('/tickets/search', [TicketController::class, 'search'])->name('tickets.search');
<<<<<<< HEAD
Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');

Route::post('/tickets/{ticket}/replies', [TicketController::class, 'reply'])->name('tickets.reply');
=======
Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
>>>>>>> 9ec915e15be4861c5c5869446f4dec50eb1a16f8
