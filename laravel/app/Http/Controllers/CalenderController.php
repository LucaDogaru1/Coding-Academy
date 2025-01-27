<?php

namespace App\Http\Controllers;

use App\Models\SportEvent;
use App\Models\Sport;
use Illuminate\Http\JsonResponse;

class CalenderController extends Controller
{

    public function getTimeTablesForSportEvents():void
    {
        $sportController = new SportController();

        $sportId = Sport::query()->pluck('id');


        foreach ($sportController->handledData() as $events) {
            foreach ($events as $e) {
                SportEvent::query()->create([
                    'date' => $e['dateVenue'],
                    'time' => $e['timeVenueUTC'],
                    'sports_id' => $sportId->shuffle()->first(),
                ]);
            }
        }
    }


    public function calenderData(): JsonResponse
    {
        return response()->json(SportEvent::query()->get());
    }


}
