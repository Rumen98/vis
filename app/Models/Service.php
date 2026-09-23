<?php

namespace App\Models;

use App\Models\Concerns\HasActiveAndSortScopes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Service extends Model
{
    use HasActiveAndSortScopes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'intro_heading',
        'intro_text',
        'featured_image',
        'body',
        'icon',
        'bullets',
        'problems',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'bullets' => 'array',
        'problems' => 'array',
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::updating(function (self $service): void {
            if ($service->isDirty('featured_image') && $service->getOriginal('featured_image')) {
                Storage::disk('public')->delete($service->getOriginal('featured_image'));
            }
        });

        static::deleting(function (self $service): void {
            if ($service->featured_image) Storage::disk('public')->delete($service->featured_image);
        });
    }
}
