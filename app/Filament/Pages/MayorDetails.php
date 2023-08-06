<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;

class MayorDetails extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.forms';

    protected function getBreadcrumbs(): array
    {
        return [
            url()->current() => 'App Settings',
        ];
    }
    public function mount()
    {
        $this->form->fill([
            'name' => '',

        ]);
    }

    public function submit()
    {
        $state = $this->form->getState();

        $this->notify('success', 'Settings has been updated.');
    }
    protected function getFormSchema(): array
    {
        return [
            Section::make('General')
                ->columns(2)
                ->schema([
                    TextInput::make('name')
                        ->required(),
                    TextInput::make('email')
                        ->label('Email Address')
                        ->required(),
                ]),

        ];
    }
}
