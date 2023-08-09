<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComplainResource\Pages;
use App\Filament\Resources\ComplainResource\RelationManagers;
use App\Models\Complain;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ComplainResource extends Resource
{
    protected static ?string $model = Complain::class;
    protected static ?string $navigationGroup = 'Raise Issue';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-exclamation';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('service_category_id')
                    ->relationship('service_category', 'title_en')->required(),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')->required(),
                Forms\Components\TextInput::make('title')->required()->maxLength(255)->label('Problem Title')->columnSpan(2),
                Forms\Components\Textarea::make('description')->required()->maxLength(65535)->columnSpan(2)->label('Problem Details'),
                Forms\Components\TextInput::make('latitude'),
                Forms\Components\TextInput::make('longitude'),
                Forms\Components\FileUpload::make('picture')->image(),
                Forms\Components\FileUpload::make('voice'),
                Forms\Components\FileUpload::make('video'),
                Forms\Components\FileUpload::make('gallery')->image(),
                Forms\Components\Select::make('status')
                    ->required()->options(['pending'=>'Pending','received'=>'Received','progress'=>'In Progress','solved','Solved']),
                Forms\Components\DateTimePicker::make('received_at')->placeholder('Select Date and Time'),
                Forms\Components\DateTimePicker::make('solved_at')->placeholder('Select Date and Time'),
                Forms\Components\DateTimePicker::make('observed_at')->placeholder('Select Date and Time'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('complain_id'),
                Tables\Columns\TextColumn::make('service_category.title_en'),
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),

            ])->defaultSort('id','desc')
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
            RelationManagers\FilesRelationManager::class,
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComplains::route('/'),
            'create' => Pages\CreateComplain::route('/create'),
            'edit' => Pages\EditComplain::route('/{record}/edit'),
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
