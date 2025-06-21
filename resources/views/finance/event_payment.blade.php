@extends('layouts.app')
@section('content')
<div class="container mt-2">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Event Payment</h2>
        <a href="{{ route('finance.create-request-provider') }}" class="btn btn-secondary">Request New Payment Provider</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Payment Method</th>
                <th>Company</th>
                <th>Vat Rate</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($eventPayments as $eventPayment)
                <tr>
                    <td>{{ $eventPayment?->event?->name }}</td>
                    <td>{{ $eventPayment?->paymentMethod?->name }}</td>
                    <td>{{ $eventPayment?->company?->name }}</td>
                    <td>{{ $eventPayment?->vat_rate }}</td>
                    <td>{{ $eventPayment->created_at }}</td>
                    <td>
                        <a href="{{ route('finance.event-payments.edit', $eventPayment->id) }}" class="btn btn-sm btn-primary">
                            Edit
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection