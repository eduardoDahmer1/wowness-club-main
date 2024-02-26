<?php

namespace App\Models;

use App\Enums\Aimed;
use App\Enums\Type;
use App\Enums\Method;
use App\Enums\Target;
use App\Models\Result;
use App\Models\Aimed as ModelsAimed;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Gate;

class Service extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $guarded = ['id'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'method' => Method::class,
        'type' => Type::class,
        'target' => Target::class,
        'aimed' => Aimed::class,
        'start' => 'datetime',
        'end' => 'datetime',
        'weekday' => 'array',
        'custom_end_date' => 'datetime',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }

    public function extras(): HasMany
    {
        return $this->hasMany(Extra::class);
    }

    public function results(): BelongsToMany
    {
        return $this->belongsToMany(Result::class);
    }

    public function meals(): BelongsToMany
    {
        return $this->belongsToMany(Meal::class);
    }

    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(Amenity::class);
    }

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class);
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }

    public function categories()
    {
        return $this->morphedByMany(Category::class, 'categorizable');
    }

    public function subcategories()
    {
        return $this->morphedByMany(Subcategory::class, 'categorizable');
    }

    public function packages(): HasMany
    {
        return $this->hasMany(Package::class);
    }
    public function timezone()
    {
        return $this->belongsTo(Timezone::class);
    }

    public function recurrences()
    {
        return $this->hasMany(Recurrence::class);
    }

    public function individual(): HasMany
    {
        return $this->hasMany(Individual::class);
    }

    public function calendars(): HasMany
    {
        return $this->hasMany(Calendar::class);
    }

    public function weekdays(): HasMany
    {
        return $this->hasMany(Weekday::class);
    }

    public function scheduling(): HasOne
    {
        return $this->hasOne(Scheduling::class);
    }

    /**
     * Interact with the user's first name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to filtered services.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['q'] ?? false, fn ($query, $search) => $query->where('services.name', 'LIKE', "%$search%")->orWhereHas('user', fn ($query) => $query->where('name', 'LIKE', "%$search%")));
    }

    public function scopeFilterByUserStatus($query)
    {
        $query->whereHas('user', function ($query) {
            $query->where('status', 1);
        });
    }

    public function scopeFilterByServiceStatus($query)
    {
        $query->where('status', true);
    }

    public function scopeSearch($query, array $filters)
    {

        $query->when($filters['results'] ?? false, function ($query, $ids_result) {

            $query->whereHas('results', fn ($query) => $query->whereIn('results.id', $ids_result));
        });

        $query->when($filters['categories'] ?? false, function ($query, $ids_category) {

            $query->whereHas('categories', fn ($query) => $query->whereIn('categories.id', $ids_category));
            $query->orWhereHas('subcategories', fn ($query) => $query->whereIn('category_id', $ids_category));
        });

        $query->when($filters['subcategories'] ?? false, function ($query, $ids_subcategory) {

            $query->orWhereHas('subcategories', fn ($query) => $query->whereIn('subcategories.id', $ids_subcategory));
        });

        $query->when($filters['methods'] ?? false, function ($query, $ids_method) {

            $query->whereIn('method', $ids_method);
        });

        $query->when($filters['types'] ?? false, function ($query, $ids_type) {

            $query->whereIn('type', $ids_type);
        });

        $query->when($filters['languages'] ?? false, function ($query, $ids_language) {

            $query->whereHas('languages', fn ($query) => $query->whereIn('languages.id', $ids_language));
        });

        $query->when($filters['country_id'] ?? false, function ($query, $id_country) {
            $query->where('country_id', $id_country);
        });

        $query->when($filters['minPrice'] ?? false, function ($query, $price) {

            $query->whereHas('packages', fn ($query) => $query->where('price', ">=", $price));
        });

        $query->when($filters['maxPrice'] ?? false, function ($query, $price) {

            $query->whereHas('packages', fn ($query) => $query->where('price', "<=", $price));
        });

        $query->when($filters['aimeds'] ?? false, function ($query, $ids_aimed) {

            $query->whereIn('aimed', $ids_aimed);
        });

        $query->when($filters['targets'] ?? false, function ($query, $ids_target) {

            $query->whereIn('target', $ids_target);
        });

        $query->when($filters['startDate'] ?? false, function ($query, $start_date) {
            $query->whereDate('start', '>=', Carbon::createFromFormat('d-n-Y', $start_date));
        });

        $query->when($filters['endDate'] ?? false, function ($query, $end_date) {
            $query->whereDate('end', '<=',Carbon::createFromFormat('d-n-Y', $end_date));
        });

    }
    /**
     * Scope a query to user's services.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \App\Models\User  $user
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterUser($query, User $user)
    {
        if (!Gate::allows('viewAny', $this)) {
            $query->where('user_id', 'LIKE', $user->id);
        }
    }
    /**
     * Scope a query to user's services.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function scopeOnlyNotExpiredService($query, string $timezone)
    {
        $query->where('end', '>=', now($timezone));
    }

    public function scopeOnlyNotExpiredIndividualService($query, string $timezone)
    {
        $query->whereHas('calendars', function ($query) use ($timezone) {
            $query->where('end', '>=', now($timezone));
        });
    }
    
}
