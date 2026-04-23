@extends('layouts.app')

@section('content')

<a href="/" class="btn btn-secondary mb-3">← Back</a>

<h3>Create Ticket</h3>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <strong>Please fix the following errors:</strong>
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('tickets.store') }}">
    @csrf

    <label>Name <span class="text-danger">*</span></label>
    <input class="form-control mb-2 @error('customer_name') is-invalid @enderror"
           name="customer_name" value="{{ old('customer_name') }}">
    @error('customer_name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    <label>Email <span class="text-danger">*</span></label>
    <input class="form-control mb-2 @error('email') is-invalid @enderror"
           name="email" value="{{ old('email') }}">
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    <label>Phone</label>
    <input class="form-control mb-2"
           name="phone" value="{{ old('phone') }}">

    <label>Subject <span class="text-danger">*</span></label>
    <input class="form-control mb-2 @error('subject') is-invalid @enderror"
           name="subject" value="{{ old('subject') }}">
    @error('subject')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    <label>Description <span class="text-danger">*</span></label>
    <textarea class="form-control mb-2 @error('description') is-invalid @enderror"
              name="description">{{ old('description') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    <button class="btn btn-primary">Submit</button>
</form>

@endsection