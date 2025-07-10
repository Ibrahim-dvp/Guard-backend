<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRevenueTrackingRequest extends FormRequest
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
            'organization_id' => ['required', 'exists:organizations,id'],
            'user_id'         => ['required', 'exists:users,id'],
            'lead_id'         => ['required', 'exists:leads,id'],
            'amount'          => ['required', 'numeric', 'min:0'],
            'currency'        => ['required', 'string', 'max:3'],
            'transaction_date' => ['required', 'date'],
            'description'     => ['nullable', 'string'],
            'status'          => ['required', 'in:pending,completed,refunded,failed'],
        ];
    }
}
