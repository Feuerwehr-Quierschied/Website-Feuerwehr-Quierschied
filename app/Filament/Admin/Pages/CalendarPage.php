<?php

namespace App\Filament\Admin\Pages;

use App\Filament\Admin\Widgets\CalendarWidget;
use BackedEnum;
use Filament\Panel;
use Filament\Pages\Dashboard;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\Widget;

class CalendarPage extends Dashboard
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendar;

    protected static ?string $navigationLabel = 'Kalender';

    protected static ?string $title = 'Kalender';

    protected static ?string $slug = 'calendar';

    public static function getRoutePath(Panel $panel): string
    {
        return '/calendar';
    }

    /**
     * @return array<class-string<Widget> | \Filament\Widgets\WidgetConfiguration>
     */
    public function getWidgets(): array
    {
        return [
            CalendarWidget::class,
        ];
    }

    public function getColumns(): int|array
    {
        return 1;
    }
}
