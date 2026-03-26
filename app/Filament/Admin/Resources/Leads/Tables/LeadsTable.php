<?php

namespace App\Filament\Admin\Resources\Leads\Tables;

use App\Enums\LeadStatus;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LeadsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Име')
                    ->searchable(),

                TextColumn::make('phone')
                    ->label('Телефон')
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Имейл')
                    ->searchable(),

                TextColumn::make('source')
                    ->label('Източник')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'contact' => 'Контакт',
                        'quote' => 'Оферта',
                        default => $state,
                    })
                    ->color(fn (string $state) => match ($state) {
                        'contact' => 'gray',
                        'quote' => 'warning',
                        default => 'gray',
                    })
                    ->searchable(),

                TextColumn::make('status')
                    ->label('Статус')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        LeadStatus::New->value => LeadStatus::New->label(),
                        LeadStatus::InProgress->value => LeadStatus::InProgress->label(),
                        LeadStatus::Done->value => LeadStatus::Done->label(),
                        default => $state,
                    })
                    ->color(fn (string $state) => match ($state) {
                        LeadStatus::New->value => 'warning',
                        LeadStatus::InProgress->value => 'info',
                        LeadStatus::Done->value => 'success',
                        default => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->label('Създадено')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Статус')
                    ->options([
                        LeadStatus::New->value => LeadStatus::New->label(),
                        LeadStatus::InProgress->value => LeadStatus::InProgress->label(),
                        LeadStatus::Done->value => LeadStatus::Done->label(),
                    ]),
            ])
            ->recordActions([
                ViewAction::make()->label('Преглед'),
                EditAction::make()->label('Редакция'),

                Action::make('mark_in_progress')
                    ->label('В процес')
                    ->icon('heroicon-o-play')
                    ->visible(fn ($record) => $record->status !== LeadStatus::InProgress->value)
                    ->action(function ($record) {
                        $record->update([
                            'status' => LeadStatus::InProgress->value,
                            'contacted_at' => now(),
                        ]);
                    }),

                Action::make('mark_done')
                    ->label('Обработено')
                    ->icon('heroicon-o-check')
                    ->visible(fn ($record) => $record->status !== LeadStatus::Done->value)
                    ->action(function ($record) {
                        $record->update([
                            'status' => LeadStatus::Done->value,
                            'contacted_at' => $record->contacted_at ?? now(),
                        ]);
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Изтрий'),
                ]),
            ]);
    }
}
