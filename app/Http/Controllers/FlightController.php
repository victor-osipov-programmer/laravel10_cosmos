<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Http\Requests\StoreFlightRequest;
use App\Http\Requests\UpdateFlightRequest;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return [
            "data" => [
                "name" => "Аполлон-11",
                "crew_capacity" => 3,
                "cosmonaut" => [
                    [
                        "name" => "Нил Армстронг",
                        "role" => "Командир"
                    ],
                    [
                        "name" => "Базз Олдрин",
                        "role" => "Пилот лунного модуля"
                    ],
                    [
                        "name" => "Майкл Коллинз",
                        "role" => "Пилот командного модуля"
                    ]
                ],
                "launch_details" => [
                    "launch_date" => "1969-07-16",
                    "launch_site" => [
                        "name" => "Космический центр имени Кеннеди",
                        "latitude" => "28.5721000",
                        "longitude" => "-80.6480000"
                    ]
                ],
                "landing_details" => [
                    "landing_date" => "1969-07-20",
                    "landing_site" => [
                        "name" => "Море спокойствия",
                        "latitude" => "0.6740000",
                        "longitude" => "23.4720000"
                    ]
                ]
            ]
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFlightRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Flight $flight)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFlightRequest $request, Flight $flight)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flight $flight)
    {
        //
    }
}
