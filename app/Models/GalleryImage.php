<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GalleryImage extends Model
{
    use HasFactory;

    protected $table = 'gallery_images';

    protected $fillable = [
        'album_id',
        'image',
        'title',
        'alt_text',
        'order',
        'status',
    ];

    protected $casts = [
        'order' => 'integer',
        'status' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Album Relationship
    |--------------------------------------------------------------------------
    */

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }
}
