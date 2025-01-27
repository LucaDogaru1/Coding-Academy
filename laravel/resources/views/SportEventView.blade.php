<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="POST" action="{{route('update.event', $sportEvent->id)}}" style="padding: 10px;">
    @method('PUT')
    @csrf
    <input type="text" name="old_name" value="{{old('name', $sportEvent->name)}}"> <br>
    <input type="text" placeholder="Home Team" name="old_home_team" value="{{old('home_team', $sportEvent->home_team)}}"><br>
    <input type="text" placeholder="Away Team" name="old_away_team" value="{{old('away_team', $sportEvent->away_team)}}"><br>
    <button type="submit" style="cursor: pointer">Update</button>
</form>

<form method="GET" action="{{route('calendar.view')}}">
    <button type="submit" style="cursor: pointer;">go back</button>
</form>
</body>
</html>
