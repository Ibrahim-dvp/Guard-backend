<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLeadActivityRequest extends FormRequest
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
            'lead_id'       => ['required', 'exists:leads,id'],
            'user_id'       => ['required', 'exists:users,id'],
            'type'          => ['required', 'string', 'max:100', 'in:call,email,meeting,note,status_update,other'], // Updated max length and enum values
            'description'   => ['nullable', 'string'],
            'activity_date' => ['required', 'date'],
        ];
    }
}
