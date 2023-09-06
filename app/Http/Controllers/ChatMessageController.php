<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatMessageController extends Controller
{
    public function store(Request $request)
    {
        // Store a new chat message
        ChatMessage::create([
            'user_id' => auth()->user()->id, // Assuming you have user authentication
            'chat_room_id' => $request->input('chat_room_id'),
            'message' => $request->input('message'),
        ]);

        return back()->with('success', 'Message sent successfully.');
    }
    public function getMessagesForChatRoom($chatRoomId)
    {
        // Retrieve messages for the specified chat room
        $messages = ChatMessage::where('chat_room_id', $chatRoomId)->orderBy('created_at', 'asc')->get();

        // You can return the messages in a JSON response or render a view here
        return response()->json(['messages' => $messages]);
    }
}
