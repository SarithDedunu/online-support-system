<?php

namespace App\Http\Controllers;

use App\Events\TicketCreatedEvent;
use App\Mail\TicketCreated;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TicketController extends Controller
{

    // -------------------------
    // TICKET CREATION (CUSTOMER)
    // -------------------------

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'customer_name' => 'required|max:200',
            'email' => 'required|email',
            'subject' => 'required|max:255',
            'description' => 'required',
            'phone' => 'required|digits:10',
        ]);

        // Create ticket
        $ticket = Ticket::create([
            'customer_name' => $request->customer_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'description' => $request->description,
            'ref' => strtoupper(Str::random(10)),
            'status' => 0,
        ]);
        
        // Dispatch event after ticket is created
        TicketCreatedEvent::dispatch($ticket);

        return redirect()
            ->route('tickets.show', $ticket->id)
            ->with('success', 'Ticket created successfully. Your reference is: ' . $ticket->ref);
    }

    // -------------------------
    // TICKET SEARCH (CUSTOMER)
    // -------------------------

    public function search(Request $request)
    {
        $ticket = Ticket::where('ref', $request->query('reference'))->first();

        if ($ticket) {
            return redirect()->route('tickets.show', $ticket->id);
        }

        return redirect()->back()->with('error', 'Ticket not found');
    }

    // -------------------------
    // REPLIES
    // -------------------------

    // Customer reply
    public function replyAsCustomer(Request $request, Ticket $ticket)
    {
        $request->validate([
            'message' => 'required',
        ]);

        TicketReply::create([
            'ticket_id' => $ticket->id,
            'sender_type' => 'customer',
            'message' => $request->message,
        ]);

        return redirect()
            ->route('tickets.show', $ticket->id)
            ->with('success', 'Reply added successfully.');
    }

    // Agent reply
    public function replyAsAgent(Request $request, Ticket $ticket)
    {
        $request->validate([
            'message' => 'required',
        ]);

        TicketReply::create([
            'ticket_id' => $ticket->id,
            'sender_type' => 'agent',
            'message' => $request->message,
        ]);

        return redirect()
            ->route('tickets.agent.show', $ticket->id)
            ->with('success', 'Agent reply was sent successfully.');
    }

    // -------------------------
    // VIEW TICKETS
    // -------------------------

    // Customer view
    public function show(Ticket $ticket)
    {
        $ticket->load('replies');

        return view('tickets.show', compact('ticket'));
    }

    // Agent view
    public function agentShow(Ticket $ticket)
    {
        $ticket->load('replies');

        return view('tickets.agent-show', compact('ticket'));
    }

    // -------------------------
    // AGENT DASHBOARD
    // -------------------------

public function index(Request $request)
{
    // Start ticket query - get all tickets
    $query = Ticket::query();

    // Search by reference, customer name, email, or subject
    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('ref', 'like', "%{$search}%")
              ->orWhere('customer_name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('subject', 'like', "%{$search}%");
        });
    }

    // Filter by status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Filter by assignment (optional - show all tickets to all agents)
    if ($request->filled('assigned')) {
        if ($request->assigned === 'me') {
            $query->where('assigned_to', auth()->id());
        } elseif ($request->assigned === 'unassigned') {
            $query->whereNull('assigned_to');
        }
    }

    // Sort tickets
    if ($request->filled('sort')) {
        $direction = $request->get('direction', 'desc');
        $query->orderBy($request->sort, $direction);
    } else {
        $query->latest();
    }

    // Paginate results
    $tickets = $query->paginate(5)->withQueryString();

    return view('tickets.index', compact('tickets'));
}

    // -------------------------
    // STATUS MANAGEMENT
    // -------------------------

    // Agent updates status
    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:0,1,2,3',
        ]);

        $ticket->update([
            'status' => $request->status,
        ]);

        return redirect()
            ->route('tickets.show', $ticket->id)
            ->with('success', 'Ticket status updated successfully.');
    }

    // Customer closes ticket
    public function closeTicket(Ticket $ticket)
    {
        if ($ticket->status == 3) {
            return redirect()
                ->route('tickets.show', $ticket->id)
                ->with('error', 'This ticket is already closed.');
        }

        $ticket->update([
            'status' => 3,
        ]);

        return redirect()
            ->route('tickets.show', $ticket->id)
            ->with('success', 'Your ticket was closed successfully.');
    }

    // -------------------------
    // TICKET ASSIGNMENT
    // -------------------------

    // Agent assigns ticket to themselves
    public function assignToMe(Request $request, Ticket $ticket)
    {
        $ticket->update([
            'assigned_to' => Auth::id(),
        ]);

        return redirect()
            ->route('tickets.agent.show', $ticket->id)
            ->with('success', 'Ticket assigned to you successfully.');
    }
}