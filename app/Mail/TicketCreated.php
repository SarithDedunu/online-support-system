<?php

namespace App\Mail;

use App\Models\Ticket; // Imports the Ticket model and allows to use Ticket class
use Illuminate\Bus\Queueable; // Imports the Queueable trait, which allows the email to be queued for later sending
use Illuminate\Mail\Mailable; // Base class for all email messages in Laravel
use Illuminate\Contracts\Queue\ShouldQueue; // Interface that tells Laravel this mail should be sent using a queue.
use Illuminate\Queue\SerializesModels; // Helps serialize Eloquent models, Instead of storing full object data, it stores the model ID and reloads it later.

class TicketCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;

     // Store ticket data for the email
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    // Build the email content
    public function build()
    {
        return $this->subject('New support ticket opened: ' . $this->ticket->ref)
                    ->view('mails.ticket-created', [
                        'ticket' => $this->ticket
                    ]);
    }
}