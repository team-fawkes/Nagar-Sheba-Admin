<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('login',[\App\Http\Controllers\Api\AuthController::class,'login']);
Route::post('login-otp',[\App\Http\Controllers\Api\AuthController::class,'verifyOTPLogin']);
Route::post('register',[\App\Http\Controllers\Api\AuthController::class,'register']);
Route::post('register-otp',[\App\Http\Controllers\Api\AuthController::class,'verifyOTPRegistration']);
Route::post('resend-otp',[\App\Http\Controllers\Api\AuthController::class,'resendOTP']);

Route::post('logout',[\App\Http\Controllers\Api\AuthController::class,'logout']);
Route::post('refresh',[\App\Http\Controllers\Api\AuthController::class,'refresh']);
Route::post('me',[\App\Http\Controllers\Api\AuthController::class,'me']);
Route::post('profile-update',[\App\Http\Controllers\Api\UserController::class,'profile_update']);

Route::get('service-category',[\App\Http\Controllers\Api\ServiceController::class,'service_category']);
Route::get('complain-counter',[\App\Http\Controllers\Api\ServiceController::class,'complain_counter']);
Route::post('complain-create',[\App\Http\Controllers\Api\ServiceController::class,'complain_create']);
Route::get('complains',[\App\Http\Controllers\Api\ServiceController::class,'complains']);
Route::get('complain/{id}',[\App\Http\Controllers\Api\ServiceController::class,'complain']);

Route::get('bulletins',[\App\Http\Controllers\Api\NoticeController::class,'bulletins']);



