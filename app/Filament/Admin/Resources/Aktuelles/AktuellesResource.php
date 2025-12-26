<?php

namespace App\Filament\Admin\Resources\Aktuelles;

use App\Filament\Admin\Resources\Aktuelles\Pages\CreateAktuelles;
use App\Filament\Admin\Resources\Aktuelles\Pages\EditAktuelles;
use App\Filament\Admin\Resources\Aktuelles\Pages\ListAktuelles;
use App\Filament\Admin\Resources\Aktuelles\Schemas\AktuellesForm;
use App\Filament\Admin\Resources\Aktuelles\Tables\AktuellesTable;
use App\Models\Aktuelles;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AktuellesResource extends Resource
{
    protected static ?string $model = Aktuelles::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedNewspaper;

    protected static ?string $navigationLabel = 'Aktuelles';

    protected static ?string $modelLabel = 'Aktuelles';

    protected static ?string $pluralModelLabel = 'Aktuelles';

    public static function form(Schema $schema): Schema
    {
        return AktuellesForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AktuellesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAktuelles::route('/'),
            'create' => CreateAktuelles::route('/create'),
            'edit' => EditAktuelles::route('/{record}/edit'),
        ];
    }
}
