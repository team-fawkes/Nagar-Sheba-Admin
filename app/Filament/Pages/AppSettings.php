<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;

class AppSettings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';

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
            'sms_provider' => getSetting('sms_provider'),
            'sms_balance' => getSmsBalance(),
            'bulk_sms_bd_api' => getSetting('bulk_sms_bd_api'),
            'bulk_sms_bd_sender_id' => getSetting('bulk_sms_bd_sender_id'),

        ]);
    }

    public function submit()
    {
        $state = $this->form->getState();
        setSetting('sms_provider',$this->sms_provider);
        setSetting('bulk_sms_bd_api',$this->bulk_sms_bd_api);
        setSetting('bulk_sms_bd_sender_id',$this->bulk_sms_bd_sender_id);

        $this->notify('success', 'Settings has been updated.');
        $this->mount();
    }
    protected function getFormSchema(): array
    {
        return [
            Section::make('SMS Settings')
                ->columns(2)
                ->schema([
                    Select::make('sms_provider')->options(['bulk_sms_bd'=>'Bulk SMS BD']),
                    TextInput::make('sms_balance')->disabled()->label('SMS Balance'),
                    TextInput::make('bulk_sms_bd_api')->placeholder('Enter Bulk SMS BD API Key')->label('Bulk SMS API')->password(),
                    TextInput::make('bulk_sms_bd_sender_id')->placeholder('Enter Bulk SMS Sender ID')->label('Bulk SMS Sender ID'),

                ]),

        ];
    }
}
