<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use PhpParser\Builder;
use Ramsey\Collection\Collection;

/**
 * @mixin Builder
 * @property Collection<Sport> $sport
 */

class Calender extends Model
{
    protected $fillable = [
        'time',
        'date',
        'sport_id'
    ];

    public function sport(): HasOne
    {
        return $this->hasOne(Sport::class);
    }

    public function getSport(): Collection
    {
        return $this->sport;
    }
}
