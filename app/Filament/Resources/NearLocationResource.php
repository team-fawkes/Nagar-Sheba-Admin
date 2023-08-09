<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NearLocationResource\Pages;
use App\Filament\Resources\NearLocationResource\RelationManagers;
use App\Models\NearLocation;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NearLocationResource extends Resource
{
    protected static ?string $model = NearLocation::class;
    protected static ?string $navigationGroup = 'Locations & Place';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-map';

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
                Forms\Components\Select::make('type')->options([
                    'bus'=>'Bus Station',
                    'hospital'=>'Hospital',
                    'thana'=>'Police Station',
                    'toilet'=>'Public Toilet',
                    'sts'=>'Secondary Transfer Station',
                    'graveyard'=>'Graveyard/কবরস্থান'])->required(),
                Forms\Components\RichEditor::make('details_en')->label('Details (English)')
                    ->maxLength(65535)->columnSpan(2)->placeholder('Enter details in english'),
                Forms\Components\RichEditor::make('details_bn')->label('বিস্তারিত (বাংলা)')
                    ->maxLength(65535)->columnSpan(2)->placeholder('বিস্তারিত লিখুন'),
                Forms\Components\TextInput::make('latitude'),
                Forms\Components\TextInput::make('longitude'),
                Forms\Components\FileUpload::make('thumbnail')->image(),
                Forms\Components\FileUpload::make('gallery')->image()->multiple(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_en'),
                Tables\Columns\TextColumn::make('name_bn'),
                Tables\Columns\ImageColumn::make('thumbnail'),
                Tables\Columns\BadgeColumn::make('type'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('type')->options([
                    'bus'=>'Bus Station',
                    'hospital'=>'Hospital',
                    'thana'=>'Police Station',
                    'toilet'=>'Public Toilet',
                    'sts'=>'Secondary Transfer Station',
                    'graveyard'=>'Graveyard/কবরস্থান']),
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
            'index' => Pages\ListNearLocations::route('/'),
            'create' => Pages\CreateNearLocation::route('/create'),
            'edit' => Pages\EditNearLocation::route('/{record}/edit'),
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
