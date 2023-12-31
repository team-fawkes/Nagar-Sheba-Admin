<?php

namespace App\Filament\Resources\ServiceCategoryResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ComplainsRelationManager extends RelationManager
{
    protected static string $relationship = 'complains';

    protected static ?string $recordTitleAttribute = 'title';

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
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
