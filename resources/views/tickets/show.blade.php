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
        <td>{{ $ticket->status }}</td>
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

<h2>Add Reply</h2>

<form action="{{ route('tickets.reply', $ticket->id) }}" method="POST">
    @csrf

    <div>
        <label>Sender Type</label><br>
        <select name="sender_type">
            <option value="customer">Customer</option>
            <option value="agent">Agent</option>
        </select>
    </div>

    <br>

    <div>
        <label>Message</label><br>
        <textarea name="message"></textarea>
    </div>

    <br>

    <button type="submit">Send Reply</button>
</form>

</body>
</html>