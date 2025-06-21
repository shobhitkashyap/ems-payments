<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
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
            'payment_method_id' => 'required|exists:payment_methods,id',
            'company_id'        => 'required|exists:companies,id',
            'vat_rate'          => 'required|numeric|min:0|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'payment_method_id.required' => 'Payment method is required.',
            'payment_method_id.exists'   => 'Selected payment method does not exist.',
            'company_id.required'        => 'Company is required.',
            'company_id.exists'          => 'Selected company does not exist.',
            'vat_rate.required'          => 'VAT rate is required.',
            'vat_rate.numeric'           => 'VAT rate must be a number.',
            'vat_rate.min'               => 'VAT rate cannot be less than 0%.',
            'vat_rate.max'               => 'VAT rate cannot be more than 100%.',
        ];
    }
}
