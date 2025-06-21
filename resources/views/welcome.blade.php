{{-- @extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="text-center">
        <h1 class="display-5">Welcome to EMS Finance Portal</h1>

        @auth
            <p class="lead mt-4">Hello, {{ auth()->user()->name }}!</p>

            @if(auth()->user()->role === 'finance')
                <a href="{{ route('finance.dashboard') }}" class="btn btn-primary mt-3">Go to Finance Dashboard</a>
            @else
                <p class="mt-3 text-muted">You are logged in, but not authorized for the Finance dashboard.</p>
            @endif

            <form action="{{ url('/logout') }}" method="POST" class="mt-3">
                @csrf
                <button class="btn btn-outline-danger">Logout</button>
            </form>
        @else
            <p class="lead">Please <a href="{{ url('/login') }}">login</a> to continue.</p>
        @endauth
    </div>
</div>
@endsection --}}
@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="text-center">
        <h1 class="display-5">Welcome to EMS Finance Portal</h1>
        @auth
            <p class="lead mt-4">Hello, {{ auth()->user()->name }}!</p>

            @if(auth()->user()->role === 'finance')
                <a href="{{ route('finance.dashboard') }}" class="btn btn-primary mt-3">Go to Finance Dashboard</a>
            @else
                <p class="mt-3 text-muted">You are logged in, but not authorized for the Finance dashboard.</p>
            @endif

            <form action="{{ url('/logout') }}" method="POST" class="mt-3">
                @csrf
                <button class="btn btn-outline-danger">Logout</button>
            </form>
        @else
            <p class="lead mt-4">Please <a href="{{ url('/login') }}">login</a> to continue.</p>
        @endauth
    </div>
</div>
@endsection
