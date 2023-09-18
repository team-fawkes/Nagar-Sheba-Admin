<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChatRoomResource\Pages;
use App\Filament\Resources\ChatRoomResource\RelationManagers;
use App\Models\ChatRoom;
use App\Models\Complain;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ChatRoomResource extends Resource
{
    protected static ?string $model = ChatRoom::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('status')
                    ->required()->options(['open'=>'Open','closed'=>'Closed']),
                Forms\Components\DatePicker::make('created_at')->visibleOn('view')
                    ->format('d M y h:i A'),
                Forms\Components\DatePicker::make('updated_at')->visibleOn('view')
                    ->format('d M y h:i A'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('complain.complain_id')->searchable(),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\BadgeColumn::make('status'),
                Tables\Columns\TextColumn::make('chat_messages_count')->counts('chat_messages')->label('Msg Count')
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('chat')
                    ->label('Chat')
                    ->url(fn (ChatRoom $record): string => route('admin_chat', $record)),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListChatRooms::route('/'),
            'create' => Pages\CreateChatRoom::route('/create'),
            'edit' => Pages\EditChatRoom::route('/{record}/edit'),
        ];
    }
}
