<?php

namespace App\Filament\Admin\Resources\Aktuelles\Pages;

use App\Filament\Admin\Resources\Aktuelles\AktuellesResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAktuelles extends EditRecord
{
    protected static string $resource = AktuellesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
