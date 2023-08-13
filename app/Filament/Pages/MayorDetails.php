<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
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
            'mayor_name_image' => getSetting('mayor_name_image'),
            'mayor_name_en' => getSetting('mayor_name_en'),
            'mayor_name_bn' => getSetting('mayor_name_bn'),
            'mayor_details_en' => getSettingDetails('mayor_details_en'),
            'mayor_details_bn' => getSettingDetails('mayor_details_bn'),

            'ceo_name_image' => getSetting('ceo_name_image'),
            'ceo_name_en' => getSetting('ceo_name_en'),
            'ceo_name_bn' => getSetting('ceo_name_bn'),
            'ceo_details_en' => getSettingDetails('ceo_details_en'),
            'ceo_details_bn' => getSettingDetails('ceo_details_bn'),

        ]);
    }

    public function submit()
    {
        $state = $this->form->getState();

        setSetting('mayor_name_image',$state['mayor_name_image']);
        setSetting('mayor_name_en',$this->mayor_name_en);
        setSetting('mayor_name_bn',$this->mayor_name_bn);
        setSettingDetails('mayor_details_en',$this->mayor_details_en);
        setSettingDetails('mayor_details_bn',$this->mayor_details_bn);

        setSetting('ceo_name_image',$state['ceo_name_image']);
        setSetting('ceo_name_en',$this->ceo_name_en);
        setSetting('ceo_name_en',$this->ceo_name_en);
        setSettingDetails('ceo_details_en',$this->ceo_details_en);
        setSettingDetails('ceo_details_bn',$this->ceo_details_bn);

        $this->notify('success', 'Settings has been updated.');
    }
    protected function getFormSchema(): array
    {
        return [
            Section::make('Mayor Details')
                ->columns(2)
                ->schema([
                    TextInput::make('mayor_name_en')->label('Mayor name')->placeholder('Enter mayor name'),
                    TextInput::make('mayor_name_bn')->label('মেয়রের নাম')->placeholder('মেয়রের নাম লিখুন'),
                    Textarea::make('mayor_details_en')->label('Mayor details')->placeholder('Enter mayor details'),
                    Textarea::make('mayor_details_bn')->label('মেয়রের বিস্তারিত')->placeholder('মেয়রের বিবরণ লিখুন'),
                    FileUpload::make('mayor_name_image')->label('Mayor Image'),
                ]),
            Section::make('CEO Details')
                ->columns(2)
                ->schema([
                    TextInput::make('ceo_name_en')->label('CEO name')->placeholder('Enter ceo name'),
                    TextInput::make('ceo_name_bn')->label('সিইও নাম')->placeholder('সিইও নাম লিখুন'),
                    Textarea::make('ceo_details_en')->label('CEO details')->placeholder('Enter ceo details'),
                    Textarea::make('ceo_details_bn')->label('সিইও বিস্তারিত')->placeholder('সিইও বিবরণ লিখুন'),
                    FileUpload::make('ceo_name_image')->label('CEO Image'),
                ]),

        ];
    }
}
