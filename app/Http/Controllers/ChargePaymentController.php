<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
require_once('../vendor/autoload.php');

class ChargePaymentController extends Controller
{
    public function charge(Request $request){
      
       
    
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        
    
            $customer = \Stripe\Customer::create(array(
                "address" => [
                    "line1" => "Virani Chowk",
                    "postal_code" => "390008",
                    "city" => "Vadodara",
                    "state" => "GJ",
                    "country" => "Nigeria",
                ],
                "email" => $user->email,
                "name" => $user->name,
                "source" => $request->stripeToken
            ));
    
            \Stripe\Charge::create ([
                "amount" => $request->amount * 100,
                "currency" => "usd",
                "customer" => $customer->id,
                "description" => "Test Project",
                
        ]); 
    }
}
