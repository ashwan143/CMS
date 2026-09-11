<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Service extends Model
{
    protected $fillable = [

        'title',
        'slug',
        'short_description',
        'description',
        'icon',
        'image',
        'display_order',
        'status',
        'seo_title',
        'seo_keywords',
        'seo_description',
        'created_by',

    ];

    /**
     * Admin who created the service.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
