@extends('layouts.app')

@section('content')

<a href="/" class="btn btn-secondary mb-3">← Back</a>

<h3>Agent Ticket List</h3>

<form method="GET" class="mb-3">
    <input type="text" name="search" class="form-control" placeholder="Search tickets">
</form>

<table class="table table-bordered">
    <thead class="table-success">
        <tr>
            <th>Ref</th>
            <th>Subject</th>
            <th>Email</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        @foreach($tickets as $ticket)
        <tr>
            <td>{{ $ticket->ref }}</td>
            <td>{{ $ticket->subject }}</td>
            <td>{{ $ticket->email }}</td>
            <td>
                @if($ticket->status == 0) <span class="badge bg-secondary">New</span>
                @elseif($ticket->status == 1) <span class="badge bg-warning">In Progress</span>
                @elseif($ticket->status == 2) <span class="badge bg-success">Resolved</span>
                @else <span class="badge bg-dark">Closed</span>
                @endif
            </td>
            <td>
                <a href="{{ route('tickets.agent.show', $ticket->id) }}" class="btn btn-sm btn-primary">
                    Open
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $tickets->links() }}

@endsection