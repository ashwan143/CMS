<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'designation',
        'profile_image',
        'bio',
        'social_links',
        'order',
        'status',
        'created_by',
    ];

    protected $casts = [
        'social_links' => 'array',
        'order' => 'integer',
        'status' => 'boolean',
        'created_by' => 'integer',
    ];

    /**
     * Admin user who created the team member.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
