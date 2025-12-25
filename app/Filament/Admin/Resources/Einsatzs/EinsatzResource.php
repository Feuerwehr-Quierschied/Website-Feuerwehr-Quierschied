<?php

namespace App\Filament\Admin\Resources\Einsatzs;

use App\Filament\Admin\Resources\Einsatzs\Pages\CreateEinsatz;
use App\Filament\Admin\Resources\Einsatzs\Pages\EditEinsatz;
use App\Filament\Admin\Resources\Einsatzs\Pages\ListEinsatzs;
use App\Filament\Admin\Resources\Einsatzs\Schemas\EinsatzForm;
use App\Filament\Admin\Resources\Einsatzs\Tables\EinsatzsTable;
use App\Models\Einsatz;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EinsatzResource extends Resource
{
    protected static ?string $model = Einsatz::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Einsätze';

    protected static ?string $modelLabel = 'Einsatz';

    protected static ?string $pluralModelLabel = 'Einsätze';

    public static function form(Schema $schema): Schema
    {
        return EinsatzForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EinsatzsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEinsatzs::route('/'),
            'create' => CreateEinsatz::route('/create'),
            'edit' => EditEinsatz::route('/{record}/edit'),
        ];
    }
}
