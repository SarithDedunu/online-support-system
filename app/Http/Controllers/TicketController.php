<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|max:200',
            'email' => 'required|email',
            'subject' => 'required|max:255',
            'description' => 'required',
            'phone' => 'nullable|max:50',
        ]);

        $ticket = Ticket::create([
            'customer_name' => $request->customer_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'description' => $request->description,
            'ref' => strtoupper(Str::random(10)),
            'status' => 0,
        ]);

        return redirect()
            ->route('tickets.create')
            ->with('success', 'Ticket created successfully. Your reference is: ' . $ticket->ref);
    }

    public function search(Request $request)
    {
        $ticket = Ticket::where('ref', $request->query('reference'))->first();

        if ($ticket) {
            return redirect()->route('tickets.show', $ticket->id);
        }

        return redirect()->back()->with('error', 'Ticket not found');
    }


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


    public function show(Ticket $ticket)
    {
        $ticket->load('replies');
        return view('tickets.show', compact('ticket'));
    }

    public function agentShow(Ticket $ticket)
    {
        $ticket->load('replies');

        return view('tickets.agent-show', compact('ticket'));
    }

    public function index(Request $request)
    {
        $tickets = Ticket::latest()->paginate(10);

        return view('tickets.index', compact('tickets'));

    }

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

}