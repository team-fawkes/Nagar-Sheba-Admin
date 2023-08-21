<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BillResource\Pages;
use App\Filament\Resources\BillResource\RelationManagers;
use App\Models\Bill;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BillResource extends Resource
{
    protected static ?string $model = Bill::class;
    protected static ?string $navigationGroup = 'Bill & Payment';
    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('bill_category_id')
                    ->relationship('bill_category', 'name_en')
                    ->required(),
                Forms\Components\TextInput::make('name_en')->label('Bill Name')->placeholder('Enter Bill Name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name_bn')->label('বিল নাম')->label(' বিল নাম লিখুন')
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
                Tables\Columns\TextColumn::make('bill_category.name_en'),
                Tables\Columns\TextColumn::make('name_en')->searchable()->sortable()->label('Name'),
                Tables\Columns\ImageColumn::make('icon'),
                Tables\Columns\ColorColumn::make('color'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('bill_category_id')->relationship('bill_category', 'name_en')
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
            'index' => Pages\ListBills::route('/'),
            'create' => Pages\CreateBill::route('/create'),
            'edit' => Pages\EditBill::route('/{record}/edit'),
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
