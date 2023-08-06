<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function service_category(){
        if ($this->guard()->user()){
            $language = $this->guard()->user()->language;
            if ($language == 'bn'){
                $categories = ServiceCategory::orderBy('order','asc')->get(['title_bn', 'icon','color']);
            }else{
                $categories = ServiceCategory::orderBy('order','asc')->get(['title_en', 'icon','color']);
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
    public function guard()
    {
        return Auth::guard('api');
    }
}
