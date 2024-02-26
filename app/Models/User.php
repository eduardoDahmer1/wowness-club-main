<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\Plan;
use App\Enums\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ForgotPassword;
use App\Notifications\VerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasUuids;
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'google_id',
        'google_token'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => Role::class,
        'status' => 'boolean'
    ];
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ForgotPassword($token, Str::words($this->name, 1, ''), $this->email));
    }

    public function isAdmin(): bool
    {
        return $this->role === Role::Admin;
    }

    public function isMaintainer(): bool
    {
        return $this->role === Role::Maintainer;
    }

    public function isServiceProvider(): bool
    {
        return $this->role === Role::ServiceProvider;
    }

    public function isCommonUser(): bool
    {
        return $this->role === Role::CommonUser;
    }

    public function userSubscription()
    {
        return $this->hasOne(UserSubscription::class);
    }

    public function subscription()
    {
        return $this->hasOneThrough(Subscription::class, UserSubscription::class, 'user_id', 'id', 'id', 'subscription_id');
    }

    public function isPlanFree(): bool
    {
        return !$this->subscription || $this->subscription && $this->subscription->plan === Plan::Free;
    }

    public function isPlanStandard(): bool
    {
        return $this->subscription && ($this->subscription->plan === Plan::Standard);
    }

    public function isPlanFoundingMember(): bool
    {
        return $this->subscription && $this->subscription->plan === Plan::FoundingMember;
    }

    public function isPlanProfessional(): bool
    {
        return $this->subscription && $this->subscription->plan === Plan::Professional;
    }

    public function isPaying(): bool
    {
        return $this->subscription && $this->subscription->plan !== Plan::Free || $this->role === Role::Admin;
    }
    
    public function scopePaying()
    {
        return $this->whereHas('subscription', function ($query) {
            $query->where('plan', '!=', Plan::Free);
        });
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function purchases() : HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    public function contents(): HasMany
    {
        return $this->hasMany(Content::class);
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    public function specialisations(): HasMany
    {
        return $this->hasMany(Specialisation::class);
    }

    public function testimonials():  HasMany
    {
        return $this->hasMany(Testimonial::class);
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Hash::needsRehash($value) ? Hash::make($value) : $value
        );
    }

    protected function photoUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (filter_var($this->photo, FILTER_VALIDATE_URL)) {
                    return $this->photo;
                }

                return asset('storage/' . $this->photo);
            },
        );
    }

    /**
     * Scope a query to filtered users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array  $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['q'] ?? false, fn ($query, $search) => $query->where('alias', 'LIKE', "%$search%"));
    }

    /**
     * Scope a query to filtered users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePositionDesc($query)
    {
        $query->orderByRaw('case when position is null then 1 else 0 end, position');
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
    /**
     * Get all of the categories for the user.
     */
    public function categories(): Attribute
    {
        return Attribute::make(
            get: function () {
                $collection = new Collection();
                $this->services()->with('categories')->get()->each(
                    fn ($item) => $item->categories->each(
                        fn ($item) => $collection->push($item)
                    )
                );

                return $collection->unique('id');
            }
        );
    }

    public function categoriesuser()
    {
        return $this->morphedByMany(Category::class, 'categorizable', 'user_categorizables');
    }

    public function subcategoriesuser()
    {
        return $this->morphedByMany(Subcategory::class, 'categorizable', 'user_categorizables');
    }

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class, 'language_user');
    }

    /**
     * Get all of the subcategories for the user.
     */
    public function subcategories(): Attribute
    {
        return Attribute::make(
            get: function () {
                $collection = new Collection();
                $this->services()->with('subcategories')->get()->each(
                    fn ($item) => $item->subcategories->each(
                        fn ($item) => $collection->push($item)
                    )
                );

                return $collection->unique('id');
            }
        );
    }

    public function scopeSearch($query, array $filters)
    {
        $query->when($filters['categories'] ?? false, function ($query, $ids_category) {

            $query->whereHas('categoriesuser', fn ($query) => $query->whereIn('categories.id', $ids_category));
            $query->orWhereHas('subcategoriesuser', fn ($query) => $query->whereIn('category_id', $ids_category));
        });

        $query->when($filters['subcategories'] ?? false, function ($query, $ids_subcategory) {

            $query->orWhereHas('subcategoriesuser', fn ($query) => $query->whereIn('subcategories.id', $ids_subcategory));
        });

        $query->when($filters['languages'] ?? false, function ($query, $ids_language) {

            $query->whereHas('languages', fn ($query) => $query->whereIn('languages.id', $ids_language));
        });
    }
}
