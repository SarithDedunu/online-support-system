<?php

use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

// -------------------------
// HOME
// -------------------------

Route::get('/', function () {
    return view('home');
});


// -------------------------
// CUSTOMER ROUTES
// -------------------------

Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');

Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');

Route::get('/tickets/search', [TicketController::class, 'search'])->name('tickets.search');

Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');

Route::post('/tickets/{ticket}/reply', [TicketController::class, 'replyAsCustomer'])->name('tickets.reply.customer');

// Customer closes ticket
Route::patch('/tickets/{ticket}/close', [TicketController::class, 'closeTicket'])
    ->name('tickets.close');


// -------------------------
// AGENT ROUTES
// -------------------------

Route::middleware(['is.agent'])->group(function () {

    // Agent dashboard
    Route::get('/agent/tickets', [TicketController::class, 'index'])
        ->name('tickets.index');

    // View ticket (agent)
    Route::get('/agent/tickets/{ticket}', [TicketController::class, 'agentShow'])
        ->name('tickets.agent.show');

    // Agent reply
    Route::post('/agent/tickets/{ticket}/reply', [TicketController::class, 'replyAsAgent'])
        ->name('tickets.reply.agent');

});


// -------------------------
// STATUS MANAGEMENT
// -------------------------

// Agent updates status
Route::patch('/tickets/{ticket}/status', [TicketController::class, 'updateStatus'])
    ->name('tickets.updateStatus');