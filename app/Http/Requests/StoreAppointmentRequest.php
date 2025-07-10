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
            // Match the actual database schema
            'lead_id'              => ['required', 'exists:leads,id'],
            'sales_agent_id'       => ['required', 'exists:users,id'],
            'organization_id'      => ['nullable', 'exists:organizations,id'], // nullable in DB
            'team_id'              => ['nullable', 'exists:teams,id'],
            'title'                => ['required', 'string', 'max:255'],
            'description'          => ['nullable', 'string'],
            'appointment_date'     => ['required', 'date'],
            'appointment_time'     => ['required', 'date_format:H:i:s'],
            'duration_minutes'     => ['nullable', 'integer', 'min:15', 'max:480'], // 15 min to 8 hours
            'location'             => ['nullable', 'string', 'max:255'],
            'meeting_type'         => ['required', 'in:in_person,phone,video,online'],
            'status'               => ['nullable', 'in:scheduled,confirmed,completed,cancelled,rescheduled'],
            'outcome'              => ['nullable', 'in:successful,no_show,reschedule_requested,not_interested,follow_up_needed'],
            'outcome_notes'        => ['nullable', 'string'],
            'reminder_sent'        => ['nullable', 'boolean'],
            'confirmed_by_client'  => ['nullable', 'boolean'],
        ];
        // return [
        //     'organization_id' => ['required', 'exists:organizations,id'],
        //     'lead_id'         => ['required', 'exists:leads,id'],
        //     'user_id'         => ['required', 'exists:users,id'],
        //     'team_id'         => ['nullable', 'exists:teams,id'],
        //     'title'           => ['required', 'string', 'max:255'],
        //     'description'     => ['nullable', 'string'],
        //     'start_time'      => ['required', 'date'],
        //     'end_time'        => ['required', 'date', 'after:start_time'],
        //     'location'        => ['nullable', 'string', 'max:255'],
        //     'status'          => ['required', 'in:scheduled,completed,cancelled,rescheduled'],
        //     'notes'           => ['nullable', 'string'],
        // ];
    }
    public function messages(): array
    {
        return [
            'appointment_time.date_format' => 'The appointment time must be in HH:MM:SS format.',
            'duration_minutes.min' => 'Appointment duration must be at least 15 minutes.',
            'duration_minutes.max' => 'Appointment duration cannot exceed 8 hours.',
        ];
    }
}
