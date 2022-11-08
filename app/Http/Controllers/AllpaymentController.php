<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment\Gateway;
use App\Models\User;
use Auth;



class AllpaymentController extends Controller
{
    
    public function charge(Request $request){
        
        $type=['type'=>0];
        if(isset($request->stripeToken)){
            $type=['type'=>1];
        }
        
        $payment=\App::make(Gateway::class,  $type);
        
        $user=User::where('id',Auth::user()->id)->first();
        $result=$payment->charge($user,$request->all());
        
        return $result;
       
       
        
    }
}
