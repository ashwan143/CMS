<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Testimonial extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Mass Assignable Fields
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        // Client
        'client_name',
        'designation',
        'company_name',
        'client_photo',
        'company_logo',

        // Testimonial
        'testimonial',
        'rating',

        // Project
        'project_id',

        // Publishing
        'status',
        'is_featured',
        'display_order',
        'published_at',

        // SEO / Accessibility
        'photo_alt',
        'logo_alt',

        // Admin
        'created_by',
    ];


    /*
    |--------------------------------------------------------------------------
    | Attribute Casting
    |--------------------------------------------------------------------------
    */

    protected $casts = [

        'rating' => 'integer',

        'status' => 'boolean',

        'is_featured' => 'boolean',

        'display_order' => 'integer',

        'published_at' => 'datetime',

    ];


    /*
    |--------------------------------------------------------------------------
    | Project Relationship
    |--------------------------------------------------------------------------
    */

    public function project(): BelongsTo
    {
        return $this->belongsTo(
            Project::class,
            'project_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Created By Relationship
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
