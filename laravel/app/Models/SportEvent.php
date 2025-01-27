<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use PhpParser\Builder;


/**
 * @mixin Builder
 * @property Sport $sport
 */

class SportEvent extends Model
{

    protected $table = 'sport_events';
    protected $fillable = [
        'time',
        'date',
        'sports_id'
    ];

    public function sport(): BelongsTo
    {
        return $this->belongsTo(Sport::class, 'sports_id');
    }

    public  function getSport(): Sport
    {
        return $this->sport;
    }


}
