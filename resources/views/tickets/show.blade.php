@extends('layouts.app')

@section('content')

<a href="/" class="btn btn-secondary mb-3">← Back</a>

<h3 class="mb-4">Ticket Details</h3>

<div class="card shadow-sm mb-4">
    <div class="card-body p-0">

        <table class="table align-middle mb-0 modern-table">
            <tbody>

                <tr>
                    <th>Reference</th>
                    <td>{{ $ticket->ref }}</td>
                </tr>

                <tr>
                    <th>Customer</th>
                    <td>{{ $ticket->customer_name }}</td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td>{{ $ticket->email }}</td>
                </tr>

                <tr>
                    <th>Phone</th>
                    <td>{{ $ticket->phone ?: 'N/A' }}</td>
                </tr>

                <tr>
                    <th>Subject</th>
                    <td class="fw-semibold">{{ $ticket->subject }}</td>
                </tr>

                <tr>
                    <th>Description</th>
                    <td>{{ $ticket->description }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>
                        @if($ticket->status == 0)
                            <span class="badge rounded-pill bg-secondary px-3 py-2">New</span>
                        @elseif($ticket->status == 1)
                            <span class="badge rounded-pill bg-warning text-dark px-3 py-2">In Progress</span>
                        @elseif($ticket->status == 2)
                            <span class="badge rounded-pill bg-success px-3 py-2">Resolved</span>
                        @else
                            <span class="badge rounded-pill bg-dark px-3 py-2">Closed</span>
                        @endif
                    </td>
                </tr>

            </tbody>
        </table>

    </div>
</div>

<h5 class="mb-3">Replies</h5>

<div class="card shadow-sm mb-4">
    <div class="card-body">

        <h5 class="mb-3">Replies</h5>

        @if($ticket->replies->count())
            @foreach($ticket->replies as $reply)
                <div class="border rounded p-3 mb-2">
                    <div class="d-flex justify-content-between mb-2">
                        <strong>{{ ucfirst($reply->sender_type) }}</strong>
                        <small class="text-muted">{{ $reply->created_at }}</small>
                    </div>
                    <p class="mb-0">{{ $reply->message }}</p>
                </div>
            @endforeach
        @else
            <div class="alert alert-light border">No replies yet.</div>
        @endif

    </div>
</div>


<div class="card shadow-sm mb-4">
    <div class="card-body">

        <h5 class="mb-3">Add Reply</h5>

        <form method="POST" action="{{ route('tickets.reply.customer', $ticket->id) }}">
            @csrf

            <textarea
                name="message"
                class="form-control mb-3"
                rows="4"
                placeholder="Type your reply here..."
            ></textarea>

            <div class="d-flex justify-content-between">
                
                <button class="btn btn-primary">
                    Send Reply
                </button>

            </div>
        </form>

    </div>
</div>



@if($ticket->status != 3)
    <div class="card shadow-sm mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">

            <div>
                <h6 class="mb-1">Finished with this issue?</h6>
                <small class="text-muted">You can close the ticket</small>
            </div>

            <form method="POST" action="{{ route('tickets.close', $ticket->id) }}">
                @csrf
                @method('PATCH')

                <button type="submit" class="btn btn-danger">
                    Close Ticket
                </button>
            </form>

        </div>
    </div>
@endif

@endsection