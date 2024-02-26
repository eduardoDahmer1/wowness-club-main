<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use PhpParser\Node\Expr\AssignOp\Coalesce;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $dates = ['released_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function nextPost() 
    {
        return Post::filterByPostStatus()->filterByPostDate()
            ->whereRaw('COALESCE(released_at, created_at)'. ' < ' . "'" . ($this->released_at ?? $this->created_at) . "'")
            ->whereNull('video')->first();
    }

    public function scopeFilterByPostStatus($query)
    {
        $query->where('status', true);
    }

    public function scopeFilterByPostDate($query)
    {
        $query->orderByRaw('COALESCE(released_at, created_at) DESC')->get();
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['q'] ?? false, fn ($query, $search) => $query->where('name', 'LIKE', "%$search%"));
    }
}