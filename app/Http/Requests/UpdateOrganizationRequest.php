<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrganizationRequest extends FormRequest
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
        $organizationId = $this->route('organization');

        return [
            'uuid' => ['sometimes', 'string', 'max:36', Rule::unique('organizations', 'uuid')->ignore($organizationId)],
            'name' => ['sometimes', 'string', 'max:255'],
            'type' => ['sometimes', 'string', Rule::in(['protecta_group', 'partner'])],
            'code' => ['nullable', 'string', 'max:50', Rule::unique('organizations', 'code')->ignore($organizationId)],
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'logo' => ['nullable', 'string', 'max:255'],
            'settings' => ['nullable', 'json'],
            'status' => ['nullable', 'string', Rule::in(['active', 'inactive', 'suspended'])],
        ];
    }
}
