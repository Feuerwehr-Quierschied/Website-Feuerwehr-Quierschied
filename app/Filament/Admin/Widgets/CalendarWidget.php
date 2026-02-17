<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Event;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Model;
use Saade\FilamentFullCalendar\Actions;
use Saade\FilamentFullCalendar\Data\EventData;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class CalendarWidget extends FullCalendarWidget
{
    public Model|string|null $model = Event::class;

    protected function headerActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->mountUsing(function ($form, $arguments) {
                    if (isset($arguments['start'], $arguments['end'])) {
                        $form->fill([
                            'start' => $arguments['start'],
                            'end' => $arguments['end'],
                            'all_day' => $arguments['allDay'] ?? false,
                        ]);
                    }
                }),
        ];
    }

    protected function modalActions(): array
    {
        return [
            Actions\EditAction::make()
                ->mountUsing(function (Event $record, $form, $arguments) {
                    $form->fill([
                        'title' => $record->title,
                        'start' => $arguments['event']['start'] ?? $record->start,
                        'end' => $arguments['event']['end'] ?? $record->end,
                        'all_day' => $record->all_day,
                        'description' => $record->description,
                    ]);
                }),
            Actions\DeleteAction::make(),
        ];
    }

    public function fetchEvents(array $fetchInfo): array
    {
        return Event::query()
            ->where('start', '<', $fetchInfo['end'])
            ->where(function ($query) use ($fetchInfo) {
                $query->where('end', '>', $fetchInfo['start'])
                    ->orWhereNull('end');
            })
            ->get()
            ->map(fn (Event $event) => EventData::make()
                ->id($event->id)
                ->title($event->title)
                ->start($event->start)
                ->end($event->end)
                ->allDay($event->all_day)
            )
            ->toArray();
    }

    public function getFormSchema(): array
    {
        return [
            TextInput::make('title')
                ->label('Titel')
                ->required()
                ->maxLength(255),

            Toggle::make('all_day')
                ->label('Ganztägig')
                ->default(false),

            DateTimePicker::make('start')
                ->label('Start')
                ->required()
                ->seconds(false)
                ->native(false),

            DateTimePicker::make('end')
                ->label('Ende')
                ->seconds(false)
                ->native(false)
                ->visible(fn ($get) => ! $get('all_day')),

            Textarea::make('description')
                ->label('Beschreibung')
                ->rows(3)
                ->columnSpanFull(),
        ];
    }
}
