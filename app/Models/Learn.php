<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Learn extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
