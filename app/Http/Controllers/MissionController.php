<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Http\Requests\StoreMissionRequest;
use App\Http\Requests\UpdateMissionRequest;
use App\Models\Crew;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $missions = Mission::with(['crew'])->get();

        return $missions->map(fn($mission) => [
            "mission" => [
                "name" => $mission->mission__name,
                "launch_details" => [
                    "launch_date" => $mission->mission__launch_details__launch_date,
                    "launch_site" => [
                        "name" => $mission->mission__launch_details__launch_site__name,
                        "location" => [
                            "latitude" => $mission->mission__launch_details__launch_site__location__latitude,
                            "longitude" => $mission->mission__launch_details__launch_site__location__longitude
                        ]
                    ]
                ],
                "landing_details" => [
                    "landing_date" => $mission->mission__landing_details__landing_date,
                    "landing_site" => [
                        "name" => $mission->mission__landing_details__landing_date,
                        "coordinates" => [
                            "latitude" => $mission->mission__landing_details__landing_site__coordinates__latitude,
                            "longitude" => $mission->mission__landing_details__landing_site__coordinates__longitude
                        ]
                    ]
                ],
                "spacecraft" => [
                    "command_module" => $mission->mission__spacecraft__command_module,
                    "lunar_module" => $mission->mission__spacecraft__lunar_module,
                    "crew" => $mission->crew->map(fn($crew) => [
                        'name' => $crew->name,
                        'role' => $crew->role
                    ])
                ]
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMissionRequest $request)
    {
        $data = $request->validated();
        $crew = $data['mission']['spacecraft']['crew'];
        unset($data['mission']['spacecraft']['crew']);
        $data = collect($data)->dot()->all();

        foreach ($data as $key => $value) {
            $data[str_replace('.', '__', $key)] = $value;
            unset($data[$key]);
        }

        DB::transaction(function () use ($data, $crew) {
            $new_mission = Mission::create($data);
            Crew::insert(array_map(fn($item) => [
                ...$item,
                'mission_id' => $new_mission->id
            ], $crew));
        });

        return response([
            'data' => [
                'code' => 201,
                'message' => 'Миссия добавлена'
            ]
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mission $mission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMissionRequest $request, Mission $mission)
    {
        $data = $request->validated();
        $crew = $data['mission']['spacecraft']['crew'];
        unset($data['mission']['spacecraft']['crew']);
        $data = collect($data)->dot()->all();

        foreach ($data as $key => $value) {
            $data[str_replace('.', '__', $key)] = $value;
            unset($data[$key]);
        }

        DB::transaction(function () use ($data, $crew, $mission) {
            $mission->update($data);
            $mission->crew()->delete();
            Crew::insert(array_map(fn($item) => [
                ...$item,
                'mission_id' => $mission->id
            ], $crew));
        });


        return [
            'data' => [
                'code' => 200,
                'message' => 'Миссия обновлена'
            ]
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mission $mission)
    {
        $mission->crew()->delete();
        $mission->delete();

        return response()->noContent();
    }


    function search(Request $request) {
        $data = $request->validate(['query' => ['required']]);
        $query = $data['query'];

        $missions = Mission::where('mission__name', 'like', "%$query%")->get();
        $missions2 = Crew::with(['mission'])->where('name', 'like', "%$query%")->get()->pluck('mission');

        $missions = collect([...$missions, ...$missions2])->unique();
        
        return [
            'data' => $missions->map(fn ($mission) => [
                'type' => 'Миссия',
                'name' => $mission->mission__name,
                'launch_date' => $mission->mission__launch_details__launch_date,
                'launch_date' => $mission->mission__landing_details__landing_date,
                'launch_date' => $mission->crew->map(fn ($item) => [
                    'name' => $item->name,
                    'role' => $item->role,
                ]),
                'landing_site' => $mission->mission__landing_details__landing_site__name
            ])
        ];
    }
}
