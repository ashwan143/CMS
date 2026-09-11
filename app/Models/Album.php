<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'cover_image',
        'order',
        'status',
        'created_by',
    ];

    protected $casts = [
        'status' => 'boolean',
        'order' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function galleryImages(): HasMany
    {
        return $this->hasMany(GalleryImage::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
