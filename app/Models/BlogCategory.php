<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogCategory extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',
        'slug',
        'description',
        'image',

        'order',
        'status',

        'created_by',
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

            'order' => 'integer',
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Blogs
    |--------------------------------------------------------------------------
    */

    public function blogs(): HasMany
    {
        return $this->hasMany(
            Blog::class,
            'category_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Created By
    |--------------------------------------------------------------------------
    */

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'created_by'
        );
    }
}
