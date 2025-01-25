<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMissionRequest extends FormRequest
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
            "mission.name" => ['required'],
            "mission.launch_details.launch_date" => ['required'],
            "mission.launch_details.launch_site.name" => ['required'],
            "mission.launch_details.launch_site.location.latitude" => ['required'],
            "mission.launch_details.launch_site.location.longitude" => ['required'],
            "mission.landing_details.landing_date" => ['required'],
            "mission.landing_details.landing_site.name" => ['required'],
            "mission.landing_details.landing_site.coordinates.latitude" => ['required'],
            "mission.landing_details.landing_site.coordinates.longitude" => ['required'],
            "mission.spacecraft.command_module" => ['required'],
            "mission.spacecraft.lunar_module" => ['required'],
            "mission.spacecraft.crew.*.name" => ['required'],
            "mission.spacecraft.crew.*.role" => ['required'],
        ];
    }
}
