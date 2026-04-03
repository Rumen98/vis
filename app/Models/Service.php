<?php

namespace App\Models;

use App\Models\Concerns\HasActiveAndSortScopes;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasActiveAndSortScopes;

    protected $fillable = [
        'title',
        'description',
        'icon',
        'bullets',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'bullets' => 'array',
        'is_active' => 'boolean',
    ];
}
