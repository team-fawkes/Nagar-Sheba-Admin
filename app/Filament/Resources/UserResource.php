<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required()->placeholder('Enter Full Name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')->placeholder('Enter valid phone number')
                    ->tel()->required()->maxLength(255),
                TextInput::make('password')->placeholder('Enter strong password')->password()->maxLength(255)
                    ->dehydrateStateUsing(static function ($state) use ($form) {
                        return !empty($state) ? Hash::make($state) : null;
                        $user = User::find($form->getColumns());
                        return $user ? $user->password : null;
                    })->visibleOn('edit'),
                TextInput::make('password')->placeholder('Enter strong password')->password()->maxLength(255)
                    ->dehydrateStateUsing(static function ($state) use ($form) {
                        return !empty($state) ? Hash::make($state) : null;
                        $user = User::find($form->getColumns());
                        return $user ? $user->password : null;
                    })->visibleOn('create')->required(),
                Forms\Components\Select::make('language')->options(['en'=>'English','bn'=>'Bangla'])->required(),
                Forms\Components\TextInput::make('latitude')->maxLength(255)->placeholder('Enter latitude'),
                Forms\Components\TextInput::make('longitude')->maxLength(255)->placeholder('Enter longitude'),
                Forms\Components\Select::make('sound')->required()->options(['yes'=>'Yes','no'=>'No']),
                Forms\Components\Select::make('notification')->required()->options(['yes'=>'Yes','no'=>'No']),
                Forms\Components\Toggle::make('status')
                    ->required(),

            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\IconColumn::make('status')->boolean(),

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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
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
