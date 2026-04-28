@extends('layouts.app')

@section('content')

<a href="/" class="btn btn-secondary mb-3">← Back</a>

<h3 class="mb-4">Agent Ticket List</h3>

{{-- Search, filter and sort --}}
<div class="card card-body mb-4">
    <form method="GET" action="{{ route('tickets.index') }}">
        <div class="row g-2">

            {{-- Search input --}}
            <div class="col-md-4">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Reference, name, email or phone"
                    value="{{ request('search') }}"
                >
            </div>

            {{-- Status filter --}}
            <div class="col-md-2">
                <select name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>New</option>
                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>In Progress</option>
                    <option value="2" {{ request('status') === '2' ? 'selected' : '' }}>Resolved</option>
                    <option value="3" {{ request('status') === '3' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>

            {{-- Sort column --}}
            <div class="col-md-2">
                <select name="sort" class="form-select">
                    <option value="created_at">Opened Time</option>
                    <option value="customer_name">Customer Name</option>
                    <option value="updated_at">Last Updated</option>
                    <option value="status">Status</option>
                </select>
            </div>

            {{-- Sort direction --}}
            <div class="col-md-2">
                <select name="direction" class="form-select">
                    <option value="desc">Descending</option>
                    <option value="asc">Ascending</option>
                </select>
            </div>

            {{-- Submit --}}
            <div class="col-md-2 d-grid">
                <button class="btn btn-success">Apply</button>
            </div>

        </div>
    </form>
</div>

@if($tickets->count())
    <table class="table table-bordered align-middle">
        <thead class="table-success">
            <tr>
                <th>Reference</th>
                <th>Customer</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Opened Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->ref }}</td>
                    <td>{{ $ticket->customer_name }}</td>
                    <td>{{ $ticket->email }}</td>
                    <td>{{ $ticket->phone ?: 'N/A' }}</td>
                    <td>{{ $ticket->created_at->format('d/M/Y H:i:s') }}</td>
                    <td>
                        @if($ticket->status == 0)
                            <span class="badge bg-secondary">New</span>
                        @elseif($ticket->status == 1)
                            <span class="badge bg-warning text-dark">In Progress</span>
                        @elseif($ticket->status == 2)
                            <span class="badge bg-success">Resolved</span>
                        @else
                            <span class="badge bg-dark">Closed</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('tickets.agent.show', $ticket->id) }}" class="btn btn-sm btn-primary">
                            Open
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination with result summary --}}
    {{-- Pagination --}}
<div class="d-flex justify-content-end mt-4">
    {{ $tickets->links('pagination::bootstrap-5') }}
</div>

@else
    <div class="alert alert-info">
        No tickets found.
    </div>
@endif

@endsection


