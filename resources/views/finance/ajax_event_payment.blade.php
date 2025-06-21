@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <h2>Assign Payment Configuration (AJAX)</h2>

    <form id="event-payment-form" class="ajax-form" method="POST" action="{{ route('event-payments.store') }}">
        {{-- Include CSRF token for security --}}
        @csrf
        <div class="mb-3">
            <label>Event</label>
            <select name="event_id" class="form-control" required>
                @foreach($events as $event)
                    <option value="{{ $event->id }}">{{ $event->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Payment Method</label>
            <select name="payment_method_id" class="form-control" required>
                @foreach($paymentMethods as $pm)
                    <option value="{{ $pm->id }}">{{ $pm->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Company</label>
            <select name="company_id" class="form-control" required>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>VAT Rate (%)</label>
            <input type="number" name="vat_rate" class="form-control" min="0" max="100" required>
        </div>

        <button type="submit" class="btn btn-success">Save Configuration</button>
    </form>

    <div id="message" class="mt-3"></div>
</div>
@endsection

@push('scripts')
<script src="{{asset('assets/js/common-ajax.js')}}"></script>
@endpush