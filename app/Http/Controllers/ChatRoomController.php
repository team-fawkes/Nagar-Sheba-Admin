<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\ChatMessage;
use App\Models\ChatRoom;
use App\Models\Complain;
use App\Models\User;
use Illuminate\Http\Request;

class ChatRoomController extends Controller
{
    public function admin_chat($record){
        $complain =  Complain::find($record);
        if ($complain->chat_room){
            return redirect(route('admin_chat',['chat_room_id'=>$complain->chat_room->id]));
        }else{
            $room = new ChatRoom([
                'name'=>$complain->title,
                'status'=>'open',
            ]);

            $room->save();
            $message = 'Titile : '.$complain->titile.'<br>';
            $message = $message.'Category : '.$complain->service_category->title_en.'('.$complain->service_category->title_en.')<br>';
            $message = $message.'Description : '.$complain->description.'<br>';
            $message = $message.'<img src="'.asset('uploads/'.$complain->picture).'" class="img-fluid msg-img">';
            ChatMessage::create([
                'chat_room_id' => $room->id,
                'sender_id' => $complain->user_id,
                'sender' => 'user',
                'message' => $message,
            ]);
            return redirect(route('admin_chat',['record'=>$room->id]));
        }

    }
    public function inbox($user_id,$chat_room_id){
        $user  = User::find($user_id);
        $chat_room = ChatRoom::find($chat_room_id);
        if ($user && $chat_room){
            return view('chat_rooms.user_inbox',compact('chat_room','user_id'));
        }else{
            return 'Something went wrong';
        }


    }
    public function admin_inbox($record){
        $chat_room = ChatRoom::find($record);
        return view('chat_rooms.admin_inbox',compact('chat_room'));
    }
    public function send_message(Request $request){
        // Get the message data from the AJAX request
        $message = $request->input('message');
        $sender_id = $request->input('sender_id');
        $sender = $request->input('sender');
        $chat_room_id = $request->input('chat_room_id');

        ChatMessage::create([
            'chat_room_id' => $chat_room_id,
            'sender_id' => $sender_id,
            'sender' => $sender,
            'message' => $message,
        ]);

        // Perform any processing you need here
        // For example, you can save the message to a database

        // Return a response to the AJAX request
        return response()->json(['success' => true, 'message' => 'Message sent successfully']);
    }
    public function get_messages($id)
    {
        // Fetch messages from the database
        $chat_room = ChatRoom::find($id);
        $messages = $chat_room->chat_messages;

        $messageData = [];

        foreach ($messages as $message) {
            $messageInfo = [];

            // Determine if the sender is a user or an admin
            if ($message->sender == 'user') {
                $sender = User::find($message->sender_id);
                $messageInfo['sender'] = 'user';
                $messageInfo['name'] = $sender->name; // Change this to the actual user name field
            } else {
                $sender = Admin::find($message->sender_id);
                $messageInfo['sender'] = 'admin';
                $messageInfo['name'] = $sender->name; // Change this to the actual admin name field
            }

            $messageInfo['message'] = $message->message;
            $messageInfo['time'] = $message->created_at->format('d M y H:i A');
            $messageData[] = $messageInfo;
        }

        return response()->json(['messages' => $messageData]);
    }



}
