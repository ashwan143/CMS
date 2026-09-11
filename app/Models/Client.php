<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'industry',
        'logo',
        'website',
        'short_description',
        'description',
        'order',
        'status',
        'is_featured',
        'seo_title',
        'seo_keywords',
        'seo_description',
        'created_by',
    ];

    protected $casts = [
        'status' => 'boolean',
        'is_featured' => 'boolean',
        'order' => 'integer',
        'created_by' => 'integer',
    ];

    /**
     * Client creator.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
