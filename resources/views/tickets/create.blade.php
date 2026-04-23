@extends('layouts.app')

@section('content')

{{-- Back button to go to home page --}}
<a href="/" class="btn btn-secondary mb-3">← Back</a>

<h3>Create Ticket</h3>

{{-- Show success message after ticket is created --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- Show validation errors if any --}}
@if($errors->any())
    <div class="alert alert-danger">
        <strong>Please fix the following errors:</strong>
        <ul class="mb-0">
            {{-- Loop through all error messages --}}
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Ticket creation form --}}
<form method="POST" action="{{ route('tickets.store') }}">
    @csrf {{-- Protects form from CSRF attacks --}}

    {{-- Customer Name (required) --}}
    <label>Name <span class="text-danger">*</span></label>
    <input class="form-control mb-2 @error('customer_name') is-invalid @enderror"
           name="customer_name" value="{{ old('customer_name') }}">
    
    {{-- Show error for name --}}
    @error('customer_name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    {{-- Customer Email (required) --}}
    <label>Email <span class="text-danger">*</span></label>
    <input class="form-control mb-2 @error('email') is-invalid @enderror"
           name="email" value="{{ old('email') }}">
    
    {{-- Show error for email --}}
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    {{-- Phone (optional) --}}
    <label>Phone</label>
    <input class="form-control mb-2"
           name="phone" value="{{ old('phone') }}">

    {{-- Ticket Subject (required) --}}
    <label>Subject <span class="text-danger">*</span></label>
    <input class="form-control mb-2 @error('subject') is-invalid @enderror"
           name="subject" value="{{ old('subject') }}">
    
    {{-- Show error for subject --}}
    @error('subject')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    {{-- Ticket Description (required) --}}
    <label>Description <span class="text-danger">*</span></label>
    <textarea class="form-control mb-2 @error('description') is-invalid @enderror"
              name="description">{{ old('description') }}</textarea>
    
    {{-- Show error for description --}}
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    {{-- Submit button --}}
    <button class="btn btn-primary">Submit</button>
</form>

@endsection