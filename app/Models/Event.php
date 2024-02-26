<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'start',
        'end',
        'recurrence',
    ];

    // Relationship to occurrences
    public function occurrences()
    {
        return $this->hasMany(Occurrence::class);
    }
}
