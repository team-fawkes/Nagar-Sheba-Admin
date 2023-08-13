<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\User;


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
    public function forms(){
        if ($this->guard()->user()){
            $user = User::find($this->guard()->user()->id);
            $language = $user->language;
            if ($language == "bn"){
                $forms = Form::select('id','name_bn as name', 'url')->get();
            }else{
                $forms = Form::select('id','name_en as name', 'url')->get();
            }
            return response()->json([
                'status' => true,
                'forms' => $forms,
            ], 201);

        }
        return response()->json([
            'status' => false,
            'error' => 'Unauthorized'
        ], 401);
    }
    public function form($id){
        if ($this->guard()->user()){
            $user = User::find($this->guard()->user()->id);
            $language = $user->language;
            if ($language == "bn"){
                $form = Form::select('id','name_bn as name','url')->where('id',$id)->first();
            }else{
                $form = Form::select('id','name_en as name','url')->where('id',$id)->first();
            }
            return response()->json([
                'status' => true,
                'form' => $form,
            ], 201);

        }
        return response()->json([
            'status' => false,
            'error' => 'Unauthorized'
        ], 401);
    }
}
