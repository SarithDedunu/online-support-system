<h1>Agent Ticket Management</h1>

<form action="{{ route('tickets.index') }}" method="GET">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search">
    <button type="submit">Search</button>
</form>

<br>

@if($tickets->count())
<table border="1" cellpadding="8">
    <tr>
        <th>Reference</th>
        <th>Subject</th>
        <th>Name</th>
        <th>Email</th>
        <th>Status</th>
        <th>Created</th>
        <th>Action</th>
    </tr>

    @foreach($tickets as $ticket)
    <tr>
        <td>{{ $ticket->ref }}</td>
        <td>{{ $ticket->subject }}</td>
        <td>{{ $ticket->customer_name }}</td>
        <td>{{ $ticket->email }}</td>
        <td>
            @if($ticket->status == 0)
                New
            @elseif($ticket->status == 1)
                In Progress
            @elseif($ticket->status == 2)
                Resolved
            @else
                Closed
            @endif
        </td>
        <td>{{ $ticket->created_at }}</td>
        <td>
            <a href="{{ route('tickets.show', $ticket->id) }}">Open</a>
        </td>
    </tr>
    @endforeach
</table>

<br>

{{ $tickets->links() }}

@else
<p>No tickets found</p>
@endif