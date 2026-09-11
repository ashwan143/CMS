<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [

        'category_id',

        'title',
        'slug',

        'short_description',
        'content',

        'featured_image',

        'author_id',

        'status',
        'published_at',

        'seo_title',
        'seo_description',

        'order',
    ];


    /*
    |--------------------------------------------------------------------------
    | Casts
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [

            'status' => 'boolean',

            'published_at' => 'datetime',

            'order' => 'integer',
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Category
    |--------------------------------------------------------------------------
    */

    public function category(): BelongsTo
    {
        return $this->belongsTo(
            BlogCategory::class,
            'category_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Author
    |--------------------------------------------------------------------------
    */

    public function author(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'author_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Tags
    |--------------------------------------------------------------------------
    */

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(
            BlogTag::class,
            'blog_tag',
            'blog_id',
            'tag_id'
        )->withTimestamps();
    }
}
