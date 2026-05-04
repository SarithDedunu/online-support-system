<?php

use App\Http\Controllers\API\V1\TicketsController;
use Illuminate\Support\Facades\Route;

// -------------------------
// API V1 TICKET ROUTES
// -------------------------

Route::prefix('v1')->group(function () {

    // Get ticket list
    Route::get('/tickets', [TicketsController::class, 'index']);

    // Create new ticket
    Route::post('/tickets', [TicketsController::class, 'store']);

    // Get one ticket
    Route::get('/tickets/{ticket}', [TicketsController::class, 'show']);

});