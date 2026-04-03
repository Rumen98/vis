<?php

namespace App\Filament\Admin\Resources\Leads\Schemas;

use App\Enums\LeadStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LeadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Име')
                    ->required(),

                TextInput::make('phone')
                    ->label('Телефон')
                    ->tel()
                    ->required(),

                TextInput::make('email')
                    ->label('Имейл')
                    ->email(),

                TextInput::make('object_type')
                    ->label('Тип обект')
                    ->placeholder('Дом, офис, магазин, склад...'),

                Textarea::make('message')
                    ->label('Съобщение')
                    ->columnSpanFull(),

                TextInput::make('source')
                    ->label('Източник')
                    ->required()
                    ->default('contact'),

                // --- Новите полета за workflow ---
                Select::make('status')
                    ->label('Статус')
                    ->options(LeadStatus::options())
                    ->required()
                    ->default(LeadStatus::New->value),

                Textarea::make('admin_note')
                    ->label('Бележка (вътрешна)')
                    ->rows(5)
                    ->placeholder('Напр. говорено по тел., цена, срокове, уточнения...')
                    ->columnSpanFull(),

                DateTimePicker::make('contacted_at')
                    ->label('Контактуван на')
                    ->seconds(false),
            ]);
    }
}
