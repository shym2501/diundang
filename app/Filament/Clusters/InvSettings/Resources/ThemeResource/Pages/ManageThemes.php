<?php

namespace App\Filament\Clusters\InvSettings\Resources\ThemeResource\Pages;

use App\Filament\Clusters\InvSettings\Resources\ThemeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageThemes extends ManageRecords
{
    protected static string $resource = ThemeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
