<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Extra extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'service_id'
    ];

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }
}
