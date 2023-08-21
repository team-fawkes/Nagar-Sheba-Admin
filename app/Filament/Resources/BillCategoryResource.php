<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BillCategoryResource\Pages;
use App\Filament\Resources\BillCategoryResource\RelationManagers;
use App\Models\BillCategory;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BillCategoryResource extends Resource
{
    protected static ?string $model = BillCategory::class;
    protected static ?string $navigationGroup = 'Bill & Payment';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name_en')->label('Bill Category Name')->placeholder('Enter Bill Category Name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name_bn')->label('বিল ক্যাটাগরি নাম')->label(' বিল ক্যাটাগরি নাম লিখুন')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('icon')->required()->image(),
                Forms\Components\ColorPicker::make('color')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_en')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('icon'),
                Tables\Columns\TextColumn::make('color'),

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
            'index' => Pages\ListBillCategories::route('/'),
            'create' => Pages\CreateBillCategory::route('/create'),
            'edit' => Pages\EditBillCategory::route('/{record}/edit'),
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
