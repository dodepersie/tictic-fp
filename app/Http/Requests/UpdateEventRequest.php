<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
            'slug' => 'required|string|max:255|unique:products,slug,'.$this->route('event'),
            'event_detail' => 'required|string',
            'event_start_date' => 'required|date|before_or_equal:event_end_date',
            'event_end_date' => 'required|date|after_or_equal:event_start_date',
            'event_start_time' => 'required|date_format:H:i:s',
            'event_address' => 'required|string|max:255',
            'event_location' => 'required|string|max:255',
            'event_location_latitude' => 'required|numeric|between:-90,90',
            'event_location_longitude' => 'required|numeric|between:-180,180',
            'event_image.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'category_id' => 'required|exists:categories,id',
            'ticket_types' => 'required',
            'vvip_price' => 'required_if:ticket_types,VVIP|nullable|integer|min:0',
            'vvip_quantity' => 'required_if:ticket_types,VVIP|nullable|integer|min:1',
            'vip_price' => 'required_if:ticket_types,VIP|nullable|integer|min:0',
            'vip_quantity' => 'required_if:ticket_types,VIP|nullable|integer|min:1',
            'regular_price' => 'required_if:ticket_types,Regular|nullable|integer|min:0',
            'regular_quantity' => 'required_if:ticket_types,Regular|nullable|integer|min:1',
        ];
    }
}
