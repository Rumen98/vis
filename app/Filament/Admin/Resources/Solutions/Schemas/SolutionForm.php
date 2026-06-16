<?php

namespace App\Filament\Admin\Resources\Solutions\Schemas;

use App\Models\Solution;
use App\Support\Filament\SimpleRepeaterList;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class SolutionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Заглавие')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set, $get) {
                        if (! $get('slug')) {
                            $set('slug', Str::slug((string) $state));
                        }
                    }),

                TextInput::make('slug')
                    ->label('Slug (адрес на подстраницата)')
                    ->helperText('Пример: sigurnost-za-ofisi → /solutions/sigurnost-za-ofisi')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),

                Select::make('solution_type')
                    ->label('Тип решение')
                    ->options(Solution::typeOptions())
                    ->required()
                    ->native(false)
                    ->default(Solution::TYPE_BUSINESS),

                Textarea::make('description')
                    ->label('Описание')
                    ->rows(4)
                    ->columnSpanFull(),

                Select::make('icon')
                    ->label('Икона')
                    ->options(self::iconOptions())
                    ->searchable()
                    ->native(false),

                RichEditor::make('body')
                    ->label('Съдържание на подстраницата')
                    ->helperText('Текстът за конкретното решение, който се показва на собствената му страница.')
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('solutions/content')
                    ->toolbarButtons([
                        'bold', 'italic', 'underline', 'strike',
                        'bulletList', 'orderedList', 'h2', 'h3',
                        'blockquote', 'link', 'attachFiles', 'redo', 'undo',
                    ])
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
                    ->dehydrateStateUsing(fn ($state) => SimpleRepeaterList::dehydrate($state))
                    ->afterStateHydrated(fn (Repeater $component, $state) => SimpleRepeaterList::hydrate($component, $state)),

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
