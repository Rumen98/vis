<?php

namespace App\Enums;

enum LeadStatus: string
{
    case New = 'new';
    case InProgress = 'in_progress';
    case Done = 'done';

    public function label(): string
    {
        return match ($this) {
            self::New => 'Ново',
            self::InProgress => 'В процес',
            self::Done => 'Обработено',
        };
    }
}
