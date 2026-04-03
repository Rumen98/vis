<?php

namespace App\Filament\Admin\Resources\Leads\Tables;

use App\Enums\LeadStatus;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
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
                    ->formatStateUsing(
                        fn (LeadStatus|string|null $state): string => LeadStatus::tryFromValue($state)?->label() ?? (string) $state
                    )
                    ->color(
                        fn (LeadStatus|string|null $state): string => LeadStatus::tryFromValue($state)?->color() ?? 'gray'
                    ),

                TextColumn::make('created_at')
                    ->label('Създадено')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Статус')
                    ->options(LeadStatus::options()),
            ])
            ->recordActions([
                ViewAction::make()->label('Преглед'),
                EditAction::make()->label('Редакция'),

                Action::make('mark_in_progress')
                    ->label('В процес')
                    ->icon('heroicon-o-play')
                    ->visible(fn ($record) => LeadStatus::tryFromValue($record->status) !== LeadStatus::InProgress)
                    ->action(function ($record) {
                        $record->update([
                            'status' => LeadStatus::InProgress,
                            'contacted_at' => now(),
                        ]);
                    }),

                Action::make('mark_done')
                    ->label('Обработено')
                    ->icon('heroicon-o-check')
                    ->visible(fn ($record) => LeadStatus::tryFromValue($record->status) !== LeadStatus::Done)
                    ->action(function ($record) {
                        $record->update([
                            'status' => LeadStatus::Done,
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
