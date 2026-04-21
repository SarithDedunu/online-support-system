<!DOCTYPE html>
<html>
<head>
    <title>Ticket Details</title>
</head>
<body>

<h1>Ticket Details</h1>

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
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

</body>
</html>