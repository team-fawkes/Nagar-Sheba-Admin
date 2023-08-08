<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SpectacularPlaceResource\Pages;
use App\Filament\Resources\SpectacularPlaceResource\RelationManagers;
use App\Models\SpectacularPlace;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SpectacularPlaceResource extends Resource
{
    protected static ?string $model = SpectacularPlace::class;

    protected static ?string $navigationIcon = 'heroicon-o-location-marker';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name_en')->label('Name (english)')
                    ->required()->placeholder('Enter name in english')
                    ->maxLength(255),
                Forms\Components\TextInput::make('name_bn')->label('স্থানের নাম')
                    ->required()->placeholder('স্থানের নাম লিখুন')
                    ->maxLength(255),
                Forms\Components\RichEditor::make('details_en')->label('Details (English)')
                    ->maxLength(65535)->placeholder('Enter details in english'),
                Forms\Components\RichEditor::make('details_bn')->label('বিস্তারিত (বাংলা)')
                    ->maxLength(65535)->placeholder('বিস্তারিত লিখুন'),
                Forms\Components\TextInput::make('latitude'),
                Forms\Components\TextInput::make('longitude'),
                Forms\Components\FileUpload::make('thumbnail')->image(),
                Forms\Components\FileUpload::make('gallery')->image()->multiple(),
                Forms\Components\DatePicker::make('established_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_en'),
                Tables\Columns\TextColumn::make('name_bn'),
                Tables\Columns\ImageColumn::make('thumbnail'),
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
            'index' => Pages\ListSpectacularPlaces::route('/'),
            'create' => Pages\CreateSpectacularPlace::route('/create'),
            'edit' => Pages\EditSpectacularPlace::route('/{record}/edit'),
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
