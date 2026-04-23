@extends('layouts.app')

@section('content')

<div class="row justify-content-center text-center">
    <div class="col-lg-6 col-md-8">

        <h1 class="fw-bold mb-4">Support System</h1>

        <div class="mb-4">
            <a href="{{ route('tickets.create') }}" class="btn btn-primary px-4 py-2">
                Open New Ticket
            </a>
        </div>

        <div class="mb-3">
            <p class="text-muted mb-2">Check the status of your ticket:</p>
        </div>

        <form action="{{ route('tickets.search') }}" method="GET">
            <div class="d-flex gap-2 justify-content-center">
                <input
                    type="text"
                    name="reference"
                    class="form-control"
                    style="max-width: 300px;"
                    placeholder="Enter ticket reference"
                >
                <button class="btn btn-success px-3">
                    View Ticket
                </button>
            </div>
        </form>

    </div>
</div>

@endsection