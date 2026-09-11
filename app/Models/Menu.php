<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'parent_id',
        'title',
        'type',
        'page_id',
        'url',
        'icon',
        'target',
        'display_order',
        'location',
        'status',
    ];

    /**
     * Attribute casting.
     */
    protected $casts = [
        'status' => 'boolean',
        'display_order' => 'integer',
    ];

    /**
     * Parent menu item.
     *
     * Example:
     * Services
     * ├── Web Development
     * └── Mobile App Development
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    /**
     * Child menu items.
     */
    public function children(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id')
            ->orderBy('display_order');
    }

    /**
     * Related CMS page.
     */
    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
