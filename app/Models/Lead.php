<?php

namespace App\Models;

use App\Enums\LeadStatus;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    /**
     * Типове обекти. Ключовете са стабилни - старите записи
     * (home / office / shop / other) продължават да се четат коректно.
     *
     * @var array<string, string>
     */
    public const OBJECT_TYPES = [
        'home' => 'Дом / апартамент',
        'house' => 'Къща / вила',
        'office' => 'Офис / бизнес',
        'building' => 'Жилищна сграда',
        'shop' => 'Магазин / заведение',
        'other' => 'Друго',
    ];

    /**
     * Услугите от стъпка 2 на подробното запитване.
     *
     * @var array<int, string>
     */
    public const SERVICES = [
        'Видеонаблюдение',
        'Охранителни системи (СОТ)',
        'LAN и Wi-Fi мрежи',
        'Видеодомофони и контрол на достъпа',
        'Паркинг решения',
        'Структурно окабеляване',
        'Абонаментна поддръжка',
        'Друго / не съм сигурен',
    ];

    /**
     * Предпочитан срок от стъпка 3.
     *
     * @var array<int, string>
     */
    public const TIMINGS = [
        'Възможно най-скоро',
        'До 1–2 седмици',
        'До месец',
        'Планирам предварително',
    ];

    protected $fillable = [
        'name',
        'phone',
        'email',
        'object_type',
        'service',
        'area',
        'timing',
        'consent',
        'message',
        'source',
        'status',
        'admin_note',
        'contacted_at',
    ];

    protected $casts = [
        'status' => LeadStatus::class,
        'consent' => 'boolean',
        'contacted_at' => 'datetime',
    ];

    /** Човешкото име на типа обект (с fallback към суровата стойност). */
    public function objectTypeLabel(): ?string
    {
        if (blank($this->object_type)) {
            return null;
        }

        return self::OBJECT_TYPES[$this->object_type] ?? $this->object_type;
    }

    /** @return array<string, string> */
    public static function objectTypeOptions(): array
    {
        return self::OBJECT_TYPES;
    }

    /** @return array<string, string> */
    public static function serviceOptions(): array
    {
        return array_combine(self::SERVICES, self::SERVICES);
    }

    /** @return array<string, string> */
    public static function timingOptions(): array
    {
        return array_combine(self::TIMINGS, self::TIMINGS);
    }
}
