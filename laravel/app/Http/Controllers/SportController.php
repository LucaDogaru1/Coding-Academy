<?php

namespace App\Http\Controllers;

use App\Models\SportEvent;
use App\Models\Sport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SportController extends Controller
{
    public function getContentFromJsonFile(): void
    {

        foreach ($this->handledData() as $events) {
            foreach ($events as $e) {
                Sport::query()->create([
                    'name' => $e['sport'] ?? null,
                    'home_team' => $e['homeTeam']['name'] ?? null,
                    'away_team' => $e['awayTeam']['name'] ?? null
                ]);
            }
        }
    }

    public function handledData(): array
    {
        $data = file_get_contents('/app/json/data.json');
        return json_decode($data, true);
    }

    public function createSportEvent(Request $request): RedirectResponse
    {
        $homeTeam = $request->input('home_team');
        $awayTeam = $request->input('away_team');
        $date = $request->input('date');
        $sportName = $request->input('sport');

        $sport = Sport::query();
        $calender = SportEvent::query();

        $newCreatedSportEvent = $sport->create([
            'name' => $sportName,
            'home_team' => $homeTeam,
            'away_team' => $awayTeam
        ]);

        $calender->create([
            'date' => $date,
            'sports_id' => $newCreatedSportEvent->id
        ]);

        return back();
    }

    public function updateEvent(Request $request, int $id): RedirectResponse
    {
        $name = $request->input('old_name');
        $homeTeam = $request->input('old_home_team');
        $awayTeam = $request->input('old_away_team');

        $sportEvent = SportEvent::query()->findOrFail($id)->getSport();

        $sportEvent->update([
            'name' => $name,
            'home_team' => $homeTeam,
            'away_team' => $awayTeam
        ]);

        return redirect()->route('calendar.view');
    }
}
