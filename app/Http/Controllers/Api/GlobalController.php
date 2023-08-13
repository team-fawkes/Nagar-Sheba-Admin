<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class GlobalController extends Controller
{

    public function mayor(){
        if ($this->guard()->user()){
            $user = User::find($this->guard()->user()->id);
            $language = $user->language;
            if ($language == "bn"){
                return response()->json([
                    'status' => true,
                    'mayor_name_image' => getSetting('mayor_name_image'),
                    'mayor_name' => getSetting('mayor_name_bn'),
                    'mayor_details' => getSettingDetails('mayor_details_bn'),
                ], 201);

            }else{
                return response()->json([
                    'status' => true,
                    'mayor_name_image' => getSetting('mayor_name_image'),
                    'mayor_name' => getSetting('mayor_name_en'),
                    'mayor_details' => getSettingDetails('mayor_details_en'),
                ], 201);
            }

        }
        return response()->json([
            'status' => false,
            'error' => 'Unauthorized'
        ], 401);
    }
    public function ceo(){
        if ($this->guard()->user()){
            $user = User::find($this->guard()->user()->id);
            $language = $user->language;
            if ($language == "bn"){
                return response()->json([
                    'status' => true,
                    'ceo_name_image' => getSetting('ceo_name_image'),
                    'ceo_name' => getSetting('ceo_name_bn'),
                    'ceo_details' => getSettingDetails('ceo_details_bn'),
                ], 201);

            }else{
                return response()->json([
                    'status' => true,
                    'ceo_name_image' => getSetting('ceo_name_image'),
                    'ceo_name' => getSetting('ceo_name_en'),
                    'ceo_details' => getSettingDetails('ceo_details_en'),
                ], 201);
            }

        }
        return response()->json([
            'status' => false,
            'error' => 'Unauthorized'
        ], 401);
    }
}
