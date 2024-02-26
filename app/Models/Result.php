<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Result extends Model
{
    public $timestamps = false;

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }

    public function contents(): BelongsToMany
    {
        return $this->belongsToMany(Content::class);
    }
}
