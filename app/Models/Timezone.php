<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Timezone extends Model
{  
    public function service(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    protected function timezone(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if(strpos($value, '.3')) {
                    $raplaceTimezone = str_replace('.3', ':30', $value);
                    $time = '+' . $raplaceTimezone;
                    return $time;
                } else {
                    return $value;
                }
            }
        );
    }
}
