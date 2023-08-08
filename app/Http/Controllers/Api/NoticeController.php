<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bulletin;
use App\Models\Complain;
use App\Models\DisasterAlert;
use App\Models\Notification;
use App\Models\ServiceCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{
    public function bulletins(){
        if ($this->guard()->user()){
            $user = User::find($this->guard()->user()->id);
            $language = $user->language;
            if ($language == "bn"){
                $bulletins = Bulletin::where('status',true)->orderBy('order','asc')->select('headline_bn as headline', 'url','created_at')->get();
            }else{
                $bulletins = Bulletin::where('status',true)->orderBy('order','asc')->select('headline_en as headline', 'url','created_at')->get();
            }

            return response()->json([
                'status' => true,
                'bulletins' => $bulletins,
            ], 201);
        }
        return response()->json([
            'status' => false,
            'error' => 'Unauthorized'
        ], 401);
    }
    public function notifications(){
        if ($this->guard()->user()){
            $user = User::find($this->guard()->user()->id);
            $language = $user->language;
            if ($language == "bn"){
                $notifications = Notification::where('status',true)->orderBy('order','asc')
                    ->select('title_bn as title', 'details_bn as details','icon','url','created_at')->get();
            }else{
                $notifications = Notification::where('status',true)->orderBy('order','asc')
                    ->select('title_en as title', 'details_en as details','icon','url','created_at')->get();
            }

            return response()->json([
                'status' => true,
                'notifications' => $notifications,
            ], 201);
        }
        return response()->json([
            'status' => false,
            'error' => 'Unauthorized'
        ], 401);
    }
    public function notification($id){
        if ($this->guard()->user()){
            $user = User::find($this->guard()->user()->id);
            $language = $user->language;
            if ($language == "bn"){
                $notifications = Notification::where('status',true)->orderBy('order','asc')->where('id',$id)
                    ->select('title_bn as title', 'details_bn as details','icon','url','created_at')->first();
            }else{
                $notifications = Notification::where('status',true)->orderBy('order','asc')->where('id',$id)
                    ->select('title_en as title', 'details_en as details','icon','url','created_at')->first();
            }

            return response()->json([
                'status' => true,
                'notifications' => $notifications,
            ], 201);
        }
        return response()->json([
            'status' => false,
            'error' => 'Unauthorized'
        ], 401);
    }
    public function disaster_alerts(){
        if ($this->guard()->user()){
            $user = User::find($this->guard()->user()->id);
            $language = $user->language;
            if ($language == "bn"){
                $notifications = DisasterAlert::where('status',true)->orderBy('order','asc')
                    ->select('title_bn as title', 'details_bn as details','image','url','file','created_at')->get();
            }else{
                $notifications = DisasterAlert::where('status',true)->orderBy('order','asc')
                    ->select('title_en as title', 'details_en as details','image','url','file','created_at')->get();
            }

            return response()->json([
                'status' => true,
                'notifications' => $notifications,
            ], 201);
        }
        return response()->json([
            'status' => false,
            'error' => 'Unauthorized'
        ], 401);
    }
    public function disaster_alert($id){
        if ($this->guard()->user()){
            $user = User::find($this->guard()->user()->id);
            $language = $user->language;
            if ($language == "bn"){
                $notifications = DisasterAlert::where('status',true)->orderBy('order','asc')->where('id',$id)
                    ->select('title_bn as title', 'details_bn as details','image','url','file','created_at')->first();
            }else{
                $notifications = DisasterAlert::where('status',true)->orderBy('order','asc')->where('id',$id)
                    ->select('title_en as title', 'details_en as details','image','url','file','created_at')->first();
            }

            return response()->json([
                'status' => true,
                'notifications' => $notifications,
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
}
