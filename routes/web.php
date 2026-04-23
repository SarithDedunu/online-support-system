<?php

use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Customer routes
Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
Route::get('/tickets/search', [TicketController::class, 'search'])->name('tickets.search');
Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
Route::post('/tickets/{ticket}/reply', [TicketController::class, 'replyAsCustomer'])->name('tickets.reply.customer');

// Agent routes
Route::get('/agent/tickets', [TicketController::class, 'index'])->name('tickets.index');
Route::get('/agent/tickets/{ticket}', [TicketController::class, 'agentShow'])->name('tickets.agent.show');
Route::post('/agent/tickets/{ticket}/reply', [TicketController::class, 'replyAsAgent'])->name('tickets.reply.agent');

// Status update
Route::patch('/tickets/{ticket}/status', [TicketController::class, 'updateStatus'])
    ->name('tickets.updateStatus');