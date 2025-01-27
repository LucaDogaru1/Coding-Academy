<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar View</title>
</head>
<body>

<form method="GET" action="{{ route('calendar.view') }}">
    <input type="text" placeholder="Filter for teams" name="filter" value="{{ request('filter') }}">
    <button type="submit">Filter</button>
    <button type="button" onclick="window.location.href='{{ route('calendar.view') }}'">Clear Filter</button>
</form>

<div class="calendar-container">
    <div class="month-navigation">
        <form method="GET" action="{{ route('calendar.view') }}">
            <input type="hidden" name="month" value="{{ $previousMonth }}">
            <input type="hidden" name="filter" value="{{ request('filter') }}">
            <button type="submit">← Previous</button>
        </form>
        <div class="month-name">{{ $currentMonthName }}</div>
        <form method="GET" action="{{ route('calendar.view') }}">
            <input type="hidden" name="month" value="{{ $nextMonth }}">
            <input type="hidden" name="filter" value="{{ request('filter') }}">
            <button type="submit">Next →</button>
        </form>
    </div>


    <div class="calendar">
        @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
            <div class="day-header">{{ $day }}</div>
        @endforeach

        @for($day = 1; $day <= $daysInMonth; $day++)
            <div class="day">

                @php
                    /** @var \Illuminate\Support\Collection $events */
                    /** @var int $currentMonth */
                    $dayEvents = $events->filter(function($event) use ($day, $currentMonth) {
                        return \Carbon\Carbon::parse($event->date)->day == $day && \Carbon\Carbon::parse($event->date)->month - 1 == $currentMonth;
                    });
                @endphp

                @if($dayEvents->count())
                    <div class="active">
                        @foreach($dayEvents as $event)
                            <form method="GET" action="{{ route('sport.event', $event->id) }}">
                                <button type="submit" style="cursor: pointer">
                                    {{ $event->sport->home_team }} <b>vs</b> {{ $event->sport->away_team }}
                                </button>
                            </form>
                        @endforeach
                    </div>
                @endif
                {{ $day }}
            </div>
        @endfor
    </div>
</div>

<h3>Add event</h3>
<form method="POST" action="{{route('create.event')}}">
    @csrf
    <label for="" style="margin: 10px">Sport type:
        <input type="text" name="sport" placeholder="Enter type of sport" required style="margin: 10px"> <br>
    </label>
    <label for="" style="margin: 10px"> home team:
        <input type="text" name="home_team" placeholder="Home Team" required style="margin: 10px"> <br>
    </label>
    <label for="" style="margin: 10px"> away team:
        <input type="text" name="away_team" placeholder="Away Team" required style="margin: 10px"> <br>
    </label>
    <label for="" style="margin: 10px">date:
        <input type="date" min="2024-01-01" max="2024-12-31" name="date" required style="margin: 10px"> <br>
    </label>
    <button style="margin: 10px; cursor: pointer"> Add event</button>
</form>
</body>
</html>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        text-align: center;
        background-color: #f5f5f5;
    }

    .calendar-container {
        max-width: 600px;
        margin: 0 auto;
        background-color: white;
        border-radius: 10px;
        padding: 10px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .month-navigation {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .month-navigation button {
        padding: 8px 12px;
        font-size: 1em;
        cursor: pointer;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f1f1f1;
    }

    .month-name {
        font-size: 1.5em;
        font-weight: bold;
    }

    .calendar {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 10px;
    }

    .day, .day-header {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 50px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    .day-header {
        font-weight: bold;
        background-color: #f1f1f1;
    }

    .active {
        background-color: red;
        font-weight: bold;
        cursor: pointer;
    }
</style>
