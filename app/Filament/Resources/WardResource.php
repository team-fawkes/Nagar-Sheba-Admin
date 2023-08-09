<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WardResource\Pages;
use App\Filament\Resources\WardResource\RelationManagers;
use App\Models\Ward;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WardResource extends Resource
{
    protected static ?string $model = Ward::class;
    protected static ?string $navigationGroup = 'Zone, Ward & Councilors';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-s-folder-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('zone_id')->relationship('zone','name_en')
                    ->required(),
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
                Tables\Columns\TextColumn::make('zone.name_en')->label('Zone name'),
                Tables\Columns\TextColumn::make('zone.name_bn')->label('জোনের নাম'),
                Tables\Columns\TextColumn::make('name_en')->label('Ward name'),
                Tables\Columns\TextColumn::make('name_bn')->label('ওয়ার্ডের নাম'),
                Tables\Columns\TextColumn::make('councilors_count')->counts('councilors')->label('Total Councilor'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('zone_id')->relationship('zone','name_en')
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
            RelationManagers\CouncilorsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWards::route('/'),
            'create' => Pages\CreateWard::route('/create'),
            'edit' => Pages\EditWard::route('/{record}/edit'),
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
