@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <h2>Request New Payment Provider</h2>

    <form method="POST" class="ajax-form" action="{{ route('finance.store-provider-request') }}">
        @csrf

        <div class="mb-3">
            <label>Payment Method Name</label>
            <input type="text" name="payment_method_name" class="form-control">
        </div>

        <div class="mb-3">
            <label>Website</label>
            <input type="url" name="website" class="form-control">
        </div>

        <div class="mb-3">
            <label>Event</label>
            <select name="event_id" class="form-control">
                @foreach($events as $event)
                    <option value="{{ $event->id }}">{{ $event->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Company</label>
            <select name="company_id" class="form-control">
                @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Submit Request</button>
        <a href="{{ route('finance.dashboard') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
@push('scripts')
    <script src="{{asset('assets/js/common-ajax.js')}}"></script>
@endpush
