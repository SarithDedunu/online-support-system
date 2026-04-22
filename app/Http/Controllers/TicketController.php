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


    public function reply(Request $request, Ticket $ticket)
    {
        $request->validate([
            'message' => 'required',
            'sender_type' => 'required|in:customer,agent',
        ]);

        TicketReply::create([
            'ticket_id' => $ticket->id,
            'sender_type' => $request->sender_type,
            'message' => $request->message,
        ]);

        return redirect()
            ->route('tickets.show', $ticket->id)
            ->with('success', 'Reply added successfully.');
    }

    public function show(Ticket $ticket)
    {
        $ticket->load('replies');
        
        return view('tickets.show', compact('ticket'));
    }

    public function index(Request $request)
    {
        $tickets = Ticket::latest()->paginate(10);

        return view('tickets.index', compact('tickets'));

    }

}