<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasUuids;
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'description'
    ];

    public function subcategories(): HasMany
    {
        return $this->hasMany(Subcategory::class);
    }

    public function services()
    {
        return $this->morphToMany(Service::class, 'categorizable');
    }

    public function contents()
    {
        return $this->morphedByMany(Content::class, 'categorizable', 'content_categorizables');
    }

    /**
     * Scope a query to filtered categories and subcategories relation.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array  $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['q'] ?? false, function ($query, $search) {
            $query->where('name', 'LIKE', "%$search%");

            $query->orWhereHas('subcategories', fn($query) => $query->where('name', 'LIKE', "%$search%"));
        });
    }
}
