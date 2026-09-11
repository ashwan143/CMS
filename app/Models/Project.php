<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    /**
     * Mass assignable fields.
     */
    protected $fillable = [
        'title',
        'slug',
        'category',
        'short_description',
        'description',
        'image',
        'client_name',
        'project_url',
        'completion_date',
        'display_order',
        'status',
        'created_by',
    ];

    /**
     * Attribute casting.
     */
    protected $casts = [
        'completion_date' => 'date',
        'display_order' => 'integer',
        'status' => 'boolean',
    ];

    /**
     * Project creator.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Technologies used in this project.
     */
    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(
            Technology::class,
            'project_technology',
            'project_id',
            'technology_id'
        );
    }
}
