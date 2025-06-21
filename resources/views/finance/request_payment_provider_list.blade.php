@extends('layouts.app')
@use(\App\Helpers\Helpers)
@section('content')
<div class="container mt-2">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Request Payment Provider</h2>
        <a href="{{ route('finance.create-request-provider') }}" class="btn btn-secondary">Request New Payment Provider</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Method Name</th>
                <th>Website</th>
                <th>Event</th>
                <th>Company</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($paymentProviders as $paymentProvider)
                <tr>
                    <td>{{ $paymentProvider?->payment_method_name }}</td>
                    <td><a href="{{$paymentProvider?->website}}" target="_blank">{{ $paymentProvider?->website }}</a></td>
                    <td>{{ $paymentProvider?->event?->name }}</td>
                    <td>{{ $paymentProvider?->company?->name }}</td>
                    <td>
                        <span class="badge bg-{{ Helpers::getBadgeClass($paymentProvider?->status) }}">
                            {{ ucfirst($paymentProvider?->status) ?? 'Unknown' }}
                        </span>
                    </td>
                    <td>{{ $paymentProvider->created_at }}</td>
                    <td>
                        <select class="status-dropdown form-select" data-id="{{ $paymentProvider->id }}">
                            <option value="">-- Change Status --</option>
                            <option value="pending" {{ $paymentProvider->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ $paymentProvider->status === 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ $paymentProvider->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="statusConfirmModal" tabindex="-1" aria-labelledby="statusConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirm Status Change</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to change the status to <strong id="confirmStatusText"></strong>?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" id="confirmStatusBtn">Yes, Update</button>
        </div>
      </div>
    </div>
  </div>
  

@endsection
@push('scripts')
<script>
let selectedStatus = null;
let selectedId = null;
let selectedSelect = null;
$('.status-dropdown').on('change', function () {
    selectedStatus = $(this).val();
    selectedId = $(this).data('id');
    selectedSelect = this;
    if (selectedStatus) {
        $('#confirmStatusText').text(selectedStatus.charAt(0).toUpperCase() + selectedStatus.slice(1));
        let modal = new bootstrap.Modal(document.getElementById('statusConfirmModal'));
        modal.show();
    }
});
$('#confirmStatusBtn').on('click', function () {
    if (!selectedStatus || !selectedId) return;
    $.ajax({
        url: `/finance/provider-requests/${selectedId}/status`,
        method: 'PUT',
        data: {
            _token: '{{ csrf_token() }}',
            status: selectedStatus
        },
        success: function (response) {
            Swal.fire({
                title: 'Success!',
                text: response.message,
                icon: 'success',
                confirmButtonText: 'OK'
            });
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        },
        error: function (xhr) {
            alert('Error updating status.');
            if (selectedSelect) {
                $(selectedSelect).val('');
            }
        },
        complete: function () {
            let modalEl = document.getElementById('statusConfirmModal');
            let modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide();
        }
    });
});
</script>
@endpush