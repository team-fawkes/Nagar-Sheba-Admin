<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;
    protected $fillable = [
        'chat_room_id',
        'sender_id',
        'sender',
        'message',
    ];

    public function chat_room(){
        return $this->belongsTo(ChatRoom::class);
    }
}
