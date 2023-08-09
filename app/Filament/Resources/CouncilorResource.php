<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CouncilorResource\Pages;
use App\Filament\Resources\CouncilorResource\RelationManagers;
use App\Models\Councilor;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CouncilorResource extends Resource
{
    protected static ?string $model = Councilor::class;
    protected static ?string $navigationGroup = 'Zone, Ward & Councilors';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationIcon = 'heroicon-o-folder';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('ward_id')->relationship('ward','name_en')
                    ->required(),
                Forms\Components\TextInput::make('name_en')->label('Councilor Name')
                    ->required()->placeholder('Enter councilor name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('name_bn')->label('কাউন্সিলরের নাম')
                    ->required()->placeholder('কাউন্সিলরের নাম লিখুন')
                    ->maxLength(255),
                Forms\Components\TextInput::make('title_en')->label('Councilor title')
                    ->required()->placeholder('Enter councilor title')
                    ->maxLength(255),
                Forms\Components\TextInput::make('title_bn')->label('কাউন্সিলর পদবি ')
                    ->required()->placeholder('কাউন্সিলর পদবি লিখুন')
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')->tel()->maxLength(255)->placeholder('Enter phone number'),
                Forms\Components\TextInput::make('parliament_members_en')->label('Members of Parliament')
                    ->maxLength(255)->placeholder('Write the names of the Members of Parliament'),
                Forms\Components\TextInput::make('parliament_members_bn')->label('সংসদ সদস্যদের নাম')
                    ->maxLength(255)->placeholder('সংসদ সদস্যদের নাম লেখ'),
                Forms\Components\RichEditor::make('details_en')->label('Details')->placeholder('Enter details')->columnSpan(2),
                Forms\Components\RichEditor::make('details_bn')->label('বিস্তারিত')->placeholder('বিস্তারিত লিখুন')->columnSpan(2),

                Forms\Components\FileUpload::make('image')->image(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('ward.name_en'),
                Tables\Columns\TextColumn::make('name_en')->label('Councilor Name'),
                Tables\Columns\TextColumn::make('title_en')->label('Councilor title'),
                Tables\Columns\TextColumn::make('phone'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('ward_id')->relationship('ward','name_en')
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
            'index' => Pages\ListCouncilors::route('/'),
            'create' => Pages\CreateCouncilor::route('/create'),
            'edit' => Pages\EditCouncilor::route('/{record}/edit'),
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
