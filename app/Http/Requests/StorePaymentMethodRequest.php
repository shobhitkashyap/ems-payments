<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentMethodRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'payment_method_name' => 'required|string',
            'website'             => 'required|url',
            'event_id'            => 'required|exists:events,id',
            'company_id'          => 'required|exists:companies,id',
        ];
    }

    public function messages(): array
    {
        return [
            'payment_method_name.required' => 'Payment method name is required.',
            'website.required'             => 'Website is required.',
            'website.url'                  => 'Website must be a valid URL.',
            'event_id.required'            => 'Event ID is required.',
            'event_id.exists'              => 'The selected event does not exist.',
            'company_id.required'          => 'Company ID is required.',
            'company_id.exists'            => 'The selected company does not exist.',
        ];
    }
}
