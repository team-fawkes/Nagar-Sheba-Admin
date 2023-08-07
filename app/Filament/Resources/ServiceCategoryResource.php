<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceCategoryResource\Pages;
use App\Filament\Resources\ServiceCategoryResource\RelationManagers;
use App\Models\ServiceCategory;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceCategoryResource extends Resource
{
    protected static ?string $model = ServiceCategory::class;
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title_en')
                    ->label('Title (English)')
                    ->placeholder('Enter title in English')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('title_bn')
                    ->label('টাইটেল (বাংলা)')
                    ->placeholder('Enter title in (বাংলা)')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('order')
                    ->label('Serial')
                    ->placeholder('Enter Serial')
                    ->required()->integer(),
                Forms\Components\ColorPicker::make('color')->required()->placeholder('Select Color'),
                Forms\Components\FileUpload::make('icon')->required()->maxSize(512),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title_en'),
                Tables\Columns\TextColumn::make('title_bn'),
                Tables\Columns\ImageColumn::make('icon'),
                Tables\Columns\ColorColumn::make('color'),
                Tables\Columns\TextColumn::make('order'),
                Tables\Columns\TextColumn::make('complains_count')->counts('complains'),
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
            RelationManagers\ComplainsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServiceCategories::route('/'),
            'create' => Pages\CreateServiceCategory::route('/create'),
            'edit' => Pages\EditServiceCategory::route('/{record}/edit'),
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
