<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Timeday extends Model
{
    use HasFactory;
    protected $fillable = ['weekday_id', 'start', 'end'];

    public function weekday(): BelongsTo
    {
        return $this->belongsTo(Weekday::class);
    }
}
