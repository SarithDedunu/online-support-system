<?php

use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;


// -------------------------
// HOME
// -------------------------

Route::get('/', function () {
    return view('home');
});


// -------------------------
// AUTHENTICATION ROUTES
// -------------------------

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// -------------------------
// CUSTOMER ROUTES (PUBLIC)
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
// AGENT ROUTES (PROTECTED)
// -------------------------

Route::middleware('auth')->group(function () {

    // Agent dashboard
    Route::get('/agent/tickets', [TicketController::class, 'index'])
        ->name('tickets.index');

    // View ticket details as agent
    Route::get('/agent/tickets/{ticket}', [TicketController::class, 'agentShow'])
        ->name('tickets.agent.show');

    // Agent sends reply
    Route::post('/agent/tickets/{ticket}/reply', [TicketController::class, 'replyAsAgent'])
        ->name('tickets.reply.agent');

    // Agent updates status
    Route::patch('/agent/tickets/{ticket}/status', [TicketController::class, 'updateStatus'])
        ->name('tickets.updateStatus');

    // Agent assigns ticket to self
    Route::post('/agent/tickets/{ticket}/assign', [TicketController::class, 'assignToMe'])
        ->name('tickets.assignToMe');

});
