<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OccurrenceIgnored extends Model
{
    protected $table = 'ignore_occurrences';
    use HasFactory;

    protected $fillable = [
        'service_id',
        'calendar_id',
        'title',
        'description',
        'start',
        'end',
    ];
}
