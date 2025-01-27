<?php

namespace App\Http\Controllers;

use App\Models\SportEvent;
use App\Models\Sport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class CalenderViewController extends Controller
{

    const DAYS_AND_MONTHS = [
        ['name' => 'January', 'days' => 31],
        ['name' => 'February', 'days' => 28],
        ['name' => 'March', 'days' => 31],
        ['name' => 'April', 'days' => 30],
        ['name' => 'May', 'days' => 31],
        ['name' => 'June', 'days' => 30],
        ['name' => 'July', 'days' => 31],
        ['name' => 'August', 'days' => 31],
        ['name' => 'September', 'days' => 30],
        ['name' => 'October', 'days' => 31],
        ['name' => 'November', 'days' => 30],
        ['name' => 'December', 'days' => 31],
    ];

    public function getCalender(Request $request): View
    {
        $currentMonth = $request->query('month', now()->month -1);

        $events = SportEvent::query()
            ->when($request->has('filter') && $request->filter != '', function ($query) use ($request) {
                $query->whereHas('sport', function ($sportQuery) use ($request) {
                    $sportQuery->team($request->filter);
                });
            })
            ->get();


        if ($request->filter && $events->count() && $request->missing('month')) {
            $dateOfFirstEvent = Carbon::parse($events->first()->date);
            $currentMonth = $dateOfFirstEvent->month -1;
        }


        return view('CalenderView', [
            'currentMonthName' => self::DAYS_AND_MONTHS[$currentMonth]['name'],
            'daysInMonth' => self::DAYS_AND_MONTHS[$currentMonth]['days'],
            'previousMonth' => ($currentMonth - 1 + 12) % 12,
            'nextMonth' => ($currentMonth + 1) % 12,
            'currentMonth' => $currentMonth ,
            'events' => $events
        ]);
    }


    public function showEvent(int $id): View
    {
        $sportEvent = SportEvent::query()->findOrFail($id)->getSport();

        return view('SportEventView', ['sportEvent' => $sportEvent]);
    }
}
