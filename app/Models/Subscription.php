<?php

namespace App\Models;

use App\Enums\Plan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'subscriptions';

    protected $fillable = [
        'subscription_id',
        'product_id',
        'email',
        'name',
        'canceled_at',
        'currency',
        'payment_status',
    ];

    protected $casts = [
        'plan' => Plan::class,
    ];

    public function scopeCancelled($query)
    {
        return $query->whereNotNull('canceled_at');
    }

    public function scopeNotCancelled($query)
    {
        return $query->where('payment_status', '!=', 'canceled');
    }

    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    public function scopeNotPaid($query)
    {
        return $query->where('payment_status', '!=', 'paid');
    }

    public function scopePlan($query, $plan)
    {
        return $query->where('plan', $plan);
    }

    public function userSubscription()
    {
        return $this->hasOne(UserSubscription::class);
    }
}
