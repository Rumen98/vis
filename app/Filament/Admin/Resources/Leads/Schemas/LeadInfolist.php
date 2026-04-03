<?php

namespace App\Filament\Admin\Resources\Leads\Schemas;

use App\Enums\LeadStatus;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LeadInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('phone'),
                TextEntry::make('email')
                    ->label('Имейл')
                    ->placeholder('-'),
                TextEntry::make('object_type')
                    ->label('Тип обект')
                    ->placeholder('-'),
                TextEntry::make('message')
                    ->label('Съобщение')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('source')
                    ->label('Източник'),
                TextEntry::make('status')
                    ->label('Статус')
                    ->badge()
                    ->formatStateUsing(
                        fn (LeadStatus|string|null $state): string => LeadStatus::tryFromValue($state)?->label() ?? (string) $state
                    ),
                TextEntry::make('admin_note')
                    ->label('Вътрешна бележка')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('contacted_at')
                    ->label('Контактуван на')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->label('Създадено на')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Обновено на')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
