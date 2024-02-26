<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recurrence extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'service_id',
        'start_date',
        'end_date',
        'recurrencesId',
        'altered',
        'main_date',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function calendar(): HasOne
    {
        return $this->hasOne(Calendar::class);
    }
}
