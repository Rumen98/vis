<?php

namespace App\Support;

class Icon
{
    public static function path(string $key): string
    {
        $file = config("icons.$key");

        if (! $file) {
            return asset('icons/checkmark.png'); // fallback
        }

        return asset('icons/'.$file);
    }
}
