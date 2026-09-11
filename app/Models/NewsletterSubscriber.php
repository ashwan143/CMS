<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsletterSubscriber extends Model
{
    use HasFactory;

    protected $table = 'newsletter';

    protected $fillable = [
        'name',
        'email',
        'status',
        'subscribed_at',
    ];

    protected $casts = [
        'status' => 'boolean',
        'subscribed_at' => 'datetime',
    ];
}
