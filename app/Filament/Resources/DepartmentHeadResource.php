<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartmentHeadResource\Pages;
use App\Filament\Resources\DepartmentHeadResource\RelationManagers;
use App\Models\DepartmentHead;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DepartmentHeadResource extends Resource
{
    protected static ?string $model = DepartmentHead::class;

    protected static ?string $navigationIcon = 'heroicon-o-view-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name_en')->label('Department head name')->placeholder('Enter department head name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name_bn')->label('বিভাগীয় প্রধানের নাম')->placeholder('বিভাগীয় প্রধানের নাম লিখুন')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('title_en')->label('Department head title')->placeholder('Enter department head title')
                    ->maxLength(255),
                Forms\Components\TextInput::make('title_bn')->label('বিভাগীয় প্রধানের টাইটেল')->placeholder('বিভাগীয় প্রধানের টাইটেল  লিখুন')
                    ->maxLength(255),

                Forms\Components\TextInput::make('address_en')->label('Department head address')->placeholder('Enter department head address')
                    ->maxLength(255),
                Forms\Components\TextInput::make('address_bn')->label('বিভাগীয় প্রধানের ঠিকানা')->placeholder('বিভাগীয় প্রধানের ঠিকানা লিখুন')
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')->placeholder('Enter dept. head phone number')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')->placeholder('Select the image'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('name_en')->label('Name')->searchable(),
                Tables\Columns\TextColumn::make('title_en')->label('Title')->searchable(),
                Tables\Columns\TextColumn::make('phone')->label('Phone number')->searchable(),
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
            'index' => Pages\ListDepartmentHeads::route('/'),
            'create' => Pages\CreateDepartmentHead::route('/create'),
            'edit' => Pages\EditDepartmentHead::route('/{record}/edit'),
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
