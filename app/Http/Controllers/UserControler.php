<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\FirstUppercase;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required', 'string', new FirstUppercase],
            'last_name' => ['required', 'string', new FirstUppercase],
            'patronymic' => ['required', 'string', new FirstUppercase],
            'email' => ['required', Rule::unique('users'), 'string'],
            'password' => ['required', 'min:3', Password::min(3)->mixedCase()->numbers()],
            'birth_date' => ['required', 'string']
        ]);
    

        $new_user = User::create($data);


        return response([
            'data' => [
                'user' => [
                    'name' => $new_user->first_name . ' ' . $new_user->last_name . ' ' . $new_user->patronymic,
                    'email' => $new_user->email
                ],
                'code' => 201,
                'message' => 'Пользователь создан'
            ]
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    function gagarin_flight() {
        return [
            "data" => [
                [
                    "mission" => [
                        "name" => "Восток 1",
                        "launch_details" => [
                            "launch_date" => "1961-04-12",
                            "launch_site" => [
                                "name" => "Космодром Байконур",
                                "location" => [
                                    "latitude" => "45.9650000",
                                    "longitude" => "63.3050000"
                                ]
                            ]
                        ],
                        "flight_duration" => [
                            "hours" => 1,
                            "minutes" => 48
                        ],
                        "spacecraft" => [
                            "name" => "Восток 3KA",
                            "manufacturer" => "OKB-1",
                            "crew_capacity" => 1
                        ]
                    ],
                    "landing" => [
                        "date" => "1961-04-12",
                        "site" => [
                            "name" => "Смеловка",
                            "country" => "СССР",
                            "coordinates" => [
                                "latitude" => "51.2700000",
                                "longitude" => "45.9970000"
                            ]
                        ],
                        "details" => [
                            "parachute_landing" => true,
                            "impact_velocity_mps" => 7
                        ]
                    ],
                    "cosmonaut" => [
                        "name" => "Юрий Гагарин",
                        "birthdate" => "1934-03-09",
                        "rank" => "Старший лейтенант",
                        "bio" => [
                            "early_life" => "Родился в Клушино, Россия.",
                            "career" => "Отобран в отряд космонавтов в 1960 году...",
                            "post_flight" => "Стал международным героем."
                        ]
                    ]
                ]
            ]
        ];
    }
}
