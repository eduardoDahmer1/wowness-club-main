<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Individual extends Model
{
    use HasFactory;
    protected $table = "individual_service";
    protected $fillable = [
        'start',
        'end',
        'service_id',
        'occurrence_type',
        'weekday',
        'when',
        'schedule_time',
        'end_repeat',
        'schedule_type',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
