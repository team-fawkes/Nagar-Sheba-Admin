<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OTP;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|unique:users',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        $otp = generateAndStoreOTP($request->phone);
        return response()->json([
            'otp' => $otp,
            'request' => $request->all(),
            'message' => 'OTP sent to your mobile.',
        ], 200);
    }
    public function verifyOTPRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|unique:users',
            'password' => 'required|confirmed',
            'otp' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        if (verifyOTP($request->phone,$request->otp)) {
            // If the OTP is valid, create the user and log them in.
             User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'phone_verified_at' => Carbon::now(),
            ]);
            $credentials = $request->only('phone', 'password');
            if ($token = $this->guard()->attempt($credentials)) {
                return response()->json([
                    'user' => $this->guard()->user(),
                    'message' => 'Registration successful.',
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => $this->guard()->factory()->getTTL() * 60
                ], 200);
            }
        }

        return response()->json([
            'message' => 'Invalid OTP. Please try again.',
        ], 422);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        $user = User::where('phone',$request->phone)->first();
        $credentials = $request->only('phone', 'password');
        if($this->guard()->attempt($credentials)){
            $otp = generateAndStoreOTP($request->phone,10,$user->id);
            return response()->json([
                'otp' => $otp,
                'id' => $user->id,
                'request' => $request->all(),
                'message' => 'OTP sent to your mobile.',
            ], 200);
        }else{
            return response()->json([
                'errors' => 'Phone or password is invalid!',
            ], 422);
        }

    }
    public function verifyOTPLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'otp' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        if (verifyOTP($request->phone,$request->otp,$request->id)) {

            $credentials = $request->only('phone', 'password');
            if ($token = $this->guard()->attempt($credentials)) {
                return response()->json([
                    'user' => $this->guard()->user(),
                    'message' => 'Login successful.',
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => $this->guard()->factory()->getTTL() * 60
                ], 200);
            }
        }

        return response()->json([
            'message' => 'Invalid OTP. Please try again.',
        ], 422);
    }
    public function resendOTP(Request $request){
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        $otp = generateAndStoreOTP($request->phone,10,$request->id);
        return response()->json([
            'otp' => $otp,
            'request' => $request->all(),
            'message' => 'OTP sent to your mobile.',
        ], 200);
    }
    public function me()
    {
        if ($this->guard()->user()){
            return response()->json($this->guard()->user());
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'user' => $this->guard()->user(),
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }
    public function guard()
    {
        return Auth::guard('api');
    }
}
