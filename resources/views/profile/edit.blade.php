@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <h2>Edit Profile</h2>

    @if(session('status') === 'profile-updated')
        <div class="alert alert-success">Profile updated successfully.</div>
    @endif

    <form method="POST" class="ajax-form" action="{{ route('profile.update') }}">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control">
        </div>

        <button class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection
@push('scripts')
    <script src="{{asset('assets/js/common-ajax.js')}}"></script>
@endpush

