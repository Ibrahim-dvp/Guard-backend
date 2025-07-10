<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
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
            'lead_id'         => ['required', 'exists:leads,id'],
            'user_id'         => ['required', 'exists:users,id'],
            'team_id'         => ['nullable', 'exists:teams,id'],
            'title'           => ['required', 'string', 'max:255'],
            'description'     => ['nullable', 'string'],
            'start_time'      => ['required', 'date'],
            'end_time'        => ['required', 'date', 'after:start_time'],
            'location'        => ['nullable', 'string', 'max:255'],
            'status'          => ['required', 'in:scheduled,completed,cancelled,rescheduled'],
            'notes'           => ['nullable', 'string'],
        ];
    }
}
