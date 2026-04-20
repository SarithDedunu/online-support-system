<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
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
}