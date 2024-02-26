<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentLesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'content_id',
        'title',
        'subtitle',
        'video_url',
    ];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
