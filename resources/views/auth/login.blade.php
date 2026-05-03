@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <h3 class="mb-4 text-center">Agent Login</h3>

    {{-- Error message --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('authenticate') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <button class="btn btn-success w-100">Login</button>
    </form>

    <hr class="my-4">

    <p class="text-center text-muted">
        Are you a customer? <a href="{{ route('tickets.create') }}">Create a support ticket</a>
    </p>

</div>

@endsection
