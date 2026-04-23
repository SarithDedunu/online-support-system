<!DOCTYPE html>
<html>
<head>
    <title>Agent Ticket Management</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background: #f4f6f8; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); margin-bottom: 20px; }
        .reply { border-left: 4px solid #ccc; padding: 10px; margin-bottom: 10px; background: #fafafa; }
        .customer { border-left-color: #2d89ef; }
        .agent { border-left-color: #28a745; }
        textarea { width: 100%; height: 100px; }
        button { padding: 8px 14px; margin-top: 10px; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #f0f0f0; width: 180px; }
        select { padding: 6px; }
    </style>
</head>
<body>

<div class="card">
    <h1>Agent Ticket View</h1>

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

    <table>
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
</div>

<div class="card">
    <h2>Replies</h2>

    @if($ticket->replies->count())
        @foreach($ticket->replies as $reply)
            <div class="reply {{ $reply->sender_type }}">
                <strong>{{ ucfirst($reply->sender_type) }}</strong><br>
                <small>{{ $reply->created_at }}</small>
                <p>{{ $reply->message }}</p>
            </div>
        @endforeach
    @else
        <p>No replies yet.</p>
    @endif
</div>

<div class="card">
    <h2>Add Agent Reply</h2>

    <form method="POST" action="{{ route('tickets.reply.agent', $ticket->id) }}">
        @csrf
        <textarea name="message" placeholder="Type agent reply"></textarea>
        <br><br>
        <button type="submit">Send Reply</button>
    </form>
</div>

<div class="card">
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

        <br>

        <button type="submit">Update Status</button>
    </form>
</div>

</body>
</html>