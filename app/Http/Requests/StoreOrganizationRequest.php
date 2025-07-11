<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrganizationRequest extends FormRequest
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
            // 'uuid' => ['required', 'string', 'max:36', Rule::unique('organizations', 'uuid')],
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', Rule::in(['protecta_group', 'partner'])],
            'code' => ['nullable', 'string', 'max:50', Rule::unique('organizations', 'code')],
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'logo' => ['nullable', 'string', 'max:255'],
            'settings' => ['nullable', 'json'],
            'status' => ['nullable', 'string', Rule::in(['active', 'inactive', 'suspended'])],
        ];
    }
}
