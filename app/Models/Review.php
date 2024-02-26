<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Gate;

class Review extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'title',
        'description',
        'order_id',
        'user_id',
        'status',
        'photo',
        'overall',
        'practitioner',
        'practitioner_knowledge',
        'practitioner_communication',
        'practitioner_recommend',
        'service',
        'service_quality',
        'service_value',
        'service_recommend',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function scopeFilterReview($query, User $user)
    {
        if (!Gate::allows('viewAny', $this)) {
            $query->where('user_id', 'LIKE', $user->id);
        }
    }
}
