<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment\Gateway;



class AllpaymentController extends Controller
{
    
    public function charge(Gateway $gateway){
        
        return $gateway->charge();
        
    }
}
