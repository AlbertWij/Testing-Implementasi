<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
{
    return [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],

        // Make additional profile fields optional so partial updates are allowed in tests
        'phone_number' => ['sometimes', 'nullable', 'string', 'max:20'],
        'date_of_birth' => ['sometimes', 'nullable', 'date'],
        'gender' => ['sometimes', 'nullable', 'string', 'in:male,female,other'],
        'address' => ['sometimes', 'nullable', 'string', 'max:500'],
    ];
}
}
