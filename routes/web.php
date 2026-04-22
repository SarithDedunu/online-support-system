<?php

use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
Route::get('/tickets/search', [TicketController::class, 'search'])->name('tickets.search');
Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
Route::post('/tickets/{ticket}/replies', [TicketController::class, 'reply'])->name('tickets.reply');

Route::get('/agent/tickets', [TicketController::class, 'index'])->name('tickets.index');