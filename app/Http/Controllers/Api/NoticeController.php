<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bulletin;
use App\Models\Complain;
use App\Models\DisasterAlert;
use App\Models\NearLocation;
use App\Models\Notification;
use App\Models\ServiceCategory;
use App\Models\SpectacularPlace;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NoticeController extends Controller
{
    public function bulletins(){
        if ($this->guard()->user()){
            $user = User::find($this->guard()->user()->id);
            $language = $user->language;
            if ($language == "bn"){
                $bulletins = Bulletin::where('status',true)->orderBy('order','asc')->select('id','headline_bn as headline', 'url','created_at')->get();
            }else{
                $bulletins = Bulletin::where('status',true)->orderBy('order','asc')->select('id','headline_en as headline', 'url','created_at')->get();
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
                    ->select('id','title_bn as title', 'details_bn as details','icon','url','created_at')->get();
            }else{
                $notifications = Notification::where('status',true)->orderBy('order','asc')
                    ->select('id','title_en as title', 'details_en as details','icon','url','created_at')->get();
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
                $notification = Notification::where('status',true)->orderBy('order','asc')->where('id',$id)
                    ->select('id','title_bn as title', 'details_bn as details','icon','url','created_at')->first();
            }else{
                $notification = Notification::where('status',true)->orderBy('order','asc')->where('id',$id)
                    ->select('id','title_en as title', 'details_en as details','icon','url','created_at')->first();
            }

            return response()->json([
                'status' => true,
                'notification' => $notification,
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
                    ->select('id','title_bn as title', 'details_bn as details','image','url','file','created_at')->get();
            }else{
                $notifications = DisasterAlert::where('status',true)->orderBy('order','asc')
                    ->select('id','title_en as title', 'details_en as details','image','url','file','created_at')->get();
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
                $notification = DisasterAlert::where('status',true)->orderBy('order','asc')->where('id',$id)
                    ->select('id','title_bn as title', 'details_bn as details','image','url','file','created_at')->first();
            }else{
                $notification = DisasterAlert::where('status',true)->orderBy('order','asc')->where('id',$id)
                    ->select('id','title_en as title', 'details_en as details','image','url','file','created_at')->first();
            }

            return response()->json([
                'status' => true,
                'notification' => $notification,
            ], 201);
        }
        return response()->json([
            'status' => false,
            'error' => 'Unauthorized'
        ], 401);
    }

    public function spectacular_places(){
        if ($this->guard()->user()){
            $user = User::find($this->guard()->user()->id);
            $language = $user->language;
            if ($language == "bn"){
                $spectacular_places = SpectacularPlace::select('id','name_bn as name', 'details_bn as details','thumbnail','gallery','latitude','longitude','established_at')->get();
            }else{
                $spectacular_places = SpectacularPlace::select('id','name_en as name', 'details_en as details','thumbnail','gallery','latitude','longitude','established_at')->get();
            }

            return response()->json([
                'status' => true,

                'spectacular_places' => $spectacular_places,
            ], 201);
        }
        return response()->json([
            'status' => false,
            'error' => 'Unauthorized'
        ], 401);
    }
    public function spectacular_place($id){
        if ($this->guard()->user()){
            $user = User::find($this->guard()->user()->id);
            $language = $user->language;
            if ($language == "bn"){
                $spectacular_place = SpectacularPlace::where('id',$id)->select('id','name_bn as name', 'details_bn as details','thumbnail','gallery','latitude','longitude','established_at')->get();
            }else{
                $spectacular_place = SpectacularPlace::where('id',$id)->select('id','name_en as name', 'details_en as details','thumbnail','gallery','latitude','longitude','established_at')->get();
            }

            return response()->json([
                'status' => true,
                'id' => $id,
                'spectacular_place' => $spectacular_place,
            ], 201);
        }
        return response()->json([
            'status' => false,
            'error' => 'Unauthorized'
        ], 401);
    }

    public function near_locations(Request $request){
        $validator = Validator::make($request->all(), [
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        if ($this->guard()->user()){
            $user = User::find($this->guard()->user()->id);
            $language = $user->language;
            if ($language == "bn"){
                $near_locations = NearLocation::where('type',$request->type)->select('id','name_bn as name', 'details_bn as details','thumbnail','gallery','latitude','longitude','type')->get();
            }else{
                $near_locations = NearLocation::where('type',$request->type)->select('id','name_en as name', 'details_en as details','thumbnail','gallery','latitude','longitude','type')->get();
            }

            return response()->json([
                'status' => true,
                'near_locations' => $near_locations,
            ], 201);
        }
        return response()->json([
            'status' => false,
            'error' => 'Unauthorized'
        ], 401);
    }
    public function near_location($id){
        if ($this->guard()->user()){
            $user = User::find($this->guard()->user()->id);
            $language = $user->language;
            if ($language == "bn"){
                $near_location = NearLocation::where('id',$id)->select('id','name_bn as name', 'details_bn as details','thumbnail','gallery','latitude','longitude','type')->first();
            }else{
                $near_location = NearLocation::where('id',$id)->select('id','name_en as name', 'details_en as details','thumbnail','gallery','latitude','longitude','type')->first();
            }

            return response()->json([
                'status' => true,
                'near_location' => $near_location,
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
