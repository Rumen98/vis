<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class SiteSetting extends Model
{
    /** Стойности по подразбиране за бутона върху видеото. */
    public const DEFAULT_VIDEO_BUTTON_LABEL = 'Научете повече';

    public const DEFAULT_VIDEO_BUTTON_URL = 'https://tools.viscctv.com';

    protected $fillable = [
        'home_video_path',
        'home_video_poster',
        'home_video_button_enabled',
        'home_video_button_label',
        'home_video_button_url',
    ];

    protected $casts = [
        'home_video_button_enabled' => 'boolean',
    ];

    public function videoButtonLabel(): string
    {
        return filled($this->home_video_button_label)
            ? $this->home_video_button_label
            : self::DEFAULT_VIDEO_BUTTON_LABEL;
    }

    public function videoButtonUrl(): string
    {
        return filled($this->home_video_button_url)
            ? $this->home_video_button_url
            : self::DEFAULT_VIDEO_BUTTON_URL;
    }

    public function videoButtonEnabled(): bool
    {
        // Колоната може да липсва, ако миграцията не е пусната — тогава true.
        return $this->home_video_button_enabled ?? true;
    }

    /**
     * Връща единствения ред с настройки, като го създава при нужда.
     *
     * Ако таблицата още не съществува (напр. миграцията не е пусната
     * на сървъра), връща празна непостоянна инстанция, за да не се
     * чупи публичната страница.
     */
    public static function current(): self
    {
        if (! Schema::hasTable('site_settings')) {
            return new static();
        }

        return static::query()->firstOrCreate([]);
    }
}
