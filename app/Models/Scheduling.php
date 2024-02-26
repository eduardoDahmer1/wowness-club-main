<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Scheduling extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_id',
        'not_schedule',
        'not_schedule_type',
        'schedule_start',
        'schedule_end',
        'max_events',
        'when',
        'when_time',
        'when_type',
        'schedule_time',
        'schedule_type',
        'schedule_start',
        'schedule_end',
        'indefinitely'
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
