<?php

namespace App\Events;

use App\Models\Ticket; // Ticket model used to pass created ticket data
use Illuminate\Foundation\Events\Dispatchable; // Allows event to be dispatched
use Illuminate\Queue\SerializesModels; // Safely serializes model data if queued

class TicketCreatedEvent
{
    use Dispatchable, SerializesModels;

    public Ticket $ticket; // Stores created ticket data

    // Receive ticket data when event is disppatched
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }
}