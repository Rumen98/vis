<?php

namespace App\Filament\Admin\Resources\Services\Schemas;

use App\Support\Filament\SimpleRepeaterList;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Заглавие')
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')
                    ->label('Описание')
                    ->rows(4)
                    ->columnSpanFull(),

                Select::make('icon')
                    ->label('Икона')
                    ->options(self::iconOptions())
                    ->searchable()
                    ->native(false),

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
                    ->dehydrateStateUsing([SimpleRepeaterList::class, 'dehydrate'])
                    ->afterStateHydrated([SimpleRepeaterList::class, 'hydrate']),

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
            '64pxcctv.png' => 'CCTV (64pxcctv.png)',
            '64pxlan.png' => 'LAN (64pxlan.png)',
            '64pxservices.png' => 'Услуги (64pxservices.png)',
            '64pxsolutions.png' => 'Решения (64pxsolutions.png)',
            '64pxcontacts.png' => 'Контакти (64pxcontacts.png)',
            '64pxoffer.png' => 'Оферта (64pxoffer.png)',
            '64pxmail.png' => 'Mail (64pxmail.png)',
            '64pxphone.png' => 'Phone (64pxphone.png)',
            '64pxtime.png' => 'Time (64pxtime.png)',
            '64pxwork.png' => 'Work (64pxwork.png)',
            '64pxwhyus.png' => 'За нас (64pxwhyus.png)',
            '64pxcables.png' => 'Кабели (64pxcables.png)',
            '64pxzapitvane.png' => 'Запитване (64pxzapitvane.png)',

            // NEW ICONS
            'icon1.png' => 'Икона 1 (icon1.png)',
            'icon2.png' => 'Икона 2 (icon2.png)',
            'icon3.png' => 'Икона 3 (icon3.png)',
            'icon4.png' => 'Икона 4 (icon4.png)',
            'icon5.png' => 'Икона 5 (icon5.png)',
        ];
    }
}
