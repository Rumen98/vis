<?php

namespace App\Models;

use App\Models\Concerns\HasActiveAndSortScopes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ObjectSolution extends Model
{
    use HasActiveAndSortScopes;

    /** Налични иконки (ключ => SVG path). */
    public const ICONS = [
        'house' => 'M3 11.5 12 4l9 7.5M5.5 9.8V19a1 1 0 0 0 1 1H10v-5h4v5h3.5a1 1 0 0 0 1-1V9.8',
        'building' => 'M4 21h16M6 21V5a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v16M15 21V9h3a1 1 0 0 1 1 1v11M9 8h2M9 12h2M9 16h2',
        'apartment' => 'M3 21h18M5 21V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v17M9 7h2M13 7h2M9 11h2M13 11h2M9 15h2M13 15h2',
        'utensils' => 'M5 4v5a3 3 0 0 0 6 0V4M8 12v8M17 4c-1.5 0-2.5 2-2.5 4.5S15.5 13 17 13s2.5-2 2.5-4.5S18.5 4 17 4ZM17 13v7',
        'store' => 'M4 9 5 4h14l1 5M5 9v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9M4 9h16M9.5 13h5',
        'warehouse' => 'M3 9l9-4 9 4v11a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9Z',
        'camera' => 'M3 8h12l4 3v6a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V8Z M7 12h.01',
        'shield' => 'M12 3 5 6v5c0 4 3 7.5 7 8.5 4-1 7-4.5 7-8.5V6l-7-3Z',
    ];

    protected $fillable = [
        'title',
        'description',
        'tagline',
        'icon',
        'solution_id',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function solution(): BelongsTo
    {
        return $this->belongsTo(Solution::class);
    }

    public function url(): string
    {
        return $this->solution && $this->solution->slug
            ? route('solutions.show', $this->solution->slug)
            : route('solutions');
    }

    public function iconPath(): ?string
    {
        return self::ICONS[$this->icon] ?? null;
    }

    /**
     * @return array<string, string>
     */
    public static function iconOptions(): array
    {
        return [
            'house' => 'Къща / Дом',
            'building' => 'Офис сграда',
            'apartment' => 'Жилищна сграда',
            'utensils' => 'Заведение',
            'store' => 'Магазин',
            'warehouse' => 'Склад',
            'camera' => 'Камера',
            'shield' => 'Щит / Защита',
        ];
    }
}
