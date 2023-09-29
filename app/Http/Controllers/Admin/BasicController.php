<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bulletin;
use App\Models\DisasterAlert;
use App\Models\Notification;
use Illuminate\Http\Request;

class BasicController extends Controller
{
   public function bulletins(){
       $data = Bulletin::all();
       return response()->json([
           'data' => $data
       ]);
   }
   public function notifications(){
       $data = Notification::all();
       return response()->json([
           'data' => $data
       ]);
   }
    public function notification($id){
        $data = Notification::find($id);
        return response()->json([
            'data' => $data
        ]);
    }

   public function disaster_alerts(){
       $data = DisasterAlert::all();
       return response()->json([
           'data' => $data
       ]);
   }
    public function disaster_alert($id){
        $data = DisasterAlert::find($id);
        return response()->json([
            'data' => $data
        ]);
    }
}
