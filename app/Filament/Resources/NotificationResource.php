<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NotificationResource\Pages;
use App\Filament\Resources\NotificationResource\RelationManagers;
use App\Models\Notification;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NotificationResource extends Resource
{
    protected static ?string $model = Notification::class;
    protected static ?string $navigationGroup = 'Alert & Notice';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-bell';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title_en')->label('Title')
                    ->required()->placeholder('Enter title')
                    ->maxLength(255),
                Forms\Components\TextInput::make('title_bn')->label('শিরোনাম')
                    ->required()->placeholder('শিরোনাম লিখুন')
                    ->maxLength(255),
                Forms\Components\Textarea::make('details_en')->label('Details')
                    ->required()->placeholder('Enter details')
                    ->maxLength(255),
                Forms\Components\Textarea::make('details_bn')->label('বিস্তারিত')
                    ->required()->placeholder('বিস্তারিত লিখুন')
                    ->maxLength(255),
                Forms\Components\TextInput::make('url')->url()
                    ->maxLength(255)->placeholder('Enter url'),
                Forms\Components\TextInput::make('order')->numeric()->default(1)->required(),
                Forms\Components\FileUpload::make('icon')->image()->maxSize(512),
                Forms\Components\Toggle::make('status')->default(true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('title_en')->label('Title'),
                Tables\Columns\TextColumn::make('title_bn')->label('শিরোনাম'),
                Tables\Columns\TextColumn::make('order'),
                Tables\Columns\IconColumn::make('status')->boolean(),
            ])->defaultSort('order','asc')
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('status')->options([true => 'Published', false => 'In Active'])
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
            'index' => Pages\ListNotifications::route('/'),
            'create' => Pages\CreateNotification::route('/create'),
            'edit' => Pages\EditNotification::route('/{record}/edit'),
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
