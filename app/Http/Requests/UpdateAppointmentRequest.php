<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentRequest extends FormRequest
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
            // Match the actual database schema - use 'sometimes' for updates
            'lead_id'              => ['sometimes', 'exists:leads,id'],
            'sales_agent_id'       => ['sometimes', 'exists:users,id'],
            'organization_id'      => ['nullable', 'exists:organizations,id'],
            'team_id'              => ['nullable', 'exists:teams,id'],
            'title'                => ['sometimes', 'string', 'max:255'],
            'description'          => ['nullable', 'string'],
            'appointment_date'     => ['sometimes', 'date'],
            'appointment_time'     => ['sometimes', 'date_format:H:i:s'],
            'duration_minutes'     => ['nullable', 'integer', 'min:15', 'max:480'],
            'location'             => ['nullable', 'string', 'max:255'],
            'meeting_type'         => ['sometimes', 'in:in_person,phone,video,online'],
            'status'               => ['sometimes', 'in:scheduled,confirmed,completed,cancelled,rescheduled'],
            'outcome'              => ['nullable', 'in:successful,no_show,reschedule_requested,not_interested,follow_up_needed'],
            'outcome_notes'        => ['nullable', 'string'],
            'reminder_sent'        => ['nullable', 'boolean'],
            'confirmed_by_client'  => ['nullable', 'boolean'],
        ];
    }

    /**
     * Get custom error messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'appointment_time.date_format' => 'The appointment time must be in HH:MM:SS format.',
            'duration_minutes.min' => 'Appointment duration must be at least 15 minutes.',
            'duration_minutes.max' => 'Appointment duration cannot exceed 8 hours.',
        ];
    }
    // public function rules(): array
    // {
    //     return [
    //         'organization_id' => ['required', 'exists:organizations,id'],
    //         'lead_id'         => ['required', 'exists:leads,id'],
    //         'user_id'         => ['required', 'exists:users,id'],
    //         'team_id'         => ['nullable', 'exists:teams,id'],
    //         'title'           => ['required', 'string', 'max:255'],
    //         'description'     => ['nullable', 'string'],
    //         'start_time'      => ['required', 'date'],
    //         'end_time'        => ['required', 'date', 'after:start_time'],
    //         'location'        => ['nullable', 'string', 'max:255'],
    //         'status'          => ['required', 'in:scheduled,completed,cancelled,rescheduled'],
    //         'notes'           => ['nullable', 'string'],
    //     ];
    // }
}
