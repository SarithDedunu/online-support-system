use App\Models\Ticket;

public $ticket;

// Constructor gets ticket data
public function __construct(Ticket $ticket)
{
    $this->ticket = $ticket;
}

// Build email content
public function build()
{
    return $this->subject('New support ticket opened: ' . $this->ticket->ref)
        ->view('mails.ticket-created', [
            'ticket' => $this->ticket
        ]);
}