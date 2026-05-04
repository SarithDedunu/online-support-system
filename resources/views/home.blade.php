@extends('layouts.app')

@section('content')

<div class="row justify-content-center text-center">
    <div class="col-lg-6 col-md-8">

        <h1 class="fw-bold mb-4">Support System</h1>

        {{-- Customer Section --}}
        <div class="mb-5">
            <h5 class="text-secondary mb-3">Customer Support</h5>
            
            <div class="mb-3">
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

        <hr class="my-4">

        {{-- Agent Section --}}
        <div>
            <h5 class="text-secondary mb-3">Agent Portal</h5>
            
            @auth
                <p class="mb-3 text-success">Welcome, <strong>{{ Auth::user()->name }}</strong>!</p>
                <div class="mb-2">
                    <a href="{{ route('tickets.index') }}" class="btn btn-info px-4 py-2">
                        View Tickets Dashboard
                    </a>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-outline-danger px-4 py-2">
                        Logout
                    </button>
                </form>
            @else
                <p class="text-muted mb-3">Support agents can login to access ticket management</p>
                <a href="{{ route('login') }}" class="btn btn-secondary px-4 py-2">
                    Agent Login
                </a>
            @endauth
        </div>

    </div>
</div>

@endsection
