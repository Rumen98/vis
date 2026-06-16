<?php

namespace App\Filament\Admin\Resources\GalleryImages;

use App\Filament\Admin\Resources\GalleryImages\Pages\CreateGalleryImage;
use App\Filament\Admin\Resources\GalleryImages\Pages\EditGalleryImage;
use App\Filament\Admin\Resources\GalleryImages\Pages\ListGalleryImages;
use App\Models\GalleryImage;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use UnitEnum;

class GalleryImageResource extends Resource
{
    protected static ?string $model = GalleryImage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static ?string $navigationLabel = 'Галерия (Нашата работа)';

    protected static ?string $modelLabel = 'Снимка';

    protected static ?string $pluralModelLabel = 'Галерия';

    protected static string|UnitEnum|null $navigationGroup = 'Съдържание';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            FileUpload::make('image')
                ->label('Снимка')
                ->disk('public')
                ->directory('gallery')
                ->image()
                ->imageEditor()
                ->required()
                ->maxSize(8192)
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                ->helperText('JPG/PNG/WebP. Препоръчително хоризонтална снимка.'),

            TextInput::make('caption')
                ->label('Надпис (2-3 думи)')
                ->maxLength(60)
                ->helperText('Показва се върху снимката. По избор.'),

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
                ImageColumn::make('image')
                    ->label('Снимка')
                    ->disk('public')
                    ->height(56),

                TextColumn::make('caption')
                    ->label('Надпис')
                    ->limit(40)
                    ->placeholder('—'),

                TextColumn::make('sort_order')
                    ->label('Ред')
                    ->sortable(),

                ToggleColumn::make('is_active')
                    ->label('Активна'),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGalleryImages::route('/'),
            'create' => CreateGalleryImage::route('/create'),
            'edit' => EditGalleryImage::route('/{record}/edit'),
        ];
    }
}
