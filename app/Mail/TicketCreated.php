<?php

namespace App\Mail;

use App\Models\Ticket; // Ticket model used to pass ticket data to email
use Illuminate\Bus\Queueable; // Allows this mail to be pushed to queue
use Illuminate\Contracts\Queue\ShouldQueue; // Marks this mail as queueable
use Illuminate\Mail\Mailable; // Base Laravel email class
use Illuminate\Queue\SerializesModels; // Safely serializes model data for queue

class TicketCreated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $ticket; // Stores ticket data for the email view

    // Receive ticket data when creating the email
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    // Build email subject and body
    public function build()
    {
        return $this->subject('New support ticket opened: ' . $this->ticket->ref)
                    ->view('mails.ticket-created', [
                        'ticket' => $this->ticket,
                    ]);
    }
}