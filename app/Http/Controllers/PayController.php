<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayController extends Controller
{
    public function payment($invid){
        $html = 'Payment in process. Invoice ID : '.$invid;
        return $html;
    }
}
