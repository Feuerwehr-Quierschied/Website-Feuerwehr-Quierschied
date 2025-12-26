<?php

namespace App\Filament\Admin\Resources\Aktuelles\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class AktuellesForm
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
                    ->afterStateUpdated(function (string $operation, $state, callable $get, callable $set) {
                        if ($operation !== 'create') {
                            return;
                        }

                        $slug = Str::slug($state);
                        if ($slug) {
                            $set('slug', $slug);
                        }
                    }),

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

                FileUpload::make('image')
                    ->label('Bild')
                    ->image()
                    ->disk('public')
                    ->directory('aktuelles')
                    ->maxSize(5120)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif'])
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->visibility('public')
                    ->columnSpanFull(),

                DateTimePicker::make('published_at')
                    ->label('Veröffentlicht am')
                    ->displayFormat('d.m.Y H:i')
                    ->seconds(false),
            ]);
    }
}
