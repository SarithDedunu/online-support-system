<?php

namespace App\Http\Controllers\API\V1;

use App\Events\TicketCreatedEvent; // Dispatches event after ticket creation
use App\Http\Controllers\Controller; // Base controller class
use App\Models\Ticket; // Ticket model for database operations
use Illuminate\Http\Request; // Handles incoming API request data
use Illuminate\Support\Str; // Generates random ticket reference

class TicketsController extends Controller
{
    // -------------------------
    // CREATE NEW TICKET API
    // POST /api/v1/tickets
    // -------------------------

    public function store(Request $request)
    {
        // Validate JSON request data before saving
        $validated = $request->validate([
            'customer_name' => 'required|max:200',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'subject' => 'required|max:255',
            'description' => 'required',
        ]);

        // Add system-generated fields
        $validated['ref'] = strtoupper(Str::random(10));
        $validated['status'] = 0; // 0 = New ticket

        // Create ticket using Eloquent
        $ticket = Ticket::create($validated);

        // Dispatch event to trigger email notification listener
        TicketCreatedEvent::dispatch($ticket);

        // Return JSON response to API client
        return response()->json([
            'data' => $ticket,
            'message' => 'Your ticket was created successfully. Please save the reference number.',
        ], 201);
    }

    // -------------------------
    // GET TICKET LIST API
    // GET /api/v1/tickets
    // -------------------------

    public function index(Request $request)
    {
        // Start ticket query
        $query = Ticket::query();

        // Search by reference, customer name, email, phone, or subject
        if ($request->filled('search')) {
            $search = $request->query('search');

            $query->where(function ($q) use ($search) {
                $q->where('ref', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        // Filter by status if provided
        if ($request->filled('status')) {
            $query->where('status', $request->query('status'));
        }

        // Allowed sorting columns to avoid unsafe orderBy input
        $allowedSorts = ['created_at', 'updated_at', 'customer_name', 'status'];

        // Select sort column, default is created_at
        $sort = in_array($request->query('sort'), $allowedSorts)
            ? $request->query('sort')
            : 'created_at';

        // Select sort direction, default is desc
        $direction = $request->query('direction') === 'asc' ? 'asc' : 'desc';

        // Apply sorting
        $query->orderBy($sort, $direction);

        // Paginate API response
        $tickets = $query
            ->paginate($request->query('per_page', 10))
            ->withQueryString();

        // Return ticket list as JSON
        return response()->json([
            'data' => $tickets,
            'message' => 'Tickets retrieved successfully.',
        ]);
    }

    // -------------------------
    // GET SINGLE TICKET API
    // GET /api/v1/tickets/{ticket}
    // -------------------------

    public function show(Ticket $ticket)
    {
        // Load ticket replies with the ticket
        $ticket->load('replies');

        // Return single ticket as JSON
        return response()->json([
            'data' => $ticket,
            'message' => 'Ticket retrieved successfully.',
        ]);
    }
}