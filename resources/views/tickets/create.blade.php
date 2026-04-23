@extends('layouts.app')

@section('content')

<a href="/" class="btn btn-secondary mb-3">← Back</a>

<h3>Create Ticket</h3>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{ route('tickets.store') }}">
    @csrf

    <input class="form-control mb-2" name="customer_name" placeholder="Name">
    <input class="form-control mb-2" name="email" placeholder="Email">
    <input class="form-control mb-2" name="phone" placeholder="Phone">
    <input class="form-control mb-2" name="subject" placeholder="Subject">
    <textarea class="form-control mb-2" name="description" placeholder="Description"></textarea>

    <button class="btn btn-primary">Submit</button>
</form>

@endsection