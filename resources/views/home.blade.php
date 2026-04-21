<!DOCTYPE html>
<html>
<head>
    <title>Support System</title>
</head>
<body>

<h1>Support System</h1>

<a href="{{ route('tickets.create') }}">Open New Ticket</a>

<hr>

<<<<<<< HEAD
<!-- Error Message -->
@if(session('error'))
    <p style="color:red;">{{ session('error') }}</p>
@endif

<!-- Search Form -->

<h3>Check Your Ticket</h3>

<form action="{{ route('tickets.search') }}" method="GET">
    <input type="text" name="reference" placeholder="Enter ticket reference">
    <button type="submit">Search</button>
</form>

</body>
</html>