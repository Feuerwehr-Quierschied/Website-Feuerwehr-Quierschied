<?php

namespace App\Filament\Admin\Resources\Einsatzs\Pages;

use App\Filament\Admin\Resources\Einsatzs\EinsatzResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEinsatz extends EditRecord
{
    protected static string $resource = EinsatzResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
