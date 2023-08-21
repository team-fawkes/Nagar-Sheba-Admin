<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class PayController extends Controller
{
    public function payment($invid){
        $invoice = Invoice::where('invid',$invid)->first();
        $html = 'Payment Invoice not found';
        if ($invoice){
            $html = 'Payment in process. Invoice ID : '.$invid.
                '<br> Invoice Amount is : '.$invoice->amount.
                '<br> Invoice Status is : '.$invoice->status;
        }
        return $html;
    }
}
