<!DOCTYPE html>
<html>
<head>
    <title>Open Support Ticket</title>
</head>
<body>
    <h1>Open Support Ticket</h1>

    @if(session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
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

    <form action="{{ route('tickets.store') }}" method="POST">
        @csrf

        <div>
            <label>Your Name</label><br>
            <input type="text" name="customer_name" value="{{ old('customer_name') }}">
        </div>

        <br>

        <div>
            <label>Email</label><br>
            <input type="text" name="email" value="{{ old('email') }}">
        </div>

        <br>

        <div>
            <label>Phone</label><br>
            <input type="text" name="phone" value="{{ old('phone') }}">
        </div>

        <br>

        <div>
            <label>Subject</label><br>
            <input type="text" name="subject" value="{{ old('subject') }}">
        </div>

        <br>

        <div>
            <label>Description</label><br>
            <textarea name="description">{{ old('description') }}</textarea>
        </div>

        <br>

        <button type="submit">Submit Ticket</button>
    </form>
</body>
</html>