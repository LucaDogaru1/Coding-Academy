<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sport extends Model
{
    protected $fillable = [
        'name',
        'teams'
    ];

    protected $casts = [
        'teams' => 'array'
    ];

    public function calender(): BelongsTo
    {
        return $this->belongsTo(Calender::class);
    }
}
