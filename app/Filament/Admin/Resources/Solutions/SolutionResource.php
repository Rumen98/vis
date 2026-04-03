<?php

namespace App\Filament\Admin\Resources\Solutions;

use App\Filament\Admin\Resources\Solutions\Pages\CreateSolution;
use App\Filament\Admin\Resources\Solutions\Pages\EditSolution;
use App\Filament\Admin\Resources\Solutions\Pages\ListSolutions;
use App\Filament\Admin\Resources\Solutions\Schemas\SolutionForm;
use App\Filament\Admin\Resources\Solutions\Schemas\SolutionInfolist;
use App\Filament\Admin\Resources\Solutions\Tables\SolutionsTable;
use App\Models\Solution;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SolutionResource extends Resource
{
    protected static ?string $model = Solution::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedLightBulb;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationLabel = 'Решения';

    protected static ?string $modelLabel = 'Решение';

    protected static ?string $pluralModelLabel = 'Решения';

    protected static \UnitEnum|string|null $navigationGroup = 'Съдържание';

    public static function form(Schema $schema): Schema
    {
        return SolutionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SolutionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SolutionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSolutions::route('/'),
            'create' => CreateSolution::route('/create'),
            'edit' => EditSolution::route('/{record}/edit'),
        ];
    }
}
