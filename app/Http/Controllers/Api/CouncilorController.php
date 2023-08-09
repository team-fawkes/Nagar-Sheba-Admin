<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Councilor;
use App\Models\User;
use App\Models\Ward;
use App\Models\Zone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CouncilorController extends Controller
{
    public function zones(){
        if ($this->guard()->user()){
            $user = User::find($this->guard()->user()->id);
            $language = $user->language;
            if ($language == "bn"){
                $zones = Zone::select('id','name_bn as name')->get();
            }else{
                $zones = Zone::select('id','name_en as name')->get();
            }

            return response()->json([
                'status' => true,
                'zones' => $zones,
            ], 201);
        }
        return response()->json([
            'status' => false,
            'error' => 'Unauthorized'
        ], 401);
    }
    public function zone($id){
        if ($this->guard()->user()){
            $user = User::find($this->guard()->user()->id);
            $language = $user->language;
            if ($language == "bn"){
                $zone = Zone::where('id',$id)->select('id','name_bn as name')->first();
                $wards = Ward::where('zone_id',$id)->select('id','name_bn as name')->get();
            }else{
                $zone = Zone::where('id',$id)->select('id','name_en as name')->first();
                $wards = Ward::where('zone_id',$id)->select('id','name_en as name')->get();
            }

            return response()->json([
                'status' => true,
                'zone' => $zone,
                'wards' => $wards,
            ], 201);
        }
        return response()->json([
            'status' => false,
            'error' => 'Unauthorized'
        ], 401);
    }
    public function zone_councilors($id){
        if ($this->guard()->user()){
            $user = User::find($this->guard()->user()->id);
            $language = $user->language;
            $zone = Zone::with('wards.councilors')->findOrFail($id);
            if ($language == "bn"){
                $zoneName = $zone->name_bn;
                $wardCounselors = [];

                foreach ($zone->wards as $ward) {
                    $wardName = $ward->name_bn;
                    $wardId = $ward->id;
                    $counselors = Councilor::where('ward_id',$id)
                        ->select('id','ward_id','name_bn as name','title_bn as title', 'parliament_members_bn as parliament_members','details_bn as details','image','phone')->get();

                    $wardCounselors[] = [
                        'ward_name' => $wardName,
                        'counselors' => $counselors,
                    ];
                }
            }else{
                $zoneName = $zone->name_en;
                $wardCounselors = [];

                foreach ($zone->wards as $ward) {
                    $wardName = $ward->name_en;
                    $wardId = $ward->id;
                    $counselors = Councilor::where('ward_id',$id)
                        ->select('id','ward_id','name_en as name','title_en as title', 'parliament_members_en as parliament_members','details_en as details','image','phone')->get();

                    $wardCounselors[] = [
                        'ward_name' => $wardName,
                        'ward_id' => $wardId,
                        'counselors' => $counselors,
                    ];
                }
            }

            return response()->json([
                'status' => true,
                'zone_name' => $zoneName,
                'ward_counselors' => $wardCounselors,
            ], 201);
        }
        return response()->json([
            'status' => false,
            'error' => 'Unauthorized'
        ], 401);
    }

    public function wards(){
        if ($this->guard()->user()){
            $user = User::find($this->guard()->user()->id);
            $language = $user->language;
            if ($language == "bn"){
                $wards = Ward::select('id','name_bn as name')->get();
            }else{
                $wards = Ward::select('id','name_en as name')->get();
            }

            return response()->json([
                'status' => true,
                'wards' => $wards,
            ], 201);
        }
        return response()->json([
            'status' => false,
            'error' => 'Unauthorized'
        ], 401);
    }
    public function ward($id){
        if ($this->guard()->user()){
            $user = User::find($this->guard()->user()->id);
            $language = $user->language;
            if ($language == "bn"){
                $ward = Ward::where('id',$id)->select('id','name_bn as name')->first();
                $councilors = Councilor::where('ward_id',$id)
                    ->select('id','name_bn as name','title_bn as title', 'parliament_members_bn as parliament_members','details_bn as details','image','phone')->get();
            }else{
                $ward = Zone::where('id',$id)->select('id','name_en as name')->first();
                $councilors = Councilor::where('ward_id',$id)
                    ->select('id','name_en as name','title_en as title', 'parliament_members_en as parliament_members','details_en as details','image','phone')->get();
            }

            return response()->json([
                'status' => true,
                'ward' => $ward,
                'councilors' => $councilors,
            ], 201);
        }
        return response()->json([
            'status' => false,
            'error' => 'Unauthorized'
        ], 401);
    }

    public function councilors(){
        if ($this->guard()->user()){
            $user = User::find($this->guard()->user()->id);
            $language = $user->language;
            if ($language == "bn"){

                $councilors = Councilor::select('id','ward_id','name_bn as name','title_bn as title', 'parliament_members_bn as parliament_members','details_bn as details','image','phone')
                    ->with(['ward' => function ($query) {
                        $query->select('id', 'name_bn as name');
                    }])->get();

            }else{
                $councilors = Councilor::select('id','ward_id','name_en as name','title_en as title', 'parliament_members_en as parliament_members','details_en as details','image','phone')
                    ->with(['ward' => function ($query) {
                        $query->select('id', 'name_en as name');
                    }])->get();

            }

            return response()->json([
                'status' => true,
                'councilors' => $councilors,
            ], 201);
        }
        return response()->json([
            'status' => false,
            'error' => 'Unauthorized'
        ], 401);
    }
    public function councilor($id){
        if ($this->guard()->user()){
            $user = User::find($this->guard()->user()->id);
            $language = $user->language;
            if ($language == "bn"){
                $councilor = Councilor::where('id',$id)
                    ->select('id','ward_id','name_bn as name','title_bn as title', 'parliament_members_bn as parliament_members','details_bn as details','image','phone')
                    ->with(['ward' => function ($query) {
                        $query->select('id', 'name_bn as name');
                    }])->first();

            }else{
                $councilor = Councilor::where('ward_id',$id)
                    ->select('id','ward_id','name_en as name','title_en as title', 'parliament_members_en as parliament_members','details_en as details','image','phone')
                    ->with(['ward' => function ($query) {
                        $query->select('id', 'name_en as name');
                    }])->first();

            }

            return response()->json([
                'status' => true,
                'councilor' => $councilor,
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
