@extends('layouts.app')

@section('content')

<a href="{{ route('tickets.index') }}" class="btn btn-secondary mb-3">← Back</a>

<h3>Agent Ticket View</h3>

<div class="card mb-3">
    <div class="card-body">
        <h5>{{ $ticket->subject }}</h5>
        <p>{{ $ticket->description }}</p>
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