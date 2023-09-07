<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',
        'status',
    ];

    public function complain(){
        return $this->hasOne(Complain::class,'chat_room_id');
    }
    public function chat_messages()
    {
        return $this->hasMany(ChatMessage::class,'chat_room_id');
    }
}
