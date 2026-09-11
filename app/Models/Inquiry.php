<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'type',
        'status',
        'assigned_to',
    ];

    protected $casts = [
        'status' => 'integer',
        'assigned_to' => 'integer',
    ];

    /**
     * User assigned to this inquiry.
     */
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
