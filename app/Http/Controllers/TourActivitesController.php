<?php

namespace App\Http\Controllers;

use App\Http\Resources\TourActivitiesDetailResource;
use App\Models\TourActivities;

class TourActivitesController extends Controller
{
    public function showAll()
    {
        $perPage = 3;
        $data = TourActivities::paginate($perPage);
        if($data == null){
            return response()->json(['message' => 'Data not found'], 404);
        }
        return response()->json($data, 200);
    }

    public function getById(int $id): TourActivitiesDetailResource
    {
        $data = TourActivities::find($id);

        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }

    return new TourActivitiesDetailResource($data);
    }
}
