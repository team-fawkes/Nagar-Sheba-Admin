<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use App\Models\ChatRoom;
use App\Models\Complain;
use App\Models\ServiceCategory;
use App\Models\User;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function service_category(){
        if ($this->guard()->user()){
            $user = User::find($this->guard()->user()->id);
            $language = $user->language;
            if ($language == "bn"){
                $categories = ServiceCategory::orderBy('order','asc')->select('id','title_bn as title', 'icon', 'color')->get();
            }else{
                $categories = ServiceCategory::orderBy('order','asc')->select('id','title_en as title', 'icon', 'color')->get();
            }

            return response()->json([
                'category' => $categories,
                'status' => true,
            ], 200);
        }
        return response()->json([
            'status' => false,
            'error' => 'Unauthorized'
        ], 401);
    }
    public function complain_counter(){
        if ($this->guard()->user()){
            $pending = Complain::where('status','pending')->count();
            $received = Complain::where('status','received')->count();
            $progress = Complain::where('status','progress')->count();
            $solved = Complain::where('status','solved')->count();
            $total = Complain::where('status','total')->count();

            $user = User::find($this->guard()->user()->id);
            $language = $user->language;
            if ($language == "bn"){
                return response()->json([
                    'pending' => englishToBengaliNumber($pending),
                    'received' => englishToBengaliNumber($received),
                    'progress' => englishToBengaliNumber($progress),
                    'solved' => englishToBengaliNumber($solved),
                    'total' => englishToBengaliNumber($total),
                    'status' => true,
                ], 200);
            }else{
                return response()->json([
                    'pending' => $pending,
                    'received' => $received,
                    'progress' => $progress,
                    'solved' => $solved,
                    'total' => $total,
                    'status' => true,
                ], 200);
            }


        }
        return response()->json([
            'status' => false,
            'error' => 'Unauthorized'
        ], 401);
    }
    public function complain_create(Request $request){

        if ($this->guard()->user()){
            $validator = Validator::make($request->all(), [
                'service_category_id' => 'required|integer',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'picture' => 'nullable|file|mimes:jpeg,png,jpg|max:2048', // Max 2MB for picture
                'voice' => 'nullable|file|mimes:audio/mpeg,mpga,wav|max:5000', // Max 5MB for voice
                'video' => 'nullable|file|mimes:mp4,avi,mov,3gp|max:10000', // Max 10MB for video
                'gallery' => 'nullable|array', // Assuming you want an array of files for the gallery

            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors(),
                    'status' => false,
                ], 422);
            }
            $chat_room = new ChatRoom([
                'name'=>$request->input('title'),
            ]);
            $chat_room->save();
            $complain = new Complain([
                'service_category_id' => intval($request->input('service_category_id')) ,
                'user_id' => $this->guard()->user()->id,
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'latitude' =>  floatval($request->input('latitude')),
                'longitude' => floatval($request->input('longitude')),
                'picture' => $this->storeFile($request->file('picture'), 'complain/images'),
                'voice' => $this->storeFile($request->file('voice'), 'complain/voices'),
                'video' => $this->storeFile($request->file('video'), 'complain/videos'),
                'gallery' => $request->file('gallery') ? $this->storeGalleryFiles($request->file('gallery')) : null,
                'chat_room_id'=>$chat_room->id,
            ]);

            $complain->save();
            $message = 'Titile : '.$complain->titile.'<br>';
            $message = $message.'Category : '.$complain->service_category->title_en.'('.$complain->service_category->title_en.')<br>';
            $message = $message.'Description : '.$complain->description.'<br>';
            $message = $message.'<img src="'.asset('uploads/'.$complain->picture).'" class="img-fluid msg-img">';
            ChatMessage::create([
                'chat_room_id' => $chat_room->id,
                'sender_id' => $this->guard()->user()->id,
                'sender' => 'user',
                'message' => $message,
            ]);

            return response()->json([
                'message' => 'Complain created successfully',
                'complain' => $complain,
                'chat_room' => $complain->chat_room,
                'status' => true,
            ], 201);
        }
        return response()->json([
            'status' => false,
            'error' => 'Unauthorized'
        ], 401);
    }
    public function complains(){
        if ($this->guard()->user()){
            $complains = Complain::where('user_id',$this->guard()->user()->id)->get();
            foreach ($complains as $complain){
                $complain->service_category;
                $complain->chat_room;
            }
            return response()->json([
                'status' => true,
                'complains' => $complains,
            ], 201);
        }
        return response()->json([
            'status' => false,
            'error' => 'Unauthorized'
        ], 401);
    }
    public function complain($id){
        if ($this->guard()->user()){
            $complain = Complain::find($id);
            $complain->service_category;
            $complain->chat_room;
            return response()->json([
                'status' => true,
                'complain' => $complain,
            ], 201);
        }
        return response()->json([
            'status' => false,
            'error' => 'Unauthorized'
        ], 401);
    }
    public function guard()
    {
        return Auth::guard('api');
    }
    private function storeFile($file, $destination)
    {
        if ($file) {
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/'.$destination), $fileName);
            return $destination . '/' . $fileName;
        }
        return null;
    }
    private function storeGalleryFiles($files)
    {
        $uploadedFiles = [];

        foreach ($files as $file) {
            $uploadedFiles[] = $this->storeFile($file, 'complain/gallery');
        }

        return $uploadedFiles;
    }
}
