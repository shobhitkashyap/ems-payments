@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <h2>Assigned Payment to Event Edit: {{ $eventPayment?->event?->name }}</h2>

    <form method="POST" class="ajax-form" action="{{ route('finance.event-payments.update', $eventPayment->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Payment Method</label>
            <select name="payment_method_id" class="form-control">
                <option value="">Select</option>
                @foreach($paymentMethods as $pm)
                    <option value="{{ $pm->id }}" {{$eventPayment->payment_method_id == $pm->id ? 'selected' : ''}}>{{ $pm->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Company</label>
            <select name="company_id" class="form-control">
                <option value="">Select</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{$eventPayment->company_id == $company->id ? 'selected' : ''}}>{{ $company->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>VAT Rate (%)</label>
            <input type="number" value="{{$eventPayment->vat_rate}}" name="vat_rate" class="form-control" min="0" max="100">
        </div>
        <button class="btn btn-success">Save Payment Configuration</button>
        <a href="{{ route('finance.dashboard') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
@push('scripts')
    <script src="{{asset('assets/js/common-ajax.js')}}"></script>
@endpush
