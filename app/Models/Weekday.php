<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Weekday extends Model
{
    use HasFactory;
    protected $fillable = ['service_id', 'weekday', 'created_at'];
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function timedays(): HasMany
    {
        return $this->hasMany(Timeday::class);
    }
}
