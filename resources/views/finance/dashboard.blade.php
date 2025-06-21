@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Finance Dashboard</h2>
        {{-- <a href="{{ route('finance.request-provider') }}" class="btn btn-secondary">Request New Payment Provider</a> --}}
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Event</th>
                <th>Location</th>
                <th>Date</th>
                <th>Payments</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
                <tr>
                    <td>{{ $event->name }}</td>
                    <td>{{ $event->location }}</td>
                    <td>{{ $event->date }}</td>
                    <td>
                        @foreach($event->eventPayments as $ep)
                            <div>
                                {{ $ep->paymentMethod->name ?? '—' }} - {{ $ep->company->name ?? '—' }} (VAT: {{ $ep->vat_rate }}%)
                            </div>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('finance.edit', $event->id) }}" class="btn btn-sm btn-primary">Manage Payments</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
