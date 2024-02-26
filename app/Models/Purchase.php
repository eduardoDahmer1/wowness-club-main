<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'user_id',
        'content_id',
        'payment_intent',
        'quantity',
        'amount_paid'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }
    
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['q'] ?? false, function ($query, $search) {

            $query->where('id', 'LIKE', "$search%");

            $query->orWhereHas('user', function (Builder $query)  use ($search) {
                $query->where('name', 'LIKE', "%$search%");
            });
        });
    }
}
