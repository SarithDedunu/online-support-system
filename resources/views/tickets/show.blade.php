<!DOCTYPE html>
<html>
<head>
    <title>Ticket Details</title>
</head>
<body>

<h1>Ticket Details</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

@if($errors->any())
    <div style="color: red;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<table border="1">
    <tr>
        <th>Reference</th>
        <td>{{ $ticket->ref }}</td>
    </tr>
    <tr>
        <th>Name</th>
        <td>{{ $ticket->customer_name }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $ticket->email }}</td>
    </tr>
    <tr>
        <th>Phone</th>
        <td>{{ $ticket->phone }}</td>
    </tr>
    <tr>
        <th>Subject</th>
        <td>{{ $ticket->subject }}</td>
    </tr>
    <tr>
        <th>Description</th>
        <td>{{ $ticket->description }}</td>
    </tr>
    <tr>
        <th>Status</th>
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
    </tr>
</table>

<hr>

<h2>Replies</h2>

@if($ticket->replies->count())
    @foreach($ticket->replies as $reply)
        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
            <strong>{{ ucfirst($reply->sender_type) }}</strong><br>
            <small>{{ $reply->created_at }}</small>
            <p>{{ $reply->message }}</p>
        </div>
    @endforeach
@else
    <p>No replies yet.</p>
@endif

<hr>

<h3>Add Reply</h3>

<form method="POST" action="{{ route('tickets.reply', $ticket->id) }}">
    @csrf

    <input type="hidden" name="sender_type" value="agent">

    <textarea name="message" placeholder="Type your reply"></textarea>

    <br><br>

    <button type="submit">Send Reply</button>
</form>

<hr>



<h2>Update Status</h2>

<form method="POST" action="{{ route('tickets.updateStatus', $ticket->id) }}">
    @csrf
    @method('PATCH')

    <select name="status">
        <option value="0" {{ $ticket->status == 0 ? 'selected' : '' }}>New</option>
        <option value="1" {{ $ticket->status == 1 ? 'selected' : '' }}>In Progress</option>
        <option value="2" {{ $ticket->status == 2 ? 'selected' : '' }}>Resolved</option>
        <option value="3" {{ $ticket->status == 3 ? 'selected' : '' }}>Closed</option>
    </select>

    <button type="submit">Update Status</button>
</form>


<hr>

<h2>Close Ticket</h2>

<form method="POST" action="{{ route('tickets.updateStatus', $ticket->id) }}">
    @csrf
    @method('PATCH')

    <input type="hidden" name="status" value="3">

    <button type="submit">Close Ticket</button>
</form>

</body>
</html>