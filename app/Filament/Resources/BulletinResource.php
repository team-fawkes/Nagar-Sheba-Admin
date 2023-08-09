<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BulletinResource\Pages;
use App\Filament\Resources\BulletinResource\RelationManagers;
use App\Models\Bulletin;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BulletinResource extends Resource
{
    protected static ?string $model = Bulletin::class;
    protected static ?string $navigationGroup = 'Alert & Notice';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-lightning-bolt';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('headline_bn')->label('Headline')
                    ->required()->placeholder('Enter headline')
                    ->maxLength(255),
                Forms\Components\TextInput::make('headline_en')->label('শিরোনাম')
                    ->required()->placeholder('শিরোনাম লিখুন')
                    ->maxLength(255),
                Forms\Components\TextInput::make('order')->numeric()->default(1)
                    ->required(),
                Forms\Components\TextInput::make('url')
                    ->maxLength(255),
                Forms\Components\Toggle::make('status')->default(true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('headline_bn')->label('Headline'),
                Tables\Columns\TextColumn::make('headline_en')->label('শিরোনাম'),
                Tables\Columns\TextColumn::make('order'),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
            ])->defaultSort('order','asc')
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
            'index' => Pages\ListBulletins::route('/'),
            'create' => Pages\CreateBulletin::route('/create'),
            'edit' => Pages\EditBulletin::route('/{record}/edit'),
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
