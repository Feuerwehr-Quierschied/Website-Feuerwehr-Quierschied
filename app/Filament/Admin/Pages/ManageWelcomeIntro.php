<?php

namespace App\Filament\Admin\Pages;

use App\Models\WelcomeIntro;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

/**
 * @property-read Schema $form
 */
class ManageWelcomeIntro extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;

    protected static ?string $navigationLabel = 'Startseite-Intro';

    protected static ?string $title = 'Willkommensblock bearbeiten';

    protected static ?string $slug = 'willkommensblock';

    /**
     * @var array<string, mixed>|null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $record = $this->getRecord();
        $this->form->fill($record?->attributesToArray() ?? []);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\TextInput::make('title')
                    ->label('Titel')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('z.B. Willkommen bei der Freiwilligen Feuerwehr Quierschied'),


                \Filament\Forms\Components\Textarea::make('body')
                    ->label('Einführungstext')
                    ->required()
                    ->rows(6)
                    ->columnSpanFull(),
            ]);
    }

    public function defaultForm(Schema $schema): Schema
    {
        return $schema
            ->operation('edit')
            ->record($this->getRecord())
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $record = $this->getRecord();

        if (! $record) {
            $record = new WelcomeIntro;
        }

        $record->fill($data);
        $record->save();

        Notification::make()
            ->success()
            ->title('Willkommensblock gespeichert')
            ->send();
    }

    public function getRecord(): ?WelcomeIntro
    {
        return WelcomeIntro::query()->first();
    }

    public function getFormContentComponent(): \Filament\Schemas\Components\Component
    {
        return Form::make([EmbeddedSchema::make('form')])
            ->id('form')
            ->livewireSubmitHandler('save')
            ->footer([
                Actions::make([
                    Action::make('save')
                        ->label('Speichern')
                        ->submit('save')
                        ->keyBindings(['mod+s']),
                ])
                    ->alignment(\Filament\Support\Enums\Alignment::Start)
                    ->key('form-actions'),
            ]);
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getFormContentComponent(),
            ]);
    }
}
