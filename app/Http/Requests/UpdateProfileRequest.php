<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email:rfc',
                'max:255',
                Rule::unique('users', 'email')->ignore(auth()->user()->id),
            ],
            'phone_number' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^[0-9+\(\)#\.\s\/ext-]*$/'
            ],
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'company_description' => 'nullable|string|max:255',
        ];
    }
}
