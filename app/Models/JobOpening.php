<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOpening extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'department',
        'location',
        'employment_type',
        'experience',
        'salary',
        'short_description',
        'description',
        'requirements',
        'responsibilities',
        'application_email',
        'deadline',
        'order',
        'status',
        'is_featured',
        'seo_title',
        'seo_keywords',
        'seo_description',
        'created_by',
    ];

    protected $casts = [
        'deadline' => 'date',
        'order' => 'integer',
        'status' => 'boolean',
        'is_featured' => 'boolean',
        'created_by' => 'integer',
    ];

    /**
     * Admin user who created the job opening.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
