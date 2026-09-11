<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'slug',
        'short_question',
        'answer',
        'category',
        'order',
        'status',
        'is_featured',
        'seo_title',
        'seo_keywords',
        'seo_description',
        'created_by',
    ];

    protected $casts = [
        'order' => 'integer',
        'status' => 'boolean',
        'is_featured' => 'boolean',
        'created_by' => 'integer',
    ];

    /**
     * Admin user who created the FAQ.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
