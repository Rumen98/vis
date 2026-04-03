<?php

namespace App\Support\Filament;

use Filament\Forms\Components\Repeater;

class SimpleRepeaterList
{
    /**
     * @param  array<int, array<string, mixed>>|null  $state
     * @return array<int, string>
     */
    public static function dehydrate(?array $state): array
    {
        $values = [];

        foreach ($state ?? [] as $row) {
            $value = trim((string) ($row['value'] ?? ''));

            if ($value !== '') {
                $values[] = $value;
            }
        }

        return $values;
    }

    public static function hydrate(Repeater $component, mixed $state): void
    {
        if (! is_array($state)) {
            $component->state([]);

            return;
        }

        $component->state(
            array_map(
                static fn (mixed $value): array => ['value' => (string) $value],
                $state,
            ),
        );
    }
}
