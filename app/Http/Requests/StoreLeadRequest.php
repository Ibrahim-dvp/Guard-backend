<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLeadRequest extends FormRequest
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
            'organization_id'    => ['required', 'exists:organizations,id'],
            'team_id'            => ['nullable', 'exists:teams,id'],
            'referral_id'        => ['nullable', 'exists:users,id'],
            'assigned_to'        => ['nullable', 'exists:users,id'],
            'client_first_name'  => ['required', 'string', 'max:100'],
            'client_last_name'   => ['required', 'string', 'max:100'],
            'client_email'       => ['nullable', 'string', 'email', 'max:255'],
            'client_phone'       => ['nullable', 'string', 'max:20'],
            'client_address'     => ['nullable', 'string'],
            'client_city'        => ['nullable', 'string', 'max:100'],
            'client_country'     => ['nullable', 'string', 'max:100'],
            'product_interest'   => ['nullable', 'string', 'max:255'],
            'budget_range'       => ['nullable', 'string', 'max:100'],
            'timeline'           => ['nullable', 'string', 'max:100'],
            'priority'           => ['required', 'in:low,medium,high,urgent'],
            'source'             => ['nullable', 'string', 'max:100'],
            'notes'              => ['nullable', 'string'],
            'status'             => ['required', 'in:new,assigned,contacted,qualified,proposal,negotiation,won,lost,cancelled'],
            'substatus'          => ['nullable', 'string', 'max:100'],
            'wordpress_form_id'  => ['nullable', 'string', 'max:100'],
            'baserow_id'         => ['nullable', 'string', 'max:100'],
            'assigned_at'        => ['nullable', 'date'],
            'first_contact_at'   => ['nullable', 'date'],
            'last_activity_at'   => ['nullable', 'date'],
            'estimated_value'    => ['nullable', 'numeric', 'min:0'],
            'actual_value'       => ['nullable', 'numeric', 'min:0'],
            'commission_rate'    => ['nullable', 'numeric', 'min:0', 'max:999.99'],
            'commission_amount'  => ['nullable', 'numeric', 'min:0'],
        ];
    }
}
