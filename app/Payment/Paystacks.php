<?php

namespace App\Payment;
use Illuminate\Support\Facades\Redirect;
use DB;
use Paystack;

class Paystacks implements Gateway{

	
   
	public function charge($userdetail,$form){
		
	
	
	$data = array(
            "amount" => $form['amount'] * 100,
            "reference" => time(),
            "email" => $userdetail['email'],
            "currency" => "NGN",
            "orderID" => 23456,
        );
	 return Paystack::getAuthorizationUrl($data)->redirectNow();
       
                try{
                    return Paystack::getAuthorizationUrl()->redirectNow();
                }catch(\Exception $e) {
                    return Redirect::back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
                }  
	
	
	
	
	
	
	
	
	}
	
}

?>