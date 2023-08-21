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

Route::get('mayor',[\App\Http\Controllers\Api\GlobalController::class,'mayor']);
Route::get('ceo',[\App\Http\Controllers\Api\GlobalController::class,'ceo']);

Route::get('service-category',[\App\Http\Controllers\Api\ServiceController::class,'service_category']);
Route::get('complain-counter',[\App\Http\Controllers\Api\ServiceController::class,'complain_counter']);
Route::post('complain-create',[\App\Http\Controllers\Api\ServiceController::class,'complain_create']);
Route::get('complains',[\App\Http\Controllers\Api\ServiceController::class,'complains']);
Route::get('complain/{id}',[\App\Http\Controllers\Api\ServiceController::class,'complain']);

Route::get('bulletins',[\App\Http\Controllers\Api\NoticeController::class,'bulletins']);
Route::get('notifications',[\App\Http\Controllers\Api\NoticeController::class,'notifications']);
Route::get('notification/{id}',[\App\Http\Controllers\Api\NoticeController::class,'notification']);
Route::get('disaster-alerts',[\App\Http\Controllers\Api\NoticeController::class,'disaster_alerts']);
Route::get('disaster-alert/{id}',[\App\Http\Controllers\Api\NoticeController::class,'disaster_alert']);

Route::get('spectacular-places',[\App\Http\Controllers\Api\NoticeController::class,'spectacular_places']);
Route::get('spectacular-place/{id}',[\App\Http\Controllers\Api\NoticeController::class,'spectacular_place']);

Route::post('near_locations',[\App\Http\Controllers\Api\NoticeController::class,'near_locations']);
Route::get('near_location/{id}',[\App\Http\Controllers\Api\NoticeController::class,'near_location']);

Route::get('zones',[\App\Http\Controllers\Api\CouncilorController::class,'zones']);
Route::get('zone/{id}',[\App\Http\Controllers\Api\CouncilorController::class,'zone']);
Route::get('zone/{id}/councilors',[\App\Http\Controllers\Api\CouncilorController::class,'zone_councilors']);

Route::get('wards',[\App\Http\Controllers\Api\CouncilorController::class,'wards']);
Route::get('ward/{id}',[\App\Http\Controllers\Api\CouncilorController::class,'ward']);

Route::get('councilors',[\App\Http\Controllers\Api\CouncilorController::class,'councilors']);
Route::get('councilor/{id}',[\App\Http\Controllers\Api\CouncilorController::class,'councilor']);

Route::get('forms',[\App\Http\Controllers\Api\GlobalController::class,'forms']);
Route::get('form/{id}',[\App\Http\Controllers\Api\GlobalController::class,'form']);

Route::get('department-heads',[\App\Http\Controllers\Api\GlobalController::class,'dept_heads']);
Route::get('department-head/{id}',[\App\Http\Controllers\Api\GlobalController::class,'dept_head']);

Route::get('offices',[\App\Http\Controllers\Api\GlobalController::class,'offices']);
Route::get('office/{id}',[\App\Http\Controllers\Api\GlobalController::class,'office']);

//payment
Route::get('bill-categories',[\App\Http\Controllers\Api\PaymentController::class,'bill_categories']);
Route::get('bill-category/{id}',[\App\Http\Controllers\Api\PaymentController::class,'bill_category']);

Route::get('bills',[\App\Http\Controllers\Api\PaymentController::class,'bills']);
Route::get('bill/{id}',[\App\Http\Controllers\Api\PaymentController::class,'bill']);

