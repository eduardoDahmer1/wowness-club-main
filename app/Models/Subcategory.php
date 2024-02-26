<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subcategory extends Model
{
    use HasUuids;
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'icon',
        'description'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function services()
    {
        return $this->morphToMany(Service::class, 'categorizable');
    }

    public function contents()
    {
        return $this->morphedByMany(Content::class, 'categorizable', 'content_categorizables');
    }
}
