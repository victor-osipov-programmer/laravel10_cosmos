<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFlightRequest extends FormRequest
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
            'flight_number' => ['required', 'string'],
            'destination' => ['required', 'string'],
            'launch_date' => ['required', 'date_format:Y-m-d'],
            'seats_available' => ['required', 'integer'],
        ];
    }
}
