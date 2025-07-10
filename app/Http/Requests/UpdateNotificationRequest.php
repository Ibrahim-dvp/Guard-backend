<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNotificationRequest extends FormRequest
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
        //     'user_id' => ['required', 'exists:users,id'],
        //     'type'    => ['required', 'string', 'max:255'], // Removed enum constraint as it's not in the migration
        //     'data'    => ['required', 'json'],
        //     'read_at' => ['nullable', 'date'],
        // ];
        return [
            'recipient_id' => ['sometimes', 'exists:users,id'],
            'sender_id'    => ['nullable', 'exists:users,id'],
            'type'         => ['sometimes', 'string', 'max:100'],
            'title'        => ['sometimes', 'string', 'max:255'],
            'message'      => ['sometimes', 'string'],
            'data'         => ['nullable', 'json'],
            'channels'     => ['nullable', 'json'],
            'priority'     => ['nullable', 'in:low,medium,high,urgent'],
            'status'       => ['nullable', 'in:pending,sent,delivered,failed,read'],
            'read_at'      => ['nullable', 'date'],
        ];
    }
}
