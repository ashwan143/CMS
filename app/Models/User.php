<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /*
    |--------------------------------------------------------------------------
    | Role Relationship
    |--------------------------------------------------------------------------
    */

    public function role(): BelongsTo
    {
        return $this->belongsTo(
            Role::class,
            'role_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Permission Check
    |--------------------------------------------------------------------------
    */

    public function hasPermission(string $permission): bool
    {
        return $this->role
            && $this->role->permissions()
                ->where('slug', $permission)
                ->exists();
    }
}
