<?php

namespace App\Filament\Admin\Resources\Aktuelles\Pages;

use App\Filament\Admin\Resources\Aktuelles\AktuellesResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAktuelles extends ListRecords
{
    protected static string $resource = AktuellesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
