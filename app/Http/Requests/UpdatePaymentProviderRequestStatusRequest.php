<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentProviderRequestStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Optional: Add permission logic if needed
    }

    public function rules(): array
    {
        return [
            'status' => 'required|in:pending,approved,rejected',
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'Status is required.',
            'status.in' => 'Status must be pending, approved, or rejected.',
        ];
    }
}
