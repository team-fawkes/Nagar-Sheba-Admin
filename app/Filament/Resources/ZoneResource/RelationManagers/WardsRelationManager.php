<?php

namespace App\Filament\Resources\ZoneResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WardsRelationManager extends RelationManager
{
    protected static string $relationship = 'wards';

    protected static ?string $recordTitleAttribute = 'name_en';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name_en')->label('Ward name')
                    ->required()->placeholder('Enter ward name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('name_bn')->label('ওয়ার্ডের নাম')
                    ->required()->placeholder('ওয়ার্ডের নাম লিখুন')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_en')->label('Ward name'),
                Tables\Columns\TextColumn::make('name_bn')->label('ওয়ার্ডের নাম'),
                Tables\Columns\TextColumn::make('councilors_count')->counts('councilors')->label('Total Councilor'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
