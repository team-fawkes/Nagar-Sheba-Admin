<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function profile_update(Request $request){
        if ($this->guard()->user()){
            $user = User::find($this->guard()->user()->id)->first();
            if($request->name){
                $user->name = $request->name;
            }
            if($request->phone){
                $validator = Validator::make($request->all(), [
                    'phone' => 'required|unique:users',
                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'errors' => $validator->errors(),
                    ], 422);
                }
                $user->phone = $request->phone;
            }
            if($request->password){
                $validator = Validator::make($request->all(), [
                    'password' => 'required|confirmed',
                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'errors' => $validator->errors(),
                    ], 422);
                }
                $user->password = Hash::make($request->password) ;
            }

            if($request->sound){
                $user->sound = $request->sound;
            }
            if($request->notification){
                $user->notification = $request->notification;
            }
            if($request->language){
                $user->language = $request->language;
            }
            if($request->latitude){
                $user->latitude = $request->latitude;
            }
            if($request->longitude){
                $user->longitude = $request->longitude;
            }
            $user->update();
            return response()->json([
                'user' => $user,
                'status' => true,
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function guard()
    {
        return Auth::guard('api');
    }
}
