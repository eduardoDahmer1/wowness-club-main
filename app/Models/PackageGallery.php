<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PackageGallery extends Model
{
    use HasFactory;

    protected $table = "packages_galleries";

    public $timestamps = false;
    
    protected $fillable = [
        'package_id',
        'path'
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
}
