<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Page extends Model
{
    use HasFactory;

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'title',
        'slug',
        'template',
        'short_description',
        'content',
        'featured_image',
        'status',
        'display_order',
        'created_by',
        'updated_by',
    ];

    /**
     * Attribute casting.
     */
    protected $casts = [
        'status' => 'boolean',
        'display_order' => 'integer',
    ];

    /**
     * User who created the page.
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * User who last updated the page.
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
