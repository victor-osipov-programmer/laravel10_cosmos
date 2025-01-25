<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMissionRequest extends FormRequest
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
            "mission.name" => ['nullable'],
            "mission.launch_details.launch_date" => ['nullable'],
            "mission.launch_details.launch_site.name" => ['nullable'],
            "mission.launch_details.launch_site.location.latitude" => ['nullable'],
            "mission.launch_details.launch_site.location.longitude" => ['nullable'],
            "mission.landing_details.landing_date" => ['nullable'],
            "mission.landing_details.landing_site.name" => ['nullable'],
            "mission.landing_details.landing_site.coordinates.latitude" => ['nullable'],
            "mission.landing_details.landing_site.coordinates.longitude" => ['nullable'],
            "mission.spacecraft.command_module" => ['nullable'],
            "mission.spacecraft.lunar_module" => ['nullable'],
            "mission.spacecraft.crew.*.name" => ['nullable'],
            "mission.spacecraft.crew.*.role" => ['nullable'],
        ];
    }
}
