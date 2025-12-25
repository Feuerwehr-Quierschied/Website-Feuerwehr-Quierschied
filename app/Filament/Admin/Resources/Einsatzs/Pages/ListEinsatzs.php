<?php

namespace App\Filament\Admin\Resources\Einsatzs\Pages;

use App\Filament\Admin\Resources\Einsatzs\EinsatzResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEinsatzs extends ListRecords
{
    protected static string $resource = EinsatzResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
