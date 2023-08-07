<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bulletin;
use App\Models\Complain;
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
                $bulletins = Bulletin::where('status',true)->orderBy('order','asc')->select('headline_bn as headline', 'url')->get();
            }else{
                $bulletins = Bulletin::where('status',true)->orderBy('order','asc')->select('headline_en as headline', 'url')->get();
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
    public function guard()
    {
        return Auth::guard('api');
    }
}
