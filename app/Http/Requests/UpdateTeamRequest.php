<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeamRequest extends FormRequest
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
            'manager_id'      => ['nullable', 'exists:users,id'],
            'name'            => [
                'required',
                'string',
                'max:255',
                'unique:teams,name,' . $this->route('team')->id . ',id,organization_id,' . $this->organization_id,
            ],
            'description'     => ['nullable', 'string'],
            'area'            => ['nullable', 'string'],
            'settings'        => ['nullable', 'json'],
            'status'          => ['required', 'in:active,inactive'],
        ];
    }
}
