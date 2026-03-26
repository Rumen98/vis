<?php

namespace App\Filament\Admin\Resources\Articles\Schemas;

use App\Models\Solution;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ArticleForm
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
                    ->label('Slug')
                    ->helperText('Пример: kak-da-izberesh-kameri')
                    ->maxLength(255)
                    ->required(),

              Select::make('solution_id')
                ->label('Свързано решение')
                ->searchable()
                ->native(false)
                ->default('__general__')
                ->formatStateUsing(fn ($state) => $state ?? '__general__')
                ->dehydrateStateUsing(fn ($state) => $state === '__general__' ? null : $state)
                ->options(function (?object $record) {
                    $currentSolutionId = $record?->solution_id;
            
                    return ['__general__' => 'Обща статия'] + Solution::query()
                        ->where('is_active', true)
                        ->where(function ($query) use ($currentSolutionId) {
                            $query->whereDoesntHave('article');
            
                            if ($currentSolutionId) {
                                $query->orWhere('id', $currentSolutionId);
                            }
                        })
                        ->orderBy('title')
                        ->pluck('title', 'id')
                        ->all();
                })
                ->helperText('Едно решение може да има само една свързана статия. Избери „Обща статия“, ако не искаш връзка към решение.'),

                Textarea::make('excerpt')
                    ->label('Кратко описание')
                    ->rows(3)
                    ->columnSpanFull(),

                FileUpload::make('featured_image')
                    ->label('Основна снимка')
                    ->disk('public')
                    ->directory('articles')
                    ->image()
                    ->imageEditor()
                    ->maxSize(4096)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->helperText('JPG/PNG/WebP. Препоръчително: 1200x630 (16:9).'),

                RichEditor::make('content')
                    ->label('Съдържание')
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('articles/content')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'strike',
                        'bulletList',
                        'orderedList',
                        'h2',
                        'h3',
                        'blockquote',
                        'link',
                        'attachFiles',
                        'redo',
                        'undo',
                    ])
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->label('Публикувана')
                    ->default(true),

                Toggle::make('is_featured')
                    ->label('Избрана статия')
                    ->default(false),

                TextInput::make('sort_order')
                    ->label('Ред')
                    ->numeric()
                    ->default(0),
            ]);
    }
}