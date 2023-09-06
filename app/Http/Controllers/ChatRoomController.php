<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use Illuminate\Http\Request;

class ChatRoomController extends Controller
{
    public function index()
    {
        // Retrieve a list of chat rooms
        $chatRooms = ChatRoom::all();
        return view('chat_rooms.index', compact('chatRooms'));
    }

    public function create()
    {
        // Show a form to create a new chat room
        return view('chat_rooms.create');
    }

    public function store(Request $request)
    {
        // Store a new chat room
        ChatRoom::create([
            'name' => $request->input('name'),
        ]);

        return redirect('/chat/rooms')->with('success', 'Chat room created successfully.');
    }

    public function show(ChatRoom $chatRoom)
    {
        // Show messages for a specific chat room
        $messages = $chatRoom->messages()->orderBy('created_at', 'desc')->get();
        return view('chat_rooms.show', compact('chatRoom', 'messages'));
    }
}
