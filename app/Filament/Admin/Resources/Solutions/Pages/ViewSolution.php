<?php

namespace App\Filament\Admin\Resources\Solutions\Pages;

use App\Filament\Admin\Resources\Solutions\SolutionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSolution extends ViewRecord
{
    protected static string $resource = SolutionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
