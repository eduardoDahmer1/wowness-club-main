<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Occurrence extends Model
{
    protected $fillable = [
        'occurrence_id',
        'calendar_id',
        'title',
        'description',
        'start',
        'end',
    ];

    // Relationship to events
    public function calendar()
    {
        return $this->belongsTo(Calendar::class);
    }
}