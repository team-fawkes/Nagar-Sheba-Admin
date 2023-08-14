<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfficeResource\Pages;
use App\Filament\Resources\OfficeResource\RelationManagers;
use App\Models\Office;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OfficeResource extends Resource
{
    protected static ?string $model = Office::class;

    protected static ?string $navigationIcon = 'heroicon-o-office-building';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationGroup = 'DSCC';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name_en')->label('Office name')->placeholder('Enter office name')
                    ->required()->maxLength(255),
                Forms\Components\TextInput::make('name_bn')->label('অফিসের নাম')->placeholder('অফিসের নাম লিখুন')
                    ->required()->maxLength(255),
                Forms\Components\TextInput::make('address_en')->label('Office address')->placeholder('Enter office address')
                    ->maxLength(255),
                Forms\Components\TextInput::make('address_bn')->label('অফিসের ঠিকানা')->placeholder('অফিসের ঠিকানা লিখুন')
                    ->maxLength(255),
                Forms\Components\TextInput::make('latitude')->placeholder('Enter latitude'),
                Forms\Components\TextInput::make('longitude')->placeholder('Enter longitude'),
                Forms\Components\TextInput::make('phone')->placeholder('Enter phone number')
                    ->tel()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_en')->label('Office Name'),
                Tables\Columns\TextColumn::make('address_en')->label('Address'),
                Tables\Columns\TextColumn::make('phone')->searchable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOffices::route('/'),
            'create' => Pages\CreateOffice::route('/create'),
            'edit' => Pages\EditOffice::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
