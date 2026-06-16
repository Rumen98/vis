<?php

namespace App\Filament\Admin\Resources\ObjectSolutions;

use App\Filament\Admin\Resources\ObjectSolutions\Pages\CreateObjectSolution;
use App\Filament\Admin\Resources\ObjectSolutions\Pages\EditObjectSolution;
use App\Filament\Admin\Resources\ObjectSolutions\Pages\ListObjectSolutions;
use App\Models\ObjectSolution;
use App\Models\Solution;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use UnitEnum;

class ObjectSolutionResource extends Resource
{
    protected static ?string $model = ObjectSolution::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;

    protected static ?string $navigationLabel = 'Решения според обекта';

    protected static ?string $modelLabel = 'Карта (обект)';

    protected static ?string $pluralModelLabel = 'Решения според обекта';

    protected static string|UnitEnum|null $navigationGroup = 'Съдържание';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')
                ->label('Заглавие')
                ->required()
                ->maxLength(255),

            Textarea::make('description')
                ->label('Кратък текст')
                ->rows(3)
                ->columnSpanFull(),

            TextInput::make('tagline')
                ->label('Червен надпис (отдолу)')
                ->maxLength(120)
                ->helperText('Кратка фраза в червено, напр. „Спокойствие и контрол“.'),

            Select::make('icon')
                ->label('Иконка')
                ->options(ObjectSolution::iconOptions())
                ->native(false)
                ->searchable(),

            Select::make('solution_id')
                ->label('Води към решение')
                ->options(fn () => Solution::query()->active()->ordered()->pluck('title', 'id')->all())
                ->searchable()
                ->native(false)
                ->placeholder('Към общите решения (/solutions)')
                ->helperText('Избери конкретното решение, към което да води картата.'),

            TextInput::make('sort_order')
                ->label('Ред')
                ->numeric()
                ->default(0),

            Toggle::make('is_active')
                ->label('Активна')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Заглавие')->searchable(),
                TextColumn::make('tagline')->label('Червен надпис')->placeholder('—'),
                TextColumn::make('solution.title')->label('Води към')->placeholder('Общи решения'),
                TextColumn::make('sort_order')->label('Ред')->sortable(),
                ToggleColumn::make('is_active')->label('Активна'),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListObjectSolutions::route('/'),
            'create' => CreateObjectSolution::route('/create'),
            'edit' => EditObjectSolution::route('/{record}/edit'),
        ];
    }
}
