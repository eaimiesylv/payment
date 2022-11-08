<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;


use DB;
use Paystack;

class PaymentController extends Controller
{

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    

    public function redirectToGateway(Request $request)
    {
        
        $data = array(
            "amount" => 700 * 100,
            "reference" => time(),
            "email" => 'okomemmanuel1@gmail.com',
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

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
       // date_default_timezone_set("Africa/Lagos");
        $paymentDetails = Paystack::getPaymentData(); 
        $array=[
            'status'=>$paymentDetails['data']['status'],
            'amount'=>$paymentDetails['data']['amount'],
            'currency'=>$paymentDetails['data']['currency'],
            'transaction_date'=>$paymentDetails['data']['transaction_date'],
            'last4'=>$paymentDetails['data']['authorization']['last4'],
            'bank'=>$paymentDetails['data']['authorization']['bank'],
            'reference'=>$paymentDetails['data']['reference'],
            'message'=>$paymentDetails['data']['message'],
            'subscription_due_date'=>'',
            'authorization_code'=>$paymentDetails['data']['authorization']['authorization_code'],
            'country_code'=>$paymentDetails['data']['authorization']['country_code'],
            'account_name'=>$paymentDetails['data']['authorization']['account_name'],	
            'first_name'=>$paymentDetails['data']['customer']['first_name'],
            'last_name'=>$paymentDetails['data']['customer']['last_name'],
            'email'=>$paymentDetails['data']['customer']['email'],
            'card_type'=>$paymentDetails['data']['authorization']['card_type'],
            'requested_amount'=>$paymentDetails['data']['requested_amount'] 
        ];
       
        
        return $array;

       
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}