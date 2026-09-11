<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Slider extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [

        // Content
        'title',
        'subtitle',

        // Images
        'image',
        'mobile_image',

        // Primary Button
        'button_text',
        'button_url',
        'button_target',

        // Layout
        'alignment',

        // Ordering & Status
        'display_order',
        'status',

        // Scheduling
        'start_date',
        'end_date',

        // Audit
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'status' => 'boolean',
            'display_order' => 'integer',
            'start_date' => 'datetime',
            'end_date' => 'datetime',
        ];
    }

    /**
     * Admin user who created the slider.
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'created_by'
        );
    }

    /**
     * Admin user who last updated the slider.
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'updated_by'
        );
    }
}
