<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassBookingRequest extends FormRequest
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
        $rules = [
            'gym_class_id' => ['required', 'exists:gym_classes,id'],
            'booking_date' => ['required', 'date', 'after_or_equal:today'],
        ];
        
        // Admin can book for other users
        if (auth()->user()->is_admin ?? false) {
            $rules['user_id'] = ['nullable', 'exists:users,id'];
        }
        
        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'gym_class_id.required' => 'Please select a class',
            'gym_class_id.exists' => 'The selected class does not exist',
            'booking_date.required' => 'Please select a date',
            'booking_date.after_or_equal' => 'Booking date must be today or later',
            'user_id.exists' => 'The selected user does not exist',
        ];
    }
}
