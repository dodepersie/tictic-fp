<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
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
            'event_title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'event_detail' => 'required|string',
            'event_price' => 'required|integer|min:0',
            'event_start_date' => 'required|date|after_or_equal:today',
            'event_start_time' => 'required|date_format:H:i',
            'event_location' => 'required|string|max:255',
            'event_location_latitude' => 'required|numeric|between:-90,90',
            'event_location_longitude' => 'required|numeric|between:-180,180',
            'event_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            // 'event_category' => 'required|exists:categories,id',
        ];
    }
}
