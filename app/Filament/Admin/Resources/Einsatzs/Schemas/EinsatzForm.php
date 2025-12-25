<?php

namespace App\Filament\Admin\Resources\Einsatzs\Schemas;

use App\Models\Einsatz;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class EinsatzForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Titel')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (string $operation, $state, callable $set) {
                        if ($operation !== 'create') {
                            return;
                        }

                        $set('slug', Str::slug($state));
                    }),
                
                TextInput::make('einsatznummer')
                    ->label('Einsatznummer')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->alphaDash(),

                Textarea::make('description')
                    ->label('Beschreibung')
                    ->rows(3)
                    ->maxLength(500)
                    ->columnSpanFull(),

                RichEditor::make('body')
                    ->label('Inhalt')
                    ->required()
                    ->columnSpanFull(),

                TagsInput::make('im_einsatz_waren')
                    ->label('Im Einsatz waren:')
                    ->suggestions(function () {
                        return Einsatz::query()
                            ->whereNotNull('im_einsatz_waren')
                            ->get()
                            ->pluck('im_einsatz_waren')
                            ->flatten()
                            ->unique()
                            ->values()
                            ->toArray();
                    })
                    ->columnSpanFull(),

                DateTimePicker::make('timestamp')
                    ->label('Alarmzeit')
                    ->displayFormat('d.m.Y H:i')
                    ->seconds(false),
            ]);
    }
}
