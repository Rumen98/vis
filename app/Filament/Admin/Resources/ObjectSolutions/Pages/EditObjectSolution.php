<?php

namespace App\Filament\Admin\Resources\ObjectSolutions\Pages;

use App\Filament\Admin\Resources\ObjectSolutions\ObjectSolutionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditObjectSolution extends EditRecord
{
    protected static string $resource = ObjectSolutionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
