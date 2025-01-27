<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sport extends Model
{
    protected $fillable = [
        'name',
        'home_team',
        'away_team'
    ];


    public function sportEvents(): HasMany
    {
        return $this->hasMany(SportEvent::class, 'sports_id');
    }

    // Build in function offered by laravel, used for filtering,  called like this "->teams"
        public function scopeTeam(Builder $query, $teamName): Builder
    {
        return $query->where('home_team', 'like', '%' . $teamName . '%')
            ->orWhere('away_team', 'like', '%' . $teamName . '%');
    }

}
