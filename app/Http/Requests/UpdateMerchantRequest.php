<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMerchantRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email:rfc',
                'max:255',
            ],
            'phone_number' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^[0-9+\(\)#\.\s\/ext-]*$/',
            ],
            'company_description' => 'nullable|string|max:255',
        ];
    }
}
