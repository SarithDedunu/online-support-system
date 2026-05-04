<?php

namespace App\Listeners;

use App\Events\TicketCreatedEvent; // Event that triggers this listener
use App\Mail\TicketCreated; // Mailable used to build the email
use Illuminate\Support\Facades\Mail; // Laravel mail facade

class SendTicketCreatedMail
{
    // Runs when TicketCreatedEvent is dispatched
    public function handle(TicketCreatedEvent $event): void
    {
        // Queue email to the customer
        Mail::to($event->ticket->email)
            ->queue(new TicketCreated($event->ticket));
    }
}