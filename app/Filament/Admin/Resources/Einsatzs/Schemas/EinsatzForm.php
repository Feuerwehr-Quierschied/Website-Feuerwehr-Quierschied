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
                    ->afterStateUpdated(function (string $operation, $state, callable $get, callable $set) {
                        if ($operation !== 'create') {
                            return;
                        }

                        $slug = self::generateSlug($get('einsatznummer'), $state);
                        if ($slug) {
                            $set('slug', $slug);
                        }
                    }),

                TextInput::make('einsatznummer')
                    ->label('Einsatznummer')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (string $operation, $state, callable $get, callable $set) {
                        if ($operation !== 'create') {
                            return;
                        }

                        $slug = self::generateSlug($state, $get('title'));
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

    /**
     * Generate slug from einsatznummer and title.
     * Format: {part1-einsatznummer}-{part2-einsatznummer}-{title-slug}
     */
    private static function generateSlug(?string $einsatznummer, ?string $title): ?string
    {
        if (empty($einsatznummer) || empty($title)) {
            return null;
        }

        // Split einsatznummer by "/" (e.g., "123/2025" -> ["123", "2025"])
        $parts = explode('/', $einsatznummer, 2);
        $part1 = trim($parts[0] ?? '');
        $part2 = trim($parts[1] ?? '');

        if (empty($part1) || empty($part2)) {
            return null;
        }

        // Generate slug from title
        $titleSlug = Str::slug($title);

        // Combine: {part1}-{part2}-{title-slug}
        return "{$part1}-{$part2}-{$titleSlug}";
    }
}
