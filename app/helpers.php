<?php

use App\Models\OTP;
use App\Models\Setting;
use App\Models\SmsLog;
use Carbon\Carbon;

function getSetting($key)
{
    $setting = Setting::where('key', $key)->first();
    return $setting ? $setting->value : null;
}
function getSettingDetails($key)
{
    $setting = Setting::where('key', $key)->first();
    return $setting ? $setting->details : null;
}
function setSetting($key, $value)
{
    $setting = Setting::where('key', $key)->first();
    if($setting){
        $setting->key = $key;
        $setting->value = $value;
        $setting->update();
    }else{
        $setting = Setting::create([
            'key' => $key,
            'value' => $value,
        ]);
    }

    return $setting;
}
function setSettingDetails($key,$details)
{
    $setting = Setting::where('key', $key)->first();
    if($setting){
        $setting->key = $key;
        $setting->details = $details;
        $setting->update();
    }else{
        $setting = Setting::create([
            'key' => $key,
            'details' => $details
        ]);
    }
    return $setting;
}
function generateAndStoreOTP($phone, $otpValidityInMinutes = 10, $userID = null)
{
    $otp = mt_rand(100000, 999999);
    $expiresAt = Carbon::now()->addMinutes($otpValidityInMinutes);
    $oldOTP = OTP::where('user_id',$userID)->where('phone',$phone)->first();
    if($oldOTP){$oldOTP->delete();}
    OTP::create([
        'user_id' => $userID, // Since the user is not registered yet, set this as null.
        'phone' => $phone,
        'otp' => $otp,
        'expires_at' => $expiresAt,
    ]);

    // You can also send the OTP to the user's mobile here using an SMS service or any other method.
    // Example: sendSMS($user->phone, "Your OTP is: $otp");

    return $otp;
}

function verifyOTP($phone, $otp , $userID = null)
{
    $now = Carbon::now();
    $otpEntry = OTP::where('user_id', $userID) // Find OTPs that are not associated with any user yet.
    ->where('phone', $phone)
        ->where('otp', $otp)
        ->where('expires_at', '>', $now)
        ->first();

    if ($otpEntry) {
        // If the OTP is valid, you can log in the user or perform any other action.

        // After successful verification, you may delete the OTP entry to ensure it cannot be used again.
        $otpEntry->delete();

        return true;
    }

    return false;
}
function getSmsBalance(){
    $provider = getSetting('sms_provider');
    if($provider == 'bulk_sms_bd'){
        return get_balance_bulksmsbd();
    }else{
        return 'Please Select SMS Provider first!';
    }
}
function bulksmsbd_sms_send($phone_number,$msg) {

    $url = "http://bulksmsbd.net/api/smsapi";
    $api_key = getSetting('bulk_sms_bd_api');
    $senderid = getSetting('bulk_sms_bd_sender_id');
    $number = number_validation($phone_number);
    $message = trim($msg);

    $data = [
        "api_key" => $api_key,
        "senderid" => $senderid,
        "number" => $number,
        "message" => $message
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response);
    if($data->response_code == 202){
        toastr()->success($data->success_message,'SMS sent successful');
        return $data->success_message;
    }else{
        toastr()->error($data->error_message,'SMS sent failed!');
        return $data->error_message;
    }
}
function send_sms($number,$msg,$type){
    $provider = getSetting('sms_provider');
    if($provider == 'bulk_sms_bd'){
        $status =  bulksmsbd_sms_send($number,$msg);
        addSMSLog($number,$msg,getSetting('bulk_sms_bd_sender_id'),$status,$type);
        return $status;
    }
}
function number_validation($number) {

    $number = str_replace(' ', '', $number);
    $number = str_replace('-', '', $number);

    if (preg_match('/^(\+880|880|0)?1(1|3|4|5|6|7|8|9)\d{8}$/', $number) == 1) {

        if (preg_match("/^\+88/", $number) == 1) {
            $number = str_replace('+', '', $number);
        }
        if (preg_match("/^880|^0/", $number) == 0) {
            $number = "880" . $number;
        }
        if (preg_match("/^88/", $number) == 0) {
            $number = "88" . $number;
        }

        return $number;
    } else {
        return false;
    }
}
function addSMSLog($phone,$sms,$sender,$status,$type)
{
    SmsLog::create([
        'phone' => $phone,
        'msg' => $sms,
        'sender_id' => $status,
        'status' => $status,
        'type'=>$type,
    ]);
}
function get_balance_bulksmsbd() {
    if(getSetting('bulk_sms_bd_api')){
        $url = "http://bulksmsbd.net/api/getBalanceApi";
        $api_key = getSetting('bulk_sms_bd_api');
        $data = [
            "api_key" => $api_key
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response);
        if($data->response_code == 202){
            return $data->balance;
        }else{
            return $data->error_message;
        }
    }
    else{
        return 'Enter api key to know balance';
    }

}
