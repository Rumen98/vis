<?php

namespace App\Filament\Admin\Resources\Solutions\Schemas;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SolutionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Заглавие')
                    ->required()
                    ->maxLength(255),

                Select::make('solution_type')
                    ->label('Тип решение')
                    ->options([
                        'business' => 'Бизнес решения',
                        'smb' => 'SMB решения',
                    ])
                    ->required()
                    ->native(false)
                    ->default('business'),

                Textarea::make('description')
                    ->label('Описание')
                    ->rows(4)
                    ->columnSpanFull(),

                Select::make('icon')
                    ->label('Икона')
                    ->options(self::iconOptions())
                    ->searchable()
                    ->native(false),

                Placeholder::make('linked_article_info')
                    ->label('Свързана статия')
                    ->content(function (?object $record): string {
                        if (! $record) {
                            return 'Ще можеш да закачиш статия след като запишеш решението.';
                        }

                        $record->loadMissing('article');

                        if ($record->article) {
                            return '1 свързана статия: ' . $record->article->title;
                        }

                        return 'Няма свързана статия.';
                    })
                    ->columnSpanFull(),

                Repeater::make('bullets')
                    ->label('Точки (булети)')
                    ->schema([
                        TextInput::make('value')
                            ->label('Текст')
                            ->required(),
                    ])
                    ->defaultItems(0)
                    ->reorderable()
                    ->columnSpanFull()
                    ->dehydrateStateUsing(function (?array $state) {
                        $items = $state ?? [];
                        $values = [];

                        foreach ($items as $row) {
                            $v = trim((string) ($row['value'] ?? ''));
                            if ($v !== '') {
                                $values[] = $v;
                            }
                        }

                        return $values;
                    })
                    ->afterStateHydrated(function ($component, $state) {
                        if (! is_array($state)) {
                            $component->state([]);
                            return;
                        }

                        $rows = [];
                        foreach ($state as $v) {
                            $rows[] = ['value' => $v];
                        }

                        $component->state($rows);
                    }),

                TextInput::make('sort_order')
                    ->label('Ред')
                    ->numeric()
                    ->default(0),

                Select::make('is_active')
                    ->label('Активна')
                    ->options([
                        1 => 'Да',
                        0 => 'Не',
                    ])
                    ->default(1),
            ]);
    }

    private static function iconOptions(): array
    {
        return [
            '64pxsolutions.png' => 'Решения (64pxsolutions.png)',
            '64pxservices.png' => 'Услуги (64pxservices.png)',
            '64pxcctv.png' => 'CCTV (64pxcctv.png)',
            '64pxlan.png' => 'LAN (64pxlan.png)',
            '64pxcables.png' => 'Кабели (64pxcables.png)',
            '64pxwork.png' => 'Поддръжка / Сервиз (64pxwork.png)',
            '64pxtime.png' => 'Време (64pxtime.png)',
            '64pxwhyus.png' => 'За нас (64pxwhyus.png)',
            '64pxcontacts.png' => 'Контакти (64pxcontacts.png)',
            '64pxphone.png' => 'Телефон (64pxphone.png)',
            '64pxmail.png' => 'Mail (64pxmail.png)',
            '64pxoffer.png' => 'Оферта (64pxoffer.png)',
            'icon1.png' => 'Икона 1 (icon1.png)',
            'icon2.png' => 'Икона 2 (icon2.png)',
            'icon3.png' => 'Икона 3 (icon3.png)',
            'icon4.png' => 'Икона 4 (icon4.png)',
            'icon5.png' => 'Икона 5 (icon5.png)',
        ];
    }
}