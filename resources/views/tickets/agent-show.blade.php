@extends('layouts.app')

@section('content')

<a href="{{ route('tickets.index') }}" class="btn btn-secondary mb-3">← Back</a>

<h3>Agent Ticket View</h3>

<div class="card mb-3">
    <div class="card-body p-0">

        <table class="table mb-0">
            <tbody>

                <tr>
                    <th style="width: 30%">Reference</th>
                    <td>{{ $ticket->ref }}</td>
                </tr>

                <tr>
                    <th>Customer Name</th>
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

<h5>Replies</h5>

@foreach($ticket->replies as $reply)
<div class="card mb-2">
    <div class="card-body">
        <strong>{{ ucfirst($reply->sender_type) }}</strong>
        <p>{{ $reply->message }}</p>
    </div>
</div>
@endforeach

<hr>

<h5>Agent Reply</h5>

<form method="POST" action="{{ route('tickets.reply.agent', $ticket->id) }}">
    @csrf
    <textarea name="message" class="form-control mb-2"></textarea>
    <button class="btn btn-primary">Send</button>
</form>

<hr>

<h5>Update Status</h5>

<form method="POST" action="{{ route('tickets.updateStatus', $ticket->id) }}">
    @csrf
    @method('PATCH')

    <select name="status" class="form-select mb-2">
        <option value="0">New</option>
        <option value="1">In Progress</option>
        <option value="2">Resolved</option>
        <option value="3">Closed</option>
    </select>

    <button class="btn btn-warning">Update</button>
</form>

@endsection