<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Solution extends Model
{
    protected $fillable = [
        'title',
        'solution_type',
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

    public function article(): HasOne
    {
        return $this->hasOne(Article::class);
    }
}