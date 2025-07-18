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
        // return [
        //     'lead_id'       => ['required', 'exists:leads,id'],
        //     'user_id'       => ['required', 'exists:users,id'],
        //     'type'          => ['required', 'string', 'max:100', 'in:call,email,meeting,note,status_update,other'], // Updated max length and enum values
        //     'description'   => ['nullable', 'string'],
        //     'activity_date' => ['required', 'date'],
        // ];
        return [
            // Use 'sometimes' for update operations
            'lead_id'        => ['sometimes', 'exists:leads,id'],
            'user_id'        => ['nullable', 'exists:users,id'],
            'activity_type'  => ['sometimes', 'string', 'max:100'],
            'title'          => ['sometimes', 'string', 'max:255'],
            'description'    => ['nullable', 'string'],
            'outcome'        => ['nullable', 'string', 'max:100'],
            'activity_date'  => ['sometimes', 'date'],
            'duration_minutes' => ['nullable', 'integer', 'min:1'],
            'metadata'       => ['nullable', 'json'],
        ];
    }
}
