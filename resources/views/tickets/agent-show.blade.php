@extends('layouts.app')

@section('content')

// Back button to go to agent ticket list
<a href="{{ route('tickets.index') }}" class="btn btn-secondary mb-3">← Back</a>

// Page title
<h3>Agent Ticket View</h3>

// Ticket details card
<div class="card mb-3">
    <div class="card-body p-0">

        // Table showing ticket information
        <table class="table mb-0">
            <tbody>

                // Ticket reference number
                <tr>
                    <th style="width: 30%">Reference</th>
                    <td>{{ $ticket->ref }}</td>
                </tr>

                // Customer name
                <tr>
                    <th>Customer Name</th>
                    <td>{{ $ticket->customer_name }}</td>
                </tr>

                // Customer email
                <tr>
                    <th>Email</th>
                    <td>{{ $ticket->email }}</td>
                </tr>

                // Phone (show N/A if empty)
                <tr>
                    <th>Phone</th>
                    <td>{{ $ticket->phone ?: 'N/A' }}</td>
                </tr>

                // Ticket subject
                <tr>
                    <th>Subject</th>
                    <td class="fw-semibold">{{ $ticket->subject }}</td>
                </tr>

                // Ticket description
                <tr>
                    <th>Description</th>
                    <td>{{ $ticket->description }}</td>
                </tr>

                // Ticket status with colored badge
                <tr>
                    <th>Status</th>
                    <td>
                        @if($ticket->status == 0)
                            <span class="badge bg-secondary">New</span>
                        @elseif($ticket->status == 1)
                            <span class="badge bg-warning text-dark">In Progress</span>
                        @elseif($ticket->status == 2)
                            <span class="badge bg-success">Resolved</span>
                        @else
                            <span class="badge bg-dark">Closed</span>
                        @endif
                    </td>
                </tr>

            </tbody>
        </table>

    </div>
</div>

// Replies section
<h5>Replies</h5>

// Loop through all replies
@foreach($ticket->replies as $reply)
<div class="card mb-2">
    <div class="card-body">
        // Show who sent the reply (customer/agent)
        <strong>{{ ucfirst($reply->sender_type) }}</strong>

        // Reply message
        <p>{{ $reply->message }}</p>
    </div>
</div>
@endforeach

<hr>

// Agent reply form
<h5>Agent Reply</h5>

<form method="POST" action="{{ route('tickets.reply.agent', $ticket->id) }}">
    @csrf

    // Input for reply message
    <textarea name="message" class="form-control mb-2"></textarea>

    // Submit button
    <button class="btn btn-primary">Send</button>
</form>

<hr>

// Status update section
<h5>Update Status</h5>

<form method="POST" action="{{ route('tickets.updateStatus', $ticket->id) }}">
    @csrf
    @method('PATCH')

    // Dropdown to select ticket status
    <select name="status" class="form-select mb-2">
        <option value="0">New</option>
        <option value="1">In Progress</option>
        <option value="2">Resolved</option>
        <option value="3">Closed</option>
    </select>

    // Submit status update
    <button class="btn btn-warning">Update</button>
</form>

@endsection