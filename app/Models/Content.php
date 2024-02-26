<?php

namespace App\Models;

use App\Enums\Aimed;
use App\Enums\ContentType;
use App\Enums\Cost;
use App\Enums\Plan;
use Illuminate\Support\Facades\Gate;
use App\Enums\Target;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $guarded = ['id'];

    protected $casts = [
        'cost' => Cost::class,
        'target' => Target::class,
        'aimed' => Aimed::class,
        'type' => ContentType::class,
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['q'] ?? false, fn ($query, $search) => $query->where('contents.title', 'LIKE', "%$search%"));
    }

    public function goals(): BelongsToMany
    {
        return $this->belongsToMany(Result::class, 'result_content');
    }

    public function categories()
    {
        return $this->morphedByMany(Category::class, 'categorizable', 'content_categorizables');
    }

    public function subcategories()
    {
        return $this->morphedByMany(Subcategory::class, 'categorizable', 'content_categorizables');
    }

    public function learns()
    {
        return $this->hasMany(Learn::class);
    }

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class, 'language_content');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(ContentLesson::class);
    }

    public function results(): BelongsToMany
    {
        return $this->belongsToMany(Result::class, 'result_content');

    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    public function syncLessons($lessonsData)
    {
        foreach ($lessonsData as $lessonData) {
            $lesson = new ContentLesson([
                'title' => $lessonData['title'],
                'subtitle' => $lessonData['subtitle'],
                'video_url' => $lessonData['url'],
            ]);

            $this->lessons()->save($lesson);
        }
    }

    protected function thumbnailUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (filter_var($this->thumbnail, FILTER_VALIDATE_URL)) {
                    return $this->thumbnail;
                }

                return asset('storage/' . $this->thumbnail);
            },
        );
    }

    public function scopeFilterByUserStatus($query)
    {
        $query->whereHas('user', function ($query) {
            $query->where('status', 1);
        });
    }

    public function scopeFilterByUserPlan($query)
    {
        $query->whereHas('user', function ($query) {
            $query->whereHas('subscription', function ($query) {
                $query->where('plan', '!=', Plan::Free);
            });
        });
    }

    public function scopeFilterByContentStatus($query)
    {
        $query->where('status', true);
    }

    public function scopePaidContents($query, $limit = 12)
    {
        return $query->where('cost', Cost::Paid->value)->where('status', 1)->take($limit);
    }

    public function scopeFreeContents($query, $limit = 12)
    {
        return $query->where('cost', Cost::Free->value)->where('status', 1)->take($limit);
    }

    public function scopeSearch($query, array $filters)
    {

        $query->when($filters['results'] ?? false, function ($query, $ids_results) {

            $query->whereHas('results', fn ($query) => $query->whereIn('results.id', $ids_results));
        });

        $query->when($filters['categories'] ?? false, function ($query, $ids_category) {

            $query->whereHas('categories', fn ($query) => $query->whereIn('categories.id', $ids_category));
            $query->orWhereHas('subcategories', fn ($query) => $query->whereIn('category_id', $ids_category));
        });

        $query->when($filters['subcategories'] ?? false, function ($query, $ids_subcategory) {

            $query->orWhereHas('subcategories', fn ($query) => $query->whereIn('subcategories.id', $ids_subcategory));
        });

        $query->when($filters['types'] ?? false, function ($query, $ids_type) {

            $query->whereIn('type', $ids_type);
        });

        $query->when($filters['cost'] ?? false, function ($query, $ids_cost) {

            $query->whereIn('cost', $ids_cost);
        });

        $query->when($filters['languages'] ?? false, function ($query, $ids_language) {

            $query->whereHas('languages', fn ($query) => $query->whereIn('languages.id', $ids_language));
        });

        $query->when($filters['minPrice'] ?? false, function ($query, $price) {
            $query->where('price', ">=", $price);
        });

        $query->when($filters['maxPrice'] ?? false, function ($query, $price) {
           $query->where('price', "<=", $price);
        });

        $query->when($filters['aimeds'] ?? false, function ($query, $ids_aimed) {

            $query->whereIn('aimed', $ids_aimed);
        });

        $query->when($filters['targets'] ?? false, function ($query, $ids_target) {

            $query->whereIn('target', $ids_target);
        });

    }

    public function scopeFilterUser($query, User $user)
    {
        if (!Gate::allows('viewAny', $this)) {
            $query->where('user_id', 'LIKE', $user->id);
        }
    }
}
