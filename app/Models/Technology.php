<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'description',
        'order',
        'status',
    ];

    protected $casts = [
        'order' => 'integer',
        'status' => 'boolean',
    ];

    /**
     * Projects using this technology.
     */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(
            Project::class,
            'project_technology',
            'technology_id',
            'project_id'
        );
    }
}
