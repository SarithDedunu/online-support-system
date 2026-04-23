@extends('layouts.app')

@section('content')

{{-- Back button --}}
<a href="/" class="btn btn-secondary mb-3">← Back</a>

<h3>Agent Ticket List</h3>

{{-- Search input --}}
<form method="GET" class="mb-3">
    <input type="text" name="search" class="form-control" placeholder="Search tickets">
</form>

<table class="table table-bordered">

    {{-- Table header --}}
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

        {{-- Loop tickets --}}
        @foreach($tickets as $ticket)
        <tr>
            <td>{{ $ticket->ref }}</td>
            <td>{{ $ticket->subject }}</td>
            <td>{{ $ticket->email }}</td>

            {{-- Status badge --}}
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

            {{-- Open ticket --}}
            <td>
                <a href="{{ route('tickets.agent.show', $ticket->id) }}" class="btn btn-sm btn-primary">
                    Open
                </a>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

{{-- Pagination --}}
{{ $tickets->links() }}

@endsection