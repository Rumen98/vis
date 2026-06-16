<?php

namespace App\Filament\Admin\Resources\ObjectSolutions\Pages;

use App\Filament\Admin\Resources\ObjectSolutions\ObjectSolutionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListObjectSolutions extends ListRecords
{
    protected static string $resource = ObjectSolutionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
