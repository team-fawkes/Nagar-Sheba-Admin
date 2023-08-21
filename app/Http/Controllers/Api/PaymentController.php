<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function bill_categories(){
        if ($this->guard()->user()){
            $user = User::find($this->guard()->user()->id);
            $language = $user->language;
            if ($language == "bn"){
                $categories = BillCategory::select('id','name_bn as name', 'icon', 'color')->get();
                foreach ($categories as $category){
                    $bill = $category->bill;
                }
                return response()->json([
                    'status' => true,
                    'categories' => $categories,
                ], 201);

            }else{
                $categories = BillCategory::select('id','name_en as name', 'icon', 'color')->get();
                foreach ($categories as $category){
                    $bill = $category->bill;
                }
                return response()->json([
                    'categories' => $categories,
                ], 201);
            }

        }
        return response()->json([
            'status' => false,
            'error' => 'Unauthorized'
        ], 401);
    }
    public function bill_category($id){
        if ($this->guard()->user()){
            $user = User::find($this->guard()->user()->id);
            $language = $user->language;
            if ($language == "bn"){
                $category = BillCategory::where('id',$id)->select('id','name_bn as name', 'icon', 'color')->first();
                $bill = $category->bill;

                return response()->json([
                    'status' => true,
                    'category' => $category,
                ], 201);

            }else{
                $category = BillCategory::where('id',$id)->select('id','name_en as name', 'icon', 'color')->first();
                $bill = $category->bill;
                return response()->json([
                    'categories' => $category,
                ], 201);
            }

        }
        return response()->json([
            'status' => false,
            'error' => 'Unauthorized'
        ], 401);
    }
    public function bills(){
        if ($this->guard()->user()){
            $user = User::find($this->guard()->user()->id);
            $language = $user->language;
            if ($language == "bn"){
                $bills = Bill::select('id','bill_category_id','name_bn as name', 'icon', 'color')->get();
                foreach ($bills as $bill){
                    $bill_category = $bill->bill_category;
                }
                return response()->json([
                    'status' => true,
                    'bills' => $bills,
                ], 201);

            }else{
                $bills = Bill::select('id','bill_category_id','name_en as name', 'icon', 'color')->get();
                foreach ($bills as $bill){
                    $bill_category = $bill->bill_category;
                }
                return response()->json([
                    'bills' => $bills,
                ], 201);
            }

        }
        return response()->json([
            'status' => false,
            'error' => 'Unauthorized'
        ], 401);
    }
    public function bill($id){
        if ($this->guard()->user()){
            $user = User::find($this->guard()->user()->id);
            $language = $user->language;
            if ($language == "bn"){
                $bill = Bill::where('id',$id)->select('id','bill_category_id','name_bn as name', 'icon', 'color')->first();
                $bill_category = $bill->bill_category;

                return response()->json([
                    'status' => true,
                    'bill' => $bill,
                ], 201);

            }else{
                $bill = Bill::where('id',$id)->select('id','bill_category_id','name_en as name', 'icon', 'color')->first();
                $bill_category = $bill->bill_category;
                return response()->json([
                    'bill' => $bill,
                ], 201);
            }
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
