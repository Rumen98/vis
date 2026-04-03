<?php

namespace App\Models;

use App\Enums\LeadStatus;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'object_type',
        'message',
        'source',
        'status',
        'admin_note',
        'contacted_at',
    ];

    protected $casts = [
        'status' => LeadStatus::class,
        'contacted_at' => 'datetime',
    ];
}
